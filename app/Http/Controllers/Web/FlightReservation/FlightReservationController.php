<?php

namespace App\Http\Controllers\Web\FlightReservation;

use App\Models\Admin\Country\Country;
use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Flight\FlightDegree;
use App\Models\User\FlightReservation\FlightReservation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FlightReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['flightDetails']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    // search flights function
    public function searchFlights(Request $request){

        $this->validate($request, [
            'source_city' => 'required|alpha',
            'destination_city' => 'required|alpha',
            'datepicker-f' => 'required',
            'flight_degree' => 'required'
        ]);

        $request->session()->put('customers_count',$request->input('customers_count'));
       // $request->session()->put('source_city',$request->input('source_city'));
       // $request->session()->put('destination_city',$request->input('destination_city'));
        $request->session()->put('date',$request->input('date'));
        $request->session()->put('customers_count',$request->input('customers_count'));
        $request->session()->put('flight_degree',$request->input('flight_degree'));
        //return($request->session()->get('checkin'));


        $source_city = $request->input('source_city');
        $destination_city = $request->input('destination_city');
       // $customers_count = $request->input('customers_count');
        $degree = $request->input('flight_degree');
        $flight_degree = FlightDegree::where('id',$degree)->first();
       // return $flight_degree;
        $date = $request->input('datepicker-f');
       // return $date;
     /*   $flights = Flight::where('date','=',$date)
            ->get();

        return $flights;*/
          $flights = Flight::where('date','like','%' .$date. '%')
            ->whereHas('source_city' , function($query) use ($source_city){
                $query->where('name','like','%' .$source_city . '%');
            })
                ->whereHas('destination_city', function($query) use ($destination_city){
                    $query->where('name','like','%' .$destination_city . '%');
                })
                ->get();

          if ($flights == null){
                  // return "hello";
                  return redirect()->back()->with('error', 'يرجى إدخال تاريخ الوصول بشكل صحيح');
          }

        $data = [];
        $flight_data = [];
        foreach ($flights as $flight){
            $data['flight_id'] = $flight->id;
            $data['source_city'] = $flight->source_city->name;
            $data['destination_city'] = $flight->destination_city->name;
            $data['date'] = $flight->date;
            $data['time'] = $flight->updated_time;
            if ($flight_degree->id == 1){
                $data['ticket_price'] = $flight->first_class_ticket_price;
            }else{
                $data['ticket_price'] = $flight->economy_ticket_price;
            }
            array_push($flight_data,$data);
        }

        return view('Web.Search.Flight.searchFlight',compact('flight_data'));
    }
   // Flight Reservation view
    public function flightDetails($flightId){
        if (Auth::user()){
            $user = Auth::user();
            //$country = Country::where('id',$user->country_id)->first();
            $flight = Flight::where('id',$flightId)->first();
            //return $user;
            return view('Web.Search.Flight.CompleteReservation',compact('user','flight'));
        }else{
            return redirect()->intended();
        }
    }

    // Flight Reservation
    public function completeFlightReservation(Request $request,$flightId){
        $this->validate($request, ['credit' => 'required', 'credit_number' => 'required|numeric|min:0']);
        if (Auth::user()){
            $user = Auth::user();

            $flight = Flight::where('id',$flightId)->first();
            $user->credit = $request->input('credit');
            $userBalance = $request->input('credit_number');
            $flight_degree = Session::get('flight_degree');

            if ($flight_degree == 1){
                $reservation_price = $flight->first_class_ticket_price;
            }else{
                $reservation_price = $flight->economy_ticket_price;
            }
            if ($userBalance < $reservation_price) {
                return redirect()->back()->with('error', 'الرصيد غيركافي لعملية الحجز');
            }
            $flightCheck = FlightReservation::where('user_id',$user->id)->get();
            //return $flightCheck;
            foreach ($flightCheck as $check){
                if ($check->flight_id == $flight->id ){
                    return redirect()->back()->with('error','لقد قمت بعملية الحجز مسبقا');
                }
            }
            $flightReservation = new FlightReservation();
            $flightReservation->user_id = Auth::user()->id;
            $seats_count = Session::get('customers_count');
            $flightReservation->flight_id = $flight->id;
            $flightReservation->seats_count = $seats_count;
            $flightReservation->date = $flight->date;
            $flightReservation->time = $flight->time;

            if ($flight_degree == 1){
            $flightReservation->reservation_price = $flight->first_class_ticket_price;
            $flightReservation->flight_degree_id = 1;
            }else{
                $flightReservation->reservation_price = $flight->economy_ticket_price;
                $flightReservation->flight_degree_id = 2;
            }
            $flightReservation->save();

            $ticket_price = $flightReservation->reservation_price;
            $balance = $request->input('credit_number');

            $user->credit_balance = $balance - $ticket_price;
            $user->credit_balance = $balance - $ticket_price;
            $user->save();
            $flightReservation->save();
            //$hotelReservation->check_in_date = $request->session()->get('checkin');
            return redirect()->route('showUserReservations')->with('success', 'تمت عملية حجز رحلة الطيران بنجاح');

        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
