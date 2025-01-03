@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Rent a Car</h1>
    <form method="POST" action="{{ route('car.rent') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="car_id">Select a Car</label>
            <select name="car_id" id="car_id" class="form-control">
                @foreach ($cars as $car)
                    <option value="{{ $car->car_id }}">{{ $car->make }} {{ $car->model }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" name="rent" class="btn btn-primary">Rent</button>
    </form>
</div>
@endsection
