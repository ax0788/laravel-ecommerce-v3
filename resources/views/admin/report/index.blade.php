@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-4">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Search By Date </h3>
    </div>
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('admin.report.date') }}">
     @csrf
     <div class="card-body">
      <div class="form-group">
       <label>Select Date:</label>
       <input type="date" class="form-control" name="date" />
       @error('date')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>
     <div class="card-footer">
      <button type="submit" class="btn btn-primary mr-2">Search</button>
     </div>
    </form>
    <!--end::Form-->
   </div>



  </div>




  <div class="col-4">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Search By Month </h3>
    </div>
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('admin.report.month') }}">
     @csrf
     <div class="card-body">
      <label>Select Month:</label>
      <div class="form-group">
       <select name="month" class="form-control">
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="Jun">Jun</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
       </select>
       @error('month')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>

     <div class="card-body">
      <label>Select Year:</label>
      <div class="form-group">
       <select name="year_name" class="form-control">
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
       </select>
       @error('year_name')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>

     <div class="card-footer">
      <button type="submit" class="btn btn-primary mr-2">Search</button>
     </div>
    </form>
    <!--end::Form-->
   </div>
  </div>





  <div class="col-4">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Select Year </h3>
    </div>
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('admin.report.year') }}">
     @csrf
     <div class="card-body">
      <label>Select Year:</label>
      <div class="form-group">
       <select name="year" class="form-control">
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
       </select>
       @error('year')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>
     <div class="card-footer">
      <button type="submit" class="btn btn-primary mr-2">Search</button>
     </div>
    </form>
    <!--end::Form-->


   </div>

  </div>








  <!--   ------------End  Add Search Page -------- -->


 </div>
 <!-- /.row -->
@endsection
