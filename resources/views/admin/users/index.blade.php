@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-12">
   <!--begin::Card-->
   <div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
     <div class="card-title">
      <h3 class="card-label">
        Total Users: <span class="badge badge-pill badge-danger"> {{ count($users) }} </span>
      </h3>
     </div>
    </div>

    <div class="card-body">
     <!--begin: Datatable-->
     <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
      <thead>
       <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Action</th>

       </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
         <tr>

          <td>{{ $user->first_name }} {{ $user->last_name }} </td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>

          <td>
           @if ($user->UserOnline())
            <span class="badge badge-pill badge-success">Active Now</span>
           @else
            <span
             class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
           @endif
          </td>

          <td>
           <a href=" " class="btn btn-info" title="Edit Data"><i class="fa fa-edit"></i> </a>
           <a href=" " class="btn btn-danger" title="Delete Data" id="delete">
            <i class="fa fa-trash"></i></a>
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
