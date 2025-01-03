@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rent a Car</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('car.rent') }}">
        @csrf
        <div class="form-group">
            <label for="car_id">Select a Car:</label>
            <select class="form-control" id="car_id" name="car_id" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->car_id }}">
                        {{ $car->make }} {{ $car->model }} ({{ $car->year }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Rent</button>
    </form>
</div>
@endsection
