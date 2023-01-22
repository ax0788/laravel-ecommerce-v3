@extends('admin.index')
@section('content')
 <!--begin::Card-->
 <div class="card card-custom gutter-b">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
   <div class="card-title">
    <h3 class="card-label">
     Products List
    </h3>
   </div>
  </div>

  <div class="card-body">
   <!--begin: Datatable-->
   <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
     <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Status</th>
      <th>Actions</th>
     </tr>
    </thead>

    <tbody>
   @foreach ($products as $item)
      <tr>
         <td><img src="{{ asset($item->product_thumbnail) }}" alt="" style="width:70px; height:80px;">
         </td>

         <td>
             {{ $item->product_name_en }}
         </td>
         <td>
             {{ $item->product_qty }}
         </td>
         <td>
             ${{ $item->selling_price }}
         </td>
         <td>
            @if ($item->discount_price == null)
             <span class="badge badge-pill badge-danger">No Discount</span>
            @else
             @php
              $amount = $item->selling_price - $item->discount_price;
              $discount = ($amount / $item->selling_price) * 100;
             @endphp
             <span class="badge badge-pill badge-info">{{ round($discount) }} %</span>
            @endif

           </td>
           <td>
            @if ($item->status == 1)
              <span class="badge badge-pill badge-success">Active</span>
             @else
              <span class="badge badge-pill badge-danger">Inactive</span>
             @endif
           </td>
           <td  class=" d-flex m-3">
            <a href="" class="btn btn-secondary md btn-clean btn-icon mr-3"  title="Product Details"><i
              class="fa fa-info-circle"></i></a>

              <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-info btn-md btn-clean btn-icon mr-3" title="Edit"><i class="fa fa-edit"></i></a>



            @if ($item->status == 1)
            <a href="{{ route('admin.products.inactive', $item->id) }}" class="btn btn-dark md btn-clean btn-icon mr-3" title="make product inactive"><i
              class="fa fa-arrow-circle-down"></i></a>
           @else
            <a href="{{ route('admin.products.active', $item->id) }}" class="btn btn-success md btn-clean btn-icon mr-3" title="make product active"><i
              class="fa fa-arrow-circle-up"></i></a>
           @endif


              <form  action="{{ route('admin.products.destroy', $item->id) }}"  method="POST" >
                @csrf
                @method('DELETE')
           <button  type="submit" class="btn btn-danger  btn-md btn-clean btn-icon" title="Delete">
           <i class="fa fa-trash"></i>
        </button>
            </form>

           </td>
     </tr>
   @endforeach
    </tbody>

   </table>
   <!--end: Datatable-->
  </div>
 </div>
 <!--end::Card-->
@endsection
