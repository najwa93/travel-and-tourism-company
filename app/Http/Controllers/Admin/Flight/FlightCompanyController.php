<?php

namespace App\Http\Controllers\Admin\Flight;

use App\Models\Admin\Flight\FlightCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightCompanyController extends Controller
{

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
        return view('Admin.FlightsManagement.FlightCompanyManagement.Add');
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
            //'email' =>  ['string', 'email', 'max:255', 'unique:users'],
            'name' => 'required',
        ]);

        $flightCompany = new FlightCompany();
        $flightCompany->name = $request->input('name');
        $flightCompany->email = $request->input('email');
        $flightCompany->phone_number = $request->input('phone_number');

        $flightCompany->save();

        return redirect()->route('Flights.index')->with('success','تم إضافة شركة طيران جديدة بنجاح');
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
    public function edit($flight_company_id)
    {
        $flightCompany = FlightCompany::where('id',$flight_company_id)
            ->first();

        return view('Admin.FlightsManagement.FlightCompanyManagement.Update',compact(['flightCompany']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $flight_company_id)
    {
        $this->validate($request, [
            'email' =>  'string', 'email', 'max:255', 'unique:users',
            'name' => 'required',
        ]);
        $flightCompany = FlightCompany::where('id',$flight_company_id)
            ->first();
        $flightCompany->name = $request->input('name');
        $flightCompany->email = $request->input('email');
        $flightCompany->phone_number = $request->input('phone_number');

        $flightCompany->save();

        return redirect()->route('Flights.index')->with('success','تم تعديل شركة طيران بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($flight_company_id){
        $flightCompany = FlightCompany::where('id',$flight_company_id)
            ->first();

        return view('Admin.FlightsManagement.FlightCompanyManagement.Delete',compact(['flightCompany']));
    }

    public function destroy($flight_company_id)
    {
        $flight_company = FlightCompany::where('id',$flight_company_id)
            ->first();

        $flight_company->delete();

        return redirect()->route('Flights.index')->with('success','تم حذف شركة طيران بنجاح');;
    }
}
