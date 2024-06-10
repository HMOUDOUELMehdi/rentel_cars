@extends('dashboard.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-white">
                <h3>Edit Car Information</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('cars.update', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $car->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control" id="matricule" name="matricule" value="{{ $car->matricule }}" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreDePlaces">Number of Places</label>
                        <input type="number" class="form-control" id="nombreDePlaces" name="nombreDePlaces" value="{{ $car->nombreDePlaces }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tarif">Tarif</label>
                        <input type="number" class="form-control" id="tarif" name="tarif" value="{{ $car->tarif }}" required>
                    </div>
                    <div class="form-group">
                        <label>Photos</label>
                        <div class="row">
                            @foreach($car->photos as $photo)
                                <div class="col-md-3">
                                    <img src="{{ $photo->name }}" style="max-width: 200px;margin: 6px" />
                                    <form action="{{ route('car_photos.destroy', $photo->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Car</button>
                </form>
            </div>
        </div>
    </div>
@endsection
