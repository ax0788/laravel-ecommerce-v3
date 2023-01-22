<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{
      // Pending Orders
      public function Pending()
      {
          $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
          return view('admin.orders.pending', compact('orders'));
      } // end mehtod


      // Pending Order Details
      public function Details($order_id)
      {
          $order = Order::with('country', 'state', 'district', 'user')->where('id', $order_id)->first();
          $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
          return view('admin.orders.details', compact('order', 'orderItem'));
      } // end method

      // Confirmed Orders
      public function Confirmed()
      {
          $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
          return view('admin.orders.confirmed', compact('orders'));
      } // end mehtod

      // Processing Orders
      public function Processed()
      {
          $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
          return view('admin.orders.processed', compact('orders'));
      } // end mehtod

      // Picked Orders
      public function Picked()
      {
          $orders = Order::where('status', 'picked')->orderBy('id', 'DESC')->get();
          return view('admin.orders.picked', compact('orders'));
      } // end mehtod

      // Shipped Orders
      public function Shipped()
      {
          $orders = Order::where('status', 'shipped')->orderBy('id', 'DESC')->get();
          return view('admin.orders.shipped', compact('orders'));
      } // end mehtod


      // Delivered Orders
      public function Delivered()
      {
          $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
          return view('admin.orders.delivered', compact('orders'));
      } // end mehtod


      // Cancel Orders
      public function Canceled()
      {
          $orders = Order::where('status', 'cancel')->orderBy('id', 'DESC')->get();
          return view('admin.orders.canceled', compact('orders'));
      } // end mehtod



      //Update Order Status
      public function PendingToConfirm($order_id)
      {

          Order::findOrFail($order_id)->update(['status' => 'confirmed']);

          $notification = array(
              'message' => 'Order Confirmed Successfully!',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.orders.confirmed')->with($notification);
      } // end method





      public function ConfirmToProcessing($order_id)
      {

          Order::findOrFail($order_id)->update(['status' => 'processing']);

          $notification = array(
              'message' => 'Order Processing Started Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.orders.processing')->with($notification);
      } // end method



      public function ProcessingToPicked($order_id)
      {

          Order::findOrFail($order_id)->update(['status' => 'picked']);

          $notification = array(
              'message' => 'Order Picked Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.orders.picked')->with($notification);
      } // end method


      public function PickedToShipped($order_id)
      {

          Order::findOrFail($order_id)->update(['status' => 'shipped']);

          $notification = array(
              'message' => 'Order Shipped Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.orders.shipped')->with($notification);
      } // end method


      public function ShippedToDelivered($order_id)
      {

          $product = OrderItem::where('order_id', $order_id)->get();
          foreach ($product as $item) {
              Product::where('id', $item->product_id)
                  ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
          }

          Order::findOrFail($order_id)->update(['status' => 'delivered']);

          $notification = array(
              'message' => 'Order Delivered Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.orders.delivered')->with($notification);
      } // end method

      public function Invoice($order_id)
      {

          $order = Order::with('country', 'state', 'district', 'user')->where('id', $order_id)->first();
          $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
          $pdf = app('dompdf.wrapper');
          $pdf->loadView('admin.orders.invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
              'tempDir' => public_path(),
              'chroot' => public_path(),
          ]);
          return $pdf->download('invoice.pdf');
      } // end method

}