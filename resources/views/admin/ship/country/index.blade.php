@extends('admin.index')
@section('content')
 <!--begin::Card-->
 <div class="row">
    <div class="col-md-7">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
              <h3 class="card-label">
               Country List
               <span class="d-block text-muted pt-2 font-size-sm">Add or edit countries.</span>
              </h3>
             </div>
            </div>
            <div class="card-body">
             <!--begin: Search Form-->
             <!--begin::Search Form-->
             <div class="mb-7">
              <div class="row align-items-center">
               <div class="col-lg-9 col-xl-8">
                <div class="row align-items-center">
                 <div class="col-md-4 my-2 my-md-0">
                  <div class="input-icon">
                   <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                   <span><i class="flaticon2-search-1 text-muted"></i></span>
                  </div>
                 </div>

                </div>
               </div>
              </div>
             </div>
             <!--end::Search Form-->
             <!--end: Search Form-->

             <!--begin: Datatable-->
             <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
              <thead>
               <tr>
                <th title="Field #1">Country Name</th>
                <th title="Field #2">Action</th>
               </tr>
              </thead>
              <tbody>
              @foreach ($countries as $item)
                   <tr>
                    <td>{{ $item->country_name }}</td>
                    <td>   <a href="{{ route('admin.country.edit', $item->id) }}" class="btn btn-info btn-md btn-clean btn-icon mr-2" title="Edit"><i class="fa fa-edit"></i></a>


                        <a href="{{ route('admin.country.delete', $item->id) }}" class="btn btn-danger btn-md btn-clean btn-icon mr-2" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                   </tr>
              @endforeach
              </tbody>
             </table>
             <!--end: Datatable-->
            </div>
           </div>
    </div>
    <div class="col-md-5">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Add Country
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{ route('admin.country.store') }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Country Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="country_name" />
                        @error('country_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Add Country</button>
                    </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
 </div>

 <!--end::Card-->
@endsection
