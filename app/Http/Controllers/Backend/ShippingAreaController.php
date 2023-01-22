<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCountry;
use App\Models\ShippingState;
use App\Models\ShippingDistrict;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function CountryIndex()
    {
        $countries = ShippingCountry::orderBy('id', 'DESC')->get();
        return view('admin.ship.country.index', compact('countries'));
    }

    public function CountryStore(Request $request)
    {
        $request->validate(
            [
                'country_name' => 'required',
            ],
        );

        ShippingCountry::insert([
            'country_name' => $request->country_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Country Added Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }


    public function CountryEdit($id)
    {
        $country = ShippingCountry::findOrFail($id);
        return view('admin.ship.country.edit', compact('country'));
    }

    public function  CountryUpdate(Request $request, $id)
    {
        ShippingCountry::findOrFail($id)->update([
            'country_name' => $request->country_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => ' Country Updated Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->route('admin.manage-country')->with($notification);
    }

    public function  CountryDelete($id)
    {
        ShippingCountry::findOrFail($id)->delete();
        $notification = array(
            'message' => ' Country Deleted Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }


    // Shipping State (previously District)

    public function StateView()
    {
        $countries = ShippingCountry::orderBy('country_name', 'ASC')->get();
        $state = ShippingState::with('country')->orderBy('id', 'DESC')->get();
        return view('admin.ship.state.index', compact('countries', 'state'));
    }


    public function stateStore(Request $request)
    {
        $request->validate(
            [
                'country_id' => 'required',
                'state_name' => 'required',
            ],
        );

        ShippingState::insert([
            'country_id' => $request->country_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'State Added Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }

    public function StateEdit($id)
    {
        $country = ShippingCountry::orderBy('country_name', 'ASC')->get();
        $state = ShippingState::findOrFail($id);
        return view('admin.ship.state.edit', compact('country', 'state'));
    }

    public function StateUpdate(Request $request, $id)
    {
        ShippingState::findOrFail($id)->update([
            'country_id' => $request->country_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'State Updated Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->route('admin.state.index')->with($notification);
    }


    public function StateDelete($id)
    {
        ShippingState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Deleted Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }

    //    Shipping District (previously State)
    public function DistrictView()
    {
        $country = ShippingCountry::orderBy('country_name', 'ASC')->get();
        $state = ShippingState::orderBy('state_name', 'ASC')->get();
        $district = ShippingDistrict::with('country', 'state')->orderBy('id', 'DESC')->get();


        return view('admin.ship.district.index', compact('country', 'state', 'district'));
    }

    public function DistrictStore(Request $request)
    {
        $request->validate(
            [
                'country_id' => 'required',
                'state_id' => 'required',
                'district_name' => 'required',
            ],
        );

        ShippingDistrict::insert([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Added Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }

    public function DistrictEdit($id)
    {
        $country = ShippingCountry::orderBy('country_name', 'ASC')->get();
        $state = ShippingState::orderBy('state_name', 'ASC')->get();
        $district = ShippingDistrict::findOrFail($id);
        return view('admin.ship.district.edit', compact('country', 'state', 'district'));
    }

    public function DistrictUpdate(Request $request, $id)
    {
        ShippingDistrict::findOrFail($id)->update([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Updated Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->route('admin.district.index')->with($notification);
    }

    public function DistrictDelete($id)
    {
        ShippingDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Deleted Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }

}
