@extends('admin.index')
@section('content')

<div class="container-fluid mt-5">
    <div class="card-body d-sm-flex justify-content-between">
        <h6 class="mb-2 mb-sm-0 pt-1">
            <a href="">Collections</a>
            <span>/</span>
            <span>Group</span>
            <a href="{{ url('group-add') }}" class="badge btn-primary py-4 ">Add Groups</a>
        </h6>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                 <th>ID</th>
                 <th>Name</th>
                 <th>Description</th>
                 <th>show/hide</th>
                 <th>Action</th>
                </thead>
                <tbody>
                 <td>1</td>
                 <td>1</td>
                 <td>1</td>
                 <td><input type="checkbox"></td>
                 <td>
                     <a href="" class="badge btn-primary">Edit</a>
                     <a href="" class="badge btn-bg-danger">Delete</a>
                 </td>
                </tbody>
             </table>
        </div>
      </div>
    </div>
</div>
@endsection
