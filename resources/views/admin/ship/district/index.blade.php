@extends('admin.index')
@section('content')
 <!--begin::Card-->
 <div class="row">
    <div class="col-md-9">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
              <h3 class="card-label">
               District List
               <span class="d-block text-muted pt-2 font-size-sm">Add or Edit districts.</span>
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
                <th title="Field #1">Country</th>
                <th title="Field #2">State</th>
                <th title="Field #3">District</th>
                <th title="Field #4">Action</th>
               </tr>
              </thead>
              <tbody>
              @foreach ($district as $item)
                   <tr>
                    <td>{{ $item->country->country_name }}</td>
                    <td>{{ $item->state->state_name }}</td>
                    <td>{{ $item->district_name }}</td>
                    <td>   <a href="{{ route('admin.district.edit', $item->id) }}" class="btn btn-info btn-md btn-clean btn-icon mr-2" title="Edit"><i class="fa fa-edit"></i></a>

                        <a href="{{ route('admin.district.delete', $item->id) }}" class="btn btn-danger btn-md btn-clean btn-icon mr-2" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                   </tr>
              @endforeach
              </tbody>
             </table>
             <!--end: Datatable-->
            </div>
           </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Add District
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{ route('admin.district.store') }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Country:<span class="text-danger">*</span></label>
                        <select name="country_id" class="form-control">
                            <option selected disabled>Select country</option>
                            @foreach ($country as $con)
                             <option value="{{ $con->id }}">{{ $con->country_name }}
                             </option>
                            @endforeach
                           </select>
                           @error('country_name')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>

                    <div class="form-group">
                        <label>State: <span class="text-danger">*</span></label>
                        <select name="state_id" class="form-control">
                            <option selected disabled>Select state</option>
                            @foreach ($state as $st)
                             <option value="{{ $st->id }}">{{ $st->state_name }}
                             </option>
                            @endforeach
                           </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>District Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="district_name" />
                        @error('district_name')
                        <span class="text-danger">{{ $message }}</span>
                       @enderror
                       </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Add District</button>
                    </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
 </div>

 <!--end::Card-->
@endsection
