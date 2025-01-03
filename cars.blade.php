@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Car Management</h1>
    
    <!-- Display any success messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to edit car details -->
    <form method="POST" action="{{ route('cars.update') }}">
        @csrf
        <div class="form-group">
            <label for="car_id">Car ID</label>
            <input type="text" class="form-control" id="car_id" name="car_id" required>
        </div>
        <div class="form-group">
            <label for="make">Make</label>
            <input type="text" class="form-control" id="make" name="make" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Car</button>
    </form>

    <h2 class="mt-4">Car List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>
                        <!-- Edit car form (optional) -->
                        <form method="POST" action="{{ route('cars.update') }}">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="text" name="make" value="{{ $car->make }}">
                            <input type="text" name="model" value="{{ $car->model }}">
                            <button type="submit" class="btn btn-secondary">Edit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
