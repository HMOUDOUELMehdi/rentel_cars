@extends('dashboard.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-white">
                <h3>Car Details</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4>{{ $car->name }}</h4>
                        <p><strong>Matricule:</strong> {{ $car->matricule }}</p>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Number of Places:</strong> {{ $car->nombreDePlaces }}</p>
                        <p><strong>Tarif:</strong> ${{ $car->tarif }} per day</p>
                        <a href="#" class="btn btn-primary">Book now</a>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            @foreach($car->photos as $photo)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset($photo->name) }}" class="img-fluid" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-secondary">Edit Car</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
