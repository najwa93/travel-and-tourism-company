<?php

namespace App\Http\Controllers\Admin\Flight;

use App\Models\Admin\City\City;
use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Flight\FlightCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class FlightController extends Controller
{
    public function __construct()
    {
        $this->middleware('Role:Admin,Flight_Manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flightCompanies = FlightCompany::all();

        $flights = Flight::with('source_city')
            ->with('destination_city')
            ->with('flight_company')
            ->get();

        $data = [];
        $allData = [];
        foreach ($flights as $flight) {
            $data['flight_id'] = $flight['id'];
            $data['date'] = $flight['date'];
            $data['updated_time'] = $flight['updated_time'];
            $data['first_class_seats_count'] = $flight['first_class_seats_count'];
            $data['economy_seats_count'] = $flight['economy_seats_count'];
            $data['economy_ticket_price'] = $flight['economy_ticket_price'];
            $data['first_class_ticket_price'] = $flight['first_class_ticket_price'];
            $data['source_city'] = $flight['source_city']->name;
            $data['destination_city'] = $flight['destination_city']->name;
            $data['flight_company'] = $flight['flight_company']->name;
            array_push($allData, $data);
        }


        return view('Admin.FlightsManagement.FlightManagement.Index',compact(['flightCompanies','allData']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all()->pluck('name','id');
        $flightCompanies = FlightCompany::all()->pluck('name','id');
        return view('Admin.FlightsManagement.FlightManagement.Add',compact(['cities','flightCompanies']));
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
            'source_city' => 'required',
            'dist_city' => 'required',
            'flight_company' => 'required',
            'economy_seats_count' => 'required',
            'first_class_seats_count' => 'required',
            'datepicker' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'first_class_ticket_price' => 'required',
            'economy_ticket_price' => 'required',
        ]);
        $flight = new Flight();
        $flight->source_city_id = $request->input('source_city');
        $flight->destination_city_id = $request->input('dist_city');
        $flight->flight_company_id = $request->input('flight_company');
        $flight->economy_seats_count = $request->input('economy_seats_count');
        $flight->first_class_seats_count = $request->input('first_class_seats_count');
        $flight->flight_duration = $request->input('duration');
        $flight->date = $request->input('datepicker');
        //$time = $request->input('time');
        //$converted_time = date("h:ia", strtotime($time));
        $flight->time = $request->input('time');
        $flight->updated_time = date("h:ia", strtotime($flight->time));
        $flight->economy_ticket_price = $request->input('economy_ticket_price');
        $flight->first_class_ticket_price = $request->input('first_class_ticket_price');

        $flight->save();

         return redirect()->route('Flights.index')->with('success','تم إضافة رحلة جديدة بنجاح');

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
    public function edit($flight_id)
    {
        $flight = Flight::where('id',$flight_id)
            ->with('destination_city')
            ->with('flight_company')
            ->first();;
        //return $flight;
        $cities = City::all()->pluck('name','id');
        $flightCompanies = FlightCompany::all()->pluck('name','id');
        return view('Admin.FlightsManagement.FlightManagement.Update',compact(['flight','cities','flightCompanies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $flight_id)
    {
        $this->validate($request, [
            'source_city' => 'required',
            'dist_city' => 'required',
            'flight_company' => 'required',
            'economy_seats_count' => 'required',
            'first_class_seats_count' => 'required',
            'datepicker' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'first_class_ticket_price' => 'required',
            'economy_ticket_price' => 'required',
        ]);
        $flight = Flight::where('id',$flight_id)
            ->first();

        $flight->source_city_id = $request->input('source_city');
        $flight->destination_city_id = $request->input('dist_city');
        $flight->flight_company_id = $request->input('flight_company');
        $flight->economy_seats_count = $request->input('economy_seats_count');
        $flight->first_class_seats_count = $request->input('first_class_seats_count');
        $flight->flight_duration = $request->input('duration');
        $flight->date = $request->input('datepicker');
        $time = $request->input('time');
        $flight->time = $request->input('time');
        $flight->updated_time = date("h:ia", strtotime($flight->time));
        $flight->economy_ticket_price = $request->input('economy_ticket_price');
        $flight->first_class_ticket_price = $request->input('first_class_ticket_price');

        $flight->save();

        return redirect()->route('Flights.index')->with('success','تم تعديل رحلة طيران بنجاح');;
    }

    public function delete($flight_id){
        $flight = Flight::where('id',$flight_id)
            ->with('destination_city')
            ->with('flight_company')
            ->first();

       // return $flight;
        $cities = City::all()->pluck('name','id');
        $flightCompanies = FlightCompany::all()->pluck('name','id');
        return view('Admin.FlightsManagement.FlightManagement.Delete',compact(['flight','cities','flightCompanies']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($flight_id)
    {
        $flight = Flight::where('id',$flight_id)
            ->first();
        $flight->delete();
        return redirect()->route('Flights.index')->with('success','تمت عملية الحذف بنجاح');
    }
}
