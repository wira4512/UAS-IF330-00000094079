@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Welcome to your Dashboard</h1>
    <div class="mt-3">
        <a href="{{ route('car.index') }}" class="btn btn-primary me-2">Rent a Car</a>
        <a href="{{ route('history.index') }}" class="btn btn-secondary me-2">Rental History</a>
        <a href="{{ route('user.edit') }}" class="btn btn-info me-2">Edit User</a>
        <a href="{{ route('logout') }}" class="btn btn-danger">Log Out</a>
    </div>
</div>
@endsection
