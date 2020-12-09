<?php

namespace App\Http\Controllers\Web\OfferReservation;

use App\Models\Admin\City\City;
use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Hotel\HotelRoom;
use App\Models\Admin\Offer\Offer;
use App\Models\User\FlightReservation\FlightReservation;
use App\Models\User\HotelReservation\HotelReservation;
use App\Models\User\OfferReservation\OfferReservation;
use Faker\ORM\Spot\ColumnTypeGuesser;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfferReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['offerReservation']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // search flights function
    public function searchOffers(Request $request)
    {
        $this->validate($request, [
            'dest_city' => 'required|alpha',

        ]);

        $dest_city = $request->input('dest_city');
        //return $dest_city;
        /*$offers = Offer::with('flight.destination_city.country')
            ->with('hotel')
            ->get();*/

        $offers = Offer::whereHas('flight.destination_city', function ($query) use ($dest_city) {
            $query->where('name', 'like', '%' . $dest_city . '%');
        })
            ->get();
        //return $offers;
       /* foreach ($offers as $offer){
            $offer_room = $offer->room;
            $data['room'] = $offer_room;
        }*/
       // return $data;
       $searched_data = [];
        $data = [];
        $offer_data = [];
        foreach ($offers as $offer) {
                $flight = Flight::where('id',$offer->flight_id)->first();
                $data['offer_id'] = $offer->id;
                $data['price'] = $offer->price;
                $data['flight_id'] = $flight->id;
                $data['country'] = $flight->destination_city->country->name;
                $data['destination_city'] = $flight->destination_city->name;
                $data['date'] = $flight->date;
            foreach($offer->room as $offerRoom) {
                if ($offerRoom->is_available != 0){
                 $data['room'] = $offerRoom;
                 $searched_data[] = $data;
                }

            }

                //array_push($offer_data, $data);
        }
    // return $searched_data;
        return view('Web.Search.Offer.searchOffer', compact('searched_data'));
    }

    // offer details
    public function offerDetails( $offerId, $flightId)
    {
        $offer = Offer::where('id',$offerId)
            ->with('room')
            ->first();
        //return $offer;
        $flight = Flight::where('id',$flightId)->first();
        //return $flight;
        $city = City::where('id',$flight->destination_city_id)->first();
       // return $city->cityImage;
        $returned_flight = Flight::where('id',$offer->returned_flight_id)->first();

        $room = HotelRoom::where('offer_id',$offer->id)->first();
       // return $room;
        $hotel = Hotel::where('id',$room->hotel_id)->first();
       //return $hotel;
      //  return $returned_flight;
        //return $offer_data;
        return view('Web.Search.Offer.searchOfferDetails', compact('offer','flight','returned_flight','hotel','room'));
    }

    public function offerReservation($offerId,$flightId){
        if (Auth::user()){
            $user = Auth::user();
            $offer = Offer::where('id',$offerId)->first();
            return view('Web.Search.Offer.completeReservation',compact('user','offer'));
        }else{
            return redirect()->intended();
        }
    }

    public function completeOfferReservation(Request $request,$offerId,$flightId){
        $this->validate($request, ['credit' => 'required', 'credit_number' => 'required|numeric|min:0']);
        $user = Auth::user();
        $offer = Offer::where('id',$offerId)->first();
        $offer_price = $offer->price;
        $flight = Flight::where('id',$flightId)->first();
      // return $offer;
        $user->credit = $request->input('credit');
        $userBalance = $request->input('credit_number');
        if ($userBalance < $offer_price) {
            return redirect()->back()->with('error', 'الرصيد غيركافي لعملية الحجز');
        }
        $user->credit_balance = $userBalance - $offer_price;
        $user->save();
        $offersCheck = OfferReservation::where('user_id',$user->id)->first();

            if ($offersCheck != null){
                return redirect()->back()->with('error','لقد استفدت من عرض سابق');
            }

        $flightReservation = new FlightReservation();
        $flightReservation->user_id = Auth::user()->id;

        $flightReservation->flight_id = $flight->id;
        $flightReservation->seats_count = $offer->seats_number;
        $flightReservation->date = $flight->date;
        $flightReservation->time = $flight->time;
        $flightReservation->offer_id = $offer->id;
       // return $flightReservation;
        $flightReservation->save();
        if ($offer->flight_degree_id == 1){
            $flightReservation->reservation_price = $flight->first_class_ticket_price;
            $flightReservation->flight_degree_id = 1;
        }else{
            $flightReservation->reservation_price = $flight->economy_ticket_price;
            $flightReservation->flight_degree_id = 2;
        }

        $flightReservation->save();
       // return  $flightReservation;
        $hotelReservation = new HotelReservation();
        $hotelReservation->user_id = Auth::user()->id;
        $room = HotelRoom::where('offer_id',$offer->id)->first();
        $room->is_available = 0;
        $room->save();
        $hotel = Hotel::where('id',$room->hotel_id)->first();
        $hotelReservation->hotel_id =$hotel->id;
        $hotelReservation->room_id =$room->id;
        $hotelReservation->offer_id = $offer->id;
        $hotelReservation->is_booked = true;
        $hotelReservation->reservation_cost = $room->night_price;
        $hotelReservation->save();
       // $flightReservationCost = $flightReservation->reservation_price;

        $offerReservation = new OfferReservation();
        $offerReservation->user_id = Auth::user()->id;
        $offerReservation->offer_id = $offer->id;
        $offerReservation->date = $flight->date;
        $offerReservation->time = $flight->time;

        $offerReservation->save();

        return redirect()->route('showUserReservations')->with('success', 'تمت عملية حجز العرض بنجاح');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
