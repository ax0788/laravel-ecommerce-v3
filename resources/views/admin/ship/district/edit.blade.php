@extends('admin.index')
@section('content')
 <!--begin::Card-->
 <div class="row">
    <div class="col-md-10">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Edit District
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{ route('admin.district.update', $district->id) }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Country:<span class="text-danger">*</span></label>
                        <select name="country_id" class="form-control">
                            <option selected disabled>Select country</option>
                            @foreach ($country as $con)
                             <option value="{{ $con->id }}" {{ $con->id == $district->country_id ? 'selected' : '' }}>{{ $con->country_name }}
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
                             <option value="{{ $st->id }}" {{ $st->id == $district->state_id ? 'selected' : '' }}>{{ $st->state_name }}
                             </option>
                            @endforeach
                           </select>
                        @error('state_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>District Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="district_name"  value="{{ $district->district_name }}"/>
                        @error('district_name')
                        <span class="text-danger">{{ $message }}</span>
                       @enderror
                       </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
 </div>

 <!--end::Card-->
@endsection
