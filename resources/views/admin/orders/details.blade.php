@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-6">
   <div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
     <div class="card-title">
      <h3 class="card-label">
       Shipping Details
      </h3>
     </div>
    </div>

    <div class="card-body">
     <!--begin: Datatable-->
     <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
      <tbody>
       <tr>
        <th> Shipping Name : </th>
        <th> {{ $order->user->first_name }} </th>
       </tr>

       <tr>
        <th> Shipping Phone : </th>
        <th> {{ $order->phone }} </th>
       </tr>

       <tr>
        <th> Shipping Email : </th>
        <th> {{ $order->email }} </th>
       </tr>

       <tr>
        <th> Country : </th>
        <th> {{ $order->country->country_name }} </th>
       </tr>


       <tr>
        <th> State : </th>
        <th>{{ $order->state->state_name }} </th>
       </tr>

       <tr>
        <th> District : </th>
        <th> {{ $order->district->district_name }} </th>
       </tr>

       <tr>
        <th> Post Code : </th>
        <th> {{ $order->post_code }} </th>
       </tr>

       <tr>
        <th> Order Date : </th>
        <th> {{ $order->order_date }} </th>
       </tr>

      </tbody>

     </table>
     <!--end: Datatable-->
    </div>
   </div>
  </div>






  <div class="col-md-6">
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
         <div class="card-title">
          <h3 class="card-label">
            Order Details
          </h3>
         </div>
        </div>

        <div class="card-body">
         <!--begin: Datatable-->
         <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
        <tbody>
            <tr>
             <th> Invoice No: </th>
             <th class="text-danger"> {{ $order->invoice_no }} </th>
            </tr>
               <tr>
                <th> Payment Method : </th>
                <th> {{ $order->payment_method }} </th>
               </tr>

               <tr>
                <th> Transaction ID : </th>
                <th> {{ $order->transaction_id }} </th>
               </tr>


               <tr>
                <th> Order Total : </th>
                <th>${{ $order->amount }} </th>
               </tr>

               <tr>
                <th> Order : </th>
                <th>
                 <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span>
                </th>
               </tr>


               <tr>
                <th> </th>
                <th>
                 @if ($order->status == 'pending')
                  <a href="{{ route('admin.orders.confirming', $order->id) }}" class="btn btn-block btn-success"
                   id="confirm">Confirm
                   Order</a>
                 @elseif($order->status == 'confirmed')
                  <a href="{{ route('admin.orders.processing', $order->id) }}" class="btn btn-block btn-success"
                   id="processing">Start Processing Order</a>
                 @elseif($order->status == 'processing')
                  <a href="{{ route('admin.orders.picking', $order->id) }}" class="btn btn-block btn-success"
                   id="picked">Start Picking Order</a>
                 @elseif($order->status == 'picked')
                  <a href="{{ route('admin.orders.shipping', $order->id) }}" class="btn btn-block btn-success" id="shipped">Start Shipping
                   Order</a>
                 @elseif($order->status == 'shipped')
                  <a href="{{ route('admin.orders.delivering', $order->id) }}" class="btn btn-block btn-success"
                   id="delivered">Delivered</a>
                 @endif

                </th>
               </tr>



        </tbody>

         </table>
         <!--end: Datatable-->
        </div>
       </div>
  </div>






  <div class="col-md-12 col-12">
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
         <div class="card-title">
          <h3 class="card-label">
           Product Details
          </h3>
         </div>
        </div>

        <div class="card-body">
         <!--begin: Datatable-->
         <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
      <tbody>

        <tr>
            <td width="10%">
             <label for=""> Image</label>
            </td>

            <td width="20%">
             <label for=""> Product Name </label>
            </td>

            <td width="10%">
             <label for=""> Product Code</label>
            </td>


            <td width="10%">
             <label for=""> Color </label>
            </td>

            <td width="10%">
             <label for=""> Size </label>
            </td>

            <td width="10%">
             <label for=""> Quantity </label>
            </td>

            <td width="10%">
             <label for=""> Price </label>
            </td>

           </tr>


           @foreach ($orderItem as $item)
            <tr>
             <td width="10%">
              <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" height="50px;"
                width="50px;"> </label>
             </td>

             <td width="20%">
              <label for=""> {{ $item->product->product_name_en }}</label>
             </td>


             <td width="10%">
              <label for=""> {{ $item->product->product_code }}</label>
             </td>

             <td width="10%">
              <label for=""> {{ $item->color }}</label>
             </td>

             <td width="10%">
              <label for=""> {{ $item->size }}</label>
             </td>

             <td width="10%">
              <label for=""> {{ $item->qty }}</label>
             </td>

             <td width="10%">
              <label for=""> ${{ $item->price }} ( $ {{ $item->price * $item->qty }} ) </label>
             </td>

            </tr>
           @endforeach
      </tbody>

         </table>
         <!--end: Datatable-->
        </div>
       </div>
   </div> <!--  // cod md -12 -->
 </div>
@endsection
