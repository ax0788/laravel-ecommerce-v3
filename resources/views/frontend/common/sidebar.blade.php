@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
@endphp
<div class="col-md-2"> <br>
 <ul class="list-group list-group-flush">
  <a href="{{ route('profile.index') }}" class="btn btn-primary btn-sm btn-block">Home</a>
  <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-sm btn-block">Edit Profile</a>
  <a href="{{ route('password.change') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
  <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm btn-block">Orders</a>
   <a href="{{ route('return.order.list') }}" class="btn btn-primary btn-sm btn-block">Returned Orders</a>
  <a href="{{ route('cancel.order') }}" class="btn btn-primary btn-sm btn-block">Canceled Orders</a>
  <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

 </ul>

</div>
