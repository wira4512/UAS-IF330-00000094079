@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Rental History</h1>
    @if ($rentals->isEmpty())
        <p class="text-muted">You have no rental history.</p>
    @else
        <ul class="list-group">
            @foreach ($rentals as $rental)
                <li class="list-group-item">
                    {{ $rental->make }} {{ $rental->model }} 
                    (Rented: {{ $rental->start_date }} to {{ $rental->end_date }})
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
