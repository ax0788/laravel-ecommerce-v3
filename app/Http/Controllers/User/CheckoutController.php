<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\ShippingDistrict;
use App\Models\ShippingState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function StateAjax($country_id)
    {
        $shipping_state = ShippingState::where('country_id', $country_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($shipping_state);
    }

    public function DistrictAjax($state_id)
    {
        $shipping_district = ShippingDistrict::where('state_id', $state_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($shipping_district);
    }

    public function CheckoutStore(Request $request)
    {
        $data = array();
        $data['country_id'] = $request->country_id;
        $data['state_id'] = $request->state_id;
        $data['district_id'] = $request->district_id;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::subtotalFloat();

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } elseif ($request->payment_method == 'card') {
            return view('frontend.payment.card', compact('data'));
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    }
}
