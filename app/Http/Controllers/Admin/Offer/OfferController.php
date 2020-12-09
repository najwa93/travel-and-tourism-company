<?php

namespace App\Http\Controllers\Admin\Offer;

use App\Models\Admin\City\City;
use App\Models\Admin\Country\Country;
use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Flight\FlightDegree;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Hotel\HotelRoom;
use App\Models\Admin\Offer\Offer;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('Role:Admin,Offer_Manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::with('flight.source_city')
            ->with('flight.destination_city')
            ->get();

        //return $offers;
        $data = [];
        $allData = [];
        foreach ($offers->toArray() as $offer) {
            $data['offer_id'] = $offer['id'];
            $data['source_city'] = $offer['flight']['source_city']['name'];
            $data['destination_city'] = $offer['flight']['destination_city']['name'];
            array_push($allData, $data);
        }

        return view('Admin.OffersManagement.Index',compact('allData'));
    }

    public function getCities($id)
    {
        $cities = City::where('country_id', $id)->pluck('name', 'id');

        return json_encode($cities);
        // return $city;
        //  return view('welcome',compact('countries'));
    }

    public function getDestCities($id)
    {
        $cities = City::where('country_id', $id)->pluck('name', 'id');

        return json_encode($cities);

    }


    //show destination flight & source flight & hotel
    public function showOfferDetails(Request $request)
    {
        $cities = City::where('id', $request->input('city'))
        ->get();

        return $cities;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->pluck('name', 'id');

        return view('Admin.OffersManagement.Add',compact('countries'));
    }

    public function completeOffer(Request $request)
    {
        $this->validate($request, [
            'city' => 'required',
            'country' => 'required',
            'destcity' => 'required',
            'destcountry' => 'required',
        ]);
        $flightDegrees = FlightDegree::all();
        $s_city = $request->input('city');
        $dest_city = $request->input('destcity');

        $source_city = City::where('id',$s_city)->first();
        $destination_city = City::where('id',$dest_city)->first();
        //return [$source_city,$destination_city];
        // search for cities that have name the same is source city name
        //$search_cities = City::where('name','LIKE','%'.$s_city->name.'%')->get();
        $search_flights = Flight::where([['source_city_id',$source_city->id],['destination_city_id',$destination_city->id]])
            ->with('source_city')
            ->with('destination_city')
            ->with('flight_company')
        ->get();
           // return $search_flights;
        $return_search_flights = Flight::where([['source_city_id',$destination_city->id],['destination_city_id',$source_city->id]])
            ->with('source_city')
            ->with('destination_city')
            ->with('flight_company')
            ->get();

        $hotels = Hotel::where('city_id',$destination_city->id)
            ->with(['hotel_room' =>function($query){
                $query->where('is_available',1);
            }])
            ->with('city')
            ->get();

       // return $hotels;
        $hotelData = [];
        $allHotelData = [];
        foreach ($hotels as $hotel) {
             $hotelData ['hotel_id'] = $hotel['id'];
             $hotelData ['hotel'] = $hotel['name'];
             $hotelData ['city'] = $hotel['city']->name;
             $hotelData ['country'] = $hotel['country']->name;
            foreach ($hotel['hotel_room'] as $value) {
                 $hotelData['hotel_room_id'] = $value->id;
                 $hotelData['hotel_room'] = $value->name;
                 $hotelData['customers_count'] = $value->customers_count;
                 $hotelData['details'] = $value->details;
                 $hotelData['night_price'] = $value->night_price;
                 $hotelData['hotel_room_type'] = $value->room_type->name;
                array_push($allHotelData,  $hotelData);
            }
           // return $allHotelData;
           // array_push($allHotelData,  $hotelData );
        }


        //return all flight for return journey
        $returnedData = [];
        $allReturnedData = [];
        foreach ($return_search_flights as $search_flight){
            $returnedData['flight_id'] = $search_flight['id'];
            $returnedData['date'] = $search_flight['date'];
            $returnedData['updated_time'] = $search_flight['updated_time'];
            $returnedData['first_class_seats_count'] = $search_flight['first_class_seats_count'];
            $returnedData['economy_seats_count'] = $search_flight['economy_seats_count'];
            $returnedData['economy_ticket_price'] = $search_flight['economy_ticket_price'];
            $returnedData['first_class_ticket_price'] = $search_flight['first_class_ticket_price'];
            $returnedData['source_city'] = $search_flight['source_city']->name;
            $returnedData['destination_city'] = $search_flight['destination_city']->name;
            $returnedData['flight_company'] = $search_flight['flight_company']->name;
            array_push($allReturnedData, $returnedData);
        }
        /*$search_flights = Flight::where('source_city_id',$source_city->id)
        ->where('destination_city_id',$destination_city->id)
            ->get();*/
        //dd($search_flights);

        //return all flight for going flight

            $data = [];
            $allData = [];
            foreach ($search_flights as $search_flight){
                $data['flight_id'] = $search_flight['id'];
                $data['date'] = $search_flight['date'];
                $data['updated_time'] = $search_flight['updated_time'];
                $data['first_class_seats_count'] = $search_flight['first_class_seats_count'];
                $data['economy_seats_count'] = $search_flight['economy_seats_count'];
                $data['economy_ticket_price'] = $search_flight['economy_ticket_price'];
                $data['first_class_ticket_price'] = $search_flight['first_class_ticket_price'];
                $data['source_city'] = $search_flight['source_city']->name;
                $data['destination_city'] = $search_flight['destination_city']->name;
                $data['flight_company'] = $search_flight['flight_company']->name;
                array_push($allData, $data);
            }

            //return $allData;
            return view('Admin.OffersManagement.AddOfferDetails',compact(['allData','allReturnedData','allHotelData','flightDegrees']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'seats_count' => 'required',
            'flight_degree' => 'required',
            'customers_count' => 'required',
            'flight' => 'required',
            'returned_flight' => 'required',
            'rooms' => 'required',
            'price' => 'required'
        ]);
        $offer = new Offer();
        $offer->customers_count = $request->input('customers_count');
        $offer->seats_number = $request->input('seats_count');
        $offer->flight_degree_id = $request->input('flight_degree');
        $offer->offer_duration = $request->input('offer_duration');
        $offer->details = $request->input('details');
        $offer->price = $request->input('price');
       // $offer->flight_status = $request->input('flight_degree');
        $flightVal =  $request->input('flight');
        $offer->flight_id = $flightVal;
        $returnedFlightVal =  $request->input('returned_flight');
        $offer->returned_flight_id = $returnedFlightVal;
       // $roomId =  $request->input('room');
        $rooms = $request->input('rooms');
        $offer->save();
        //return $rooms;
        foreach($rooms as $room){
            $offer_room = HotelRoom::where('id',$room)->first();
            $offer_room->offer_id = $offer->id;
            //$offer_room->offer_id = $offer->id;
            $offer_room->save();
            //return $offer_room;
         }
        //$roomId =  $request->input('services');
       // $room = HotelRoom::where('id',$roomId)->first();
      //  $offer->room_id = $roomId;
        //$offer->status = $request->input('flight') == 'true' ? 1 : 0;
        $offer->save();

        return redirect()->route('Offers.index')->with('success','تم إنشاء عرض سياحي جديد بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($offer_id)
    {
        $flightDegrees = FlightDegree::all();
        $editedOffer = Offer::findOrfail($offer_id);
        $offer = Offer::where('id',$offer_id)
            ->with('flight.flight_company')
            ->with('flight.source_city')
            ->with('flight.destination_city')
            ->with('returned_flight.flight_company')
            ->with('returned_flight.source_city')
            ->with('returned_flight.destination_city')
           // ->with('hotel.hotel_room.room_type')
           // ->with('hotel.city')
           // ->with('hotel.country')
            ->with('room.hotel')
                ->first();
     //  return $offer;
        $data = [];
        $hotel_data = [];

        $allData = [];


            $data['offer_id'] = $offer['id'];
            //$data['status'] = $offer['status'];
            $data['customers_count'] = $offer['customers_count'];
            $data['seats_number'] = $offer['seats_number'];
            $data['price'] = $offer['price'];
            $data['offer_duration'] = $offer['offer_duration'];
            $data['details'] = $offer['details'];
            $data['flight_degree'] = $offer->flight_degree->name;
            $data['flight_degree_id'] = $offer->flight_degree_id;

            //return $data;
            $data['flight_id'] = $offer['flight']['id'];
            $data['flight_source_city'] = $offer['flight']['source_city']['name'];
            $data['flight_destination_city'] = $offer['flight']['destination_city']['name'];
            $data['flight_date'] = $offer['flight']['date'];
            $data['flight_time'] = $offer['flight']['time'];
            $data['flight_company'] = $offer['flight']['flight_company']['name'];
            $data['flight_economy_seats_count'] = $offer['flight']['economy_seats_count'];
            $data['flight_first_class_seats_count'] = $offer['flight']['first_class_seats_count'];
            $data['flight_economy_ticket_price'] = $offer['flight']['economy_ticket_price'];
            $data['flight_first_class_ticket_price'] = $offer['flight']['first_class_ticket_price'];


            // return flight details
            $data['returned_flight_id'] = $offer['returned_flight']['id'];
            $data['returned_flight_source_city'] = $offer['returned_flight']['source_city']['name'];
            $data['returned_flight_destination_city'] = $offer['returned_flight']['destination_city']['name'];
            $data['returned_flight_date'] = $offer['returned_flight']['date'];
            $data['returned_flight_time'] = $offer['returned_flight']['time'];
            $data['returned_flight_company'] = $offer['returned_flight']['flight_company']['name'];
            $data['returned_flight_economy_seats_count'] = $offer['returned_flight']['economy_seats_count'];
            $data['returned_flight_first_class_seats_count'] = $offer['returned_flight']['first_class_seats_count'];
            $data['returned_flight_economy_ticket_price'] = $offer['returned_flight']['economy_ticket_price'];
            $data['returned_flight_first_class_ticket_price'] = $offer['returned_flight']['first_class_ticket_price'];
            // return $data;

            // hotel
            foreach ($offer->room as $roomValue) {

                $hotel_data['hotel_id'] = $roomValue['hotel']['id'];

                $hotel_data['hotel_name'] = $roomValue['hotel']['name'];
                $hotel_data['hotel_city'] =$roomValue['hotel']['city']['name'];
                $hotel_data['hotel_country'] = $roomValue['hotel']['country']['name'];
                $hotel_data['hotelRoom_id'] = $roomValue['id'];
                $hotel_data['hotelRoom_name'] = $roomValue['name'];
                $hotel_data['hotelRoom_customers_count'] = $roomValue['customers_count'];
                $hotel_data['hotelRoom_night_price'] = $roomValue['night_price'];
                $hotel_data['hotelRoom_type'] = $roomValue->room_type->name;

                $data['room'][] = $hotel_data;
            // array_push($data,$hotel_data);
            }

       // return $data;

        return view('Admin.OffersManagement.Update',compact('data','allData','flightDegrees'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $offer_id)
    {
        $this->validate($request, [
            //'flight' => 'required',
            //'returned_flight' => 'required',
            'seats_count' => 'required',
            'flight_degree' => 'required',
            'customers_count' => 'required',
          //  'room' => 'required'
           'price' => 'required'
        ]);
        $editedOffer = Offer::findOrfail($offer_id);
        $editedOffer->customers_count = $request->input('customers_count');
        $editedOffer->seats_number = $request->input('seats_count');
        $editedOffer->flight_degree_id = $request->input('flight_degree');
        $editedOffer->offer_duration = $request->input('offer_duration');
        $editedOffer->details = $request->input('details');
        $editedOffer->price = $request->input('price');

        $editedOffer->save();

        return redirect()->route('Offers.index')->with('success','تم تعديل العرض بنجاح');
    }

    public function delete($offer_id){
        $flightDegrees = FlightDegree::all();
        $editedOffer = Offer::findOrfail($offer_id);
        $offer = Offer::where('id',$offer_id)
            ->with('flight.flight_company')
            ->with('flight.source_city')
            ->with('flight.destination_city')
            ->with('returned_flight.flight_company')
            ->with('returned_flight.source_city')
            ->with('returned_flight.destination_city')
            //->with('hotel.hotel_room.room_type')
          //  ->with('hotel.city')
           // ->with('hotel.country')
          ->with('room.hotel')
            ->first();
        // return $offer;
        $data = [];
        $hotel_data = [];
        $allData = [];
        $data['offer_id'] = $offer['id'];
        //$data['status'] = $offer['status'];
        $data['customers_count'] = $offer['customers_count'];
        $data['seats_number'] = $offer['seats_number'];
        $data['price'] = $offer['price'];
        $data['offer_duration'] = $offer['offer_duration'];
        $data['details'] = $offer['details'];
        $data['flight_degree'] = $offer->flight_degree->name;
        $data['flight_degree_id'] = $offer->flight_degree_id;

        //return $data;
        $data['flight_id'] = $offer['flight']['id'];
        $data['flight_source_city'] = $offer['flight']['source_city']['name'];
        $data['flight_destination_city'] = $offer['flight']['destination_city']['name'];
        $data['flight_date'] = $offer['flight']['date'];
        $data['flight_time'] = $offer['flight']['time'];
        $data['flight_company'] = $offer['flight']['flight_company']['name'];
        $data['flight_economy_seats_count'] = $offer['flight']['economy_seats_count'];
        $data['flight_first_class_seats_count'] = $offer['flight']['first_class_seats_count'];
        $data['flight_economy_ticket_price'] = $offer['flight']['economy_ticket_price'];
        $data['flight_first_class_ticket_price'] = $offer['flight']['first_class_ticket_price'];


        // return flight details
        $data['returned_flight_id'] = $offer['returned_flight']['id'];
        $data['returned_flight_source_city'] = $offer['returned_flight']['source_city']['name'];
        $data['returned_flight_destination_city'] = $offer['returned_flight']['destination_city']['name'];
        $data['returned_flight_date'] = $offer['returned_flight']['date'];
        $data['returned_flight_time'] = $offer['returned_flight']['time'];
        $data['returned_flight_company'] = $offer['returned_flight']['flight_company']['name'];
        $data['returned_flight_economy_seats_count'] = $offer['returned_flight']['economy_seats_count'];
        $data['returned_flight_first_class_seats_count'] = $offer['returned_flight']['first_class_seats_count'];
        $data['returned_flight_economy_ticket_price'] = $offer['returned_flight']['economy_ticket_price'];
        $data['returned_flight_first_class_ticket_price'] = $offer['returned_flight']['first_class_ticket_price'];
        // return $data;

        // hotel
        foreach ($offer->room as $roomValue) {

            $hotel_data['hotel_id'] = $roomValue['hotel']['id'];

            $hotel_data['hotel_name'] = $roomValue['hotel']['name'];
            $hotel_data['hotel_city'] =$roomValue['hotel']['city']['name'];
            $hotel_data['hotel_country'] = $roomValue['hotel']['country']['name'];
            $hotel_data['hotelRoom_id'] = $roomValue['id'];
            $hotel_data['hotelRoom_name'] = $roomValue['name'];
            $hotel_data['hotelRoom_customers_count'] = $roomValue['customers_count'];
            $hotel_data['hotelRoom_night_price'] = $roomValue['night_price'];
            $hotel_data['hotelRoom_type'] = $roomValue->room_type->name;

            $data['room'][] = $hotel_data;
            // array_push($data,$hotel_data);
        }

        // return $data;
        // return $allData;
        return view('Admin.OffersManagement.Delete',compact('data','flightDegrees'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($offer_id)
    {
        $offer = Offer::where('id',$offer_id)
            ->first();

        $offer->delete();

        return redirect()->route('Offers.index')->with('success','تمت عملية الحذف بنجاح');
    }
}
