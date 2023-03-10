@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-8">
  <!--begin::Card-->
<div class="card card-custom gutter-b">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title">
			<h3 class="card-label">
				Coupons List
			</h3>
		</div>
		<div class="card-toolbar">
			<!--begin::Dropdown-->
<div class="dropdown dropdown-inline mr-2">
	<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"/>
        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>		Export
	</button>

	<!--begin::Dropdown Menu-->
	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
		<!--begin::Navigation-->
		<ul class="navi flex-column navi-hover py-2">
			<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
		        Choose an option:
		    </li>
			<li class="navi-item">
				<a href="#" class="navi-link">
					<span class="navi-icon"><i class="la la-print"></i></span>
					<span class="navi-text">Print</span>
				</a>
			</li>
			<li class="navi-item">
				<a href="#" class="navi-link">
					<span class="navi-icon"><i class="la la-copy"></i></span>
					<span class="navi-text">Copy</span>
				</a>
			</li>
			<li class="navi-item">
				<a href="#" class="navi-link">
					<span class="navi-icon"><i class="la la-file-excel-o"></i></span>
					<span class="navi-text">Excel</span>
				</a>
			</li>
			<li class="navi-item">
				<a href="#" class="navi-link">
					<span class="navi-icon"><i class="la la-file-text-o"></i></span>
					<span class="navi-text">CSV</span>
				</a>
			</li>
			<li class="navi-item">
				<a href="#" class="navi-link">
					<span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
					<span class="navi-text">PDF</span>
				</a>
			</li>
		</ul>
		<!--end::Navigation-->
	</div>
	<!--end::Dropdown Menu-->
</div>
<!--end::Dropdown-->
		</div>
	</div>

	<div class="card-body">
		<!--begin: Datatable-->
		<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
            <thead>
                <tr>
                    <th>Coupon Name</th>
                    <th>Coupon Discount</th>
                    <th>Validity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
               </thead>
               <tbody>
                @foreach ($coupons as $item)
                <tr>
                 <td>{{ $item->coupon_name }}</td>
                 <td>{{ $item->coupon_discount }}%</td>
                 <td width="25%">
                  {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
                 </td>
                 <td>
                  @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                   <span class="badge badge-pill badge-success">Valid</span>
                  @else
                   <span class="badge badge-pill badge-danger">Invalid</span>
                  @endif
                 </td>
                 <td width="25%">
                    <a href="{{ route('admin.coupon.edit', $item->id) }}" class="btn btn-info" title="Edit"><i
                      class="fa fa-pencil"></i></a>
                      <a href="{{ route('admin.coupon.delete', $item->id) }}" class="btn btn-danger" id="delete" title="Delete"><i
                        class="fa fa-trash"></i></a>
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

   {{-- ADD COUPON PAGE --}}
  <div class="col-md-3">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
        Add New Coupon
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('coupon.store') }}">
        @csrf
     <div class="card-body">

      <div class="form-group">
       <label>Coupon Name: <span class="text-danger">*</span></label>
       <input type="text" class="form-control"  name="coupon_name" />
       @error('coupon_name')
       <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>

      <div class="form-group">
       <label>Coupon Discount(%): <span class="text-danger">*</span></label>
       <input type="text" name="coupon_discount" class="form-control">
       @error('coupon_discount')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
      <div class="form-group">
       <label>Coupon Validity(%): <span class="text-danger">*</span></label>
       <input type="date" name="coupon_validity" class="form-control"
            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
           @error('coupon_validity')
            <span class="text-danger">{{ $message }}</span>
           @enderror
      </div>

     <div class="card-footer">
      <button type="submit" class="btn btn-primary mr-2">Add Coupon</button>
     </div>
    </form>
    <!--end::Form-->
   </div>
  </div>
 </div>


@endsection
