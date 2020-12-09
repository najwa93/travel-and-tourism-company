<?php

namespace App\Http\Controllers\Admin\CountryController;

use App\Models\Admin\City\City;
use App\Models\Admin\Country\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('Role:Admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('Admin.CountryManagement.Index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CountryManagement.Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'countryname' => 'required|string',
            'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $countries = Country::all();
        $checkCountry = $request->input('countryname');
        if ($countries != null | []) {
            foreach ($countries as $country) {
                if ($checkCountry == $country->name) {
                    return redirect()->back()->with('error', 'لقد تم إضافة هذا البلد مسبقاً');
                }
            }
        }
        $country = new Country();
        if ($request->hasFile('image')) {
            $flagImg = $request->file('image');
            $resize_image = Image::make($flagImg->getRealPath());
            $destinationPath ='images/';
           // return $destinationPath;
            $image_name = $flagImg->getClientOriginalName();

            $resize_image->resize(500, 500, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath . 'flag/' . $image_name);
          //  $path = $flagImg->storeAs('flag', $flagImg->getClientOriginalName(), 'images');
            $country->img_path =  $destinationPath.'flag/' . $image_name;
        }

        $country->name = $request->input('countryname');


        $country->save();
        return redirect()->route('Countries.index')->with('success', 'تم إضافة بلد جديد بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($country_id)
    {
        $country = Country::where('id', $country_id)
            ->with('city')
            ->first();
        //return $country;
        $data = [];
        $allData = [];
        $data['country'] = $country['name'];
        foreach ($country['city'] as $value) {
            $data['city_id'] = $value['id'];
            $data['city'] = $value['name'];
            array_push($allData, $data);
        }

        //return $allData;
        return view('Admin.CountryManagement.Show', compact(['allData', 'country']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($country_id)
    {
        $country = Country::findOrfail($country_id);
        return view('Admin.CountryManagement.Update', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $country_id)
    {
        $country = Country::findOrfail($country_id);


        $this->validate($request, [
            'countryname' => 'required|string',
        ]);
    /*    $countries = Country::all();
        $checkCountry = $request->input('countryname');
        if ($countries != null | []) {
            foreach ($countries as $country) {
                if ($checkCountry == $country->name) {
                    return redirect()->back()->with('error', 'لقد تم إضافة هذا البلد مسبقاً');
                }
            }
        }*/


        $country->name = $request->input('countryname');
        if ($request->hasFile('image')) {
            unlink( $country->img_path);
            $flagImg = $request->file('image');
            $resize_image = Image::make($flagImg->getRealPath());
            $destinationPath ='images/';
            // return $destinationPath;
            $image_name = $flagImg->getClientOriginalName();

            $resize_image->resize(150, 140, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath . 'flag/' . $image_name);
            //  $path = $flagImg->storeAs('flag', $flagImg->getClientOriginalName(), 'images');
            $country->img_path =  $destinationPath.'flag/' . $image_name;
        }

        $country->save();
       // return $country;
        return redirect()->route('Countries.index')->with('success', 'تم تعديل بلد بنجاح');
    }

    public function delete($country_id)
    {
        $country = Country::findOrfail($country_id);

        return view('Admin.CountryManagement.Delete', compact('country'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($country_id)
    {
        $country = Country::findOrfail($country_id);
        if ($country->img_path != null) {
            $flagImg = unlink($country->img_path);
        }

//        $cities = City::where('country_id',$country->id)->get();
//
//        $country->city()->delete();
       // $country->city()->hotel()->delete();
      //  $country->hotel()->delete();
        $country->delete();

        return redirect()->route('Countries.index')->with('success', 'تم حذف بلد بنجاح');;

    }
}
