@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-12">
   <!--begin::Card-->
   <div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
     <div class="card-title">
      <h3 class="card-label">
        Processing Orders List
      </h3>
     </div>
    </div>

    <div class="card-body">
     <!--begin: Datatable-->
     <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
      <thead>
       <tr>
        <th>Date </th>
        <th>Invoice </th>
        <th>Amount </th>
        <th>Payment </th>
        <th>Status </th>
        <th>Action</th>
       </tr>
      </thead>
      <tbody>
       @foreach ($orders as $item)
        <tr>
         <td> {{ $item->order_date }} </td>
         <td> {{ $item->invoice_no }} </td>
         <td> ${{ $item->amount }} </td>
         <td> {{ $item->payment_method }} </td>
         <td> <span class="badge badge-pill badge-primary">{{ $item->status }} </span> </td>
         <td class="d-flex">
          <a href="{{ route('admin.orders.details', $item->id) }}" class="btn btn-info btn-md btn-clean btn-icon"
           title="Details"><i class="fa fa-eye"></i></a>
           <a target="_blank" href="{{ route('admin.orders.invoice', $item->id) }}" class="btn btn-danger btn-md btn-clean btn-icon ml-2"
            title="Download Invoice">
            <i class="fa fa-download"></i></a>

         </td>
        </tr>
       @endforeach
      </tbody>

     </table>
     <!--end: Datatable-->
    </div>
   </div>
   <!--end::Card-->

  </div>
 </div>
@endsection
