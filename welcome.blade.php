@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Welcome to Car Rental Service</h1>
    <div class="mt-4">
        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
        <span class="mx-2">or</span>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
    </div>
</div>
@endsection
