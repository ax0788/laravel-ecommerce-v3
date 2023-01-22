<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class AllOrderController extends Controller
{
    public function MyOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.account.order.index', compact('orders'));
    }

    public function OrderDetails($order_id)
    {
        $order = Order::with('country', 'state', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.account.order.details', compact('order', 'orderItem'));
    } // end mehtod

    public function InvoiceDownload($order_id)
    {

        $order = Order::with('country', 'state', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.order_invoice', compact('order', 'orderItem'));
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('frontend.account.order.invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function ReturnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            // 'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Sent Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('orders.index')->with($notification);
    } // end method


    public function ReturnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.account.order.returned', compact('orders'));
    } // end method

    public function CancelOrders()
    {
        $orders = Order::where('user_id', Auth::id())->where('status', 'cancel')->orderBy('id', 'DESC')->get();
        return view('frontend.account.order.canceled', compact('orders'));
    } // end method

}