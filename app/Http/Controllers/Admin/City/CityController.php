<?php

namespace App\Http\Controllers\Admin\City;

use App\Models\Admin\City\City;
use App\Models\Admin\City\CityImage;
use App\Models\Admin\Country\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Location;
use PHPUnit\Framework\Constraint\Count;

class CityController extends Controller
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

    // get cities with related country
    public function getCity($country_id)
    {
        $country = Country::findOrfail($country_id);

        return view('Admin.CityManagement.Add', compact('country'));
    }

    // get cities with related country
    public function storeCity(Request $request, $country_id)
    {
        $this->validate($request, [
            'cityname' => 'required|string',
            'location' => 'required',
            'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $country = Country::findOrfail($country_id);
        $cities = City::all();
        $checkCity = $request->input('cityname');
        if ($cities != null | []) {
            foreach ($cities as $city) {
                if ($checkCity == $city->name) {
                    return redirect()->back()->with('error', 'لقد تم إضافة هذه المدينة مسبقاً');
                }
            }
        }
        $city = new City();
        $city->name = $request->input('cityname');
        $city->description = $request->input('aboutcity');
        $city->city_location = $request->input('location');
        $city->country_id = $country->id;
        $city->save();
        // Save multiple photos in the database
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $resize_image = Image::make($image->getRealPath());
                $destinationPath ='images/';
                // return $destinationPath;
                $image_name = $image->getClientOriginalName();

                $resize_image->resize(150, 140, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . 'cities/' . $image_name);
                //  $path = $flagImg->storeAs('flag', $flagImg->getClientOriginalName(), 'images');

                $image = new CityImage();
                $image->img_path =  $destinationPath.'cities/' . $image_name;;
                $image->city_id = $city->id;
                $image->save();
            }
        }

        return redirect()->route('Countries.show', $country->id)->with('success', 'تم إضافة مدينة جديدة بنجاح');
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
    public function edit($city_id)
    {
        $city = City::findOrfail($city_id);
        $cityImgs = CityImage::where('city_id', $city->id)
            ->get();

        return view('Admin.CityManagement.Update', compact(['city', 'cityImgs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $city_id)
    {

        $this->validate($request, [
            'cityname' => 'required|string',
            'location' => 'required'
        ]);
        $city = City::findOrfail($city_id);
        $country = Country::where('id', $city->country_id)->first();
        $cityImgs = CityImage::where('city_id', $city->id)
            ->get();
        $city->name = $request->input('cityname');
        $city->description = $request->input('aboutcity');
        $city->city_location = $request->input('location');
        $city->save();



        // Save multiple photos in the database
        if ($request->hasFile('images')) {
            foreach ($cityImgs as $cityImage) {
                unlink($cityImage->img_path);
                $cityImage->delete();
            }
            foreach ($request->images as $image) {
                $resize_image = Image::make($image->getRealPath());
                $destinationPath ='images/';
                // return $destinationPath;
                $image_name = $image->getClientOriginalName();

                $resize_image->resize(350, 340, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . 'cities/' . $image_name);
                //  $path = $flagImg->storeAs('flag', $flagImg->getClientOriginalName(), 'images');

                $image = new CityImage();
                $image->img_path =  $destinationPath.'cities/' . $image_name;
                $image->city_id = $city->id;
                $image->save();
            }

        }
           // return $city;
        return redirect()->route('Countries.show', $country->id)->with('success','تم تعديل مدينة بنجاح');
    }

    public function storeLocation(Request $request)
    {
        //abort_unless(\Gate::allows('company_create'), 403);
        $location = Location::create($request->all());
       // return redirect()->route('admin.companies.index');
    }

    public function delete($city_id){
        $city = City::findOrfail($city_id);
        $cityImgs = CityImage::where('city_id',$city_id)
            ->get();
        return view('Admin.CityManagement.Delete',compact('city','cityImgs'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($city_id)
    {
        $city = City::findOrfail($city_id);
        $country = Country::where('id', $city->country_id)->first();
        $cityImgs = CityImage::where('city_id',$city_id)
            ->get();
        foreach ($cityImgs as $cityImage) {
            unlink($cityImage->img_path);
            $cityImage->delete();
        }
        $city->delete();

        return redirect()->route('Countries.show', $country->id)->with('success','تم حذف مدينة بنجاح');
    }
}
