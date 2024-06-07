@extends('dashboard.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-white">
                <h3>All Cars</h3>
                <a href="{{ route('cars.create') }}" class="btn btn-success">Add New Car</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Model</th>
                        <th scope="col">Number of Places</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $car)
                        <tr>
                            <td>
                                @foreach($photos as $photo)
                                    @if($car->id == $photo->carId)
                                        <img src="{{ $photo->name }}" style="max-width: 150px;" />
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->matricule }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->nombreDePlaces }}</td>
                            <td>{{ $car->tarif }}</td>
                            <td>
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('addPhotos', $car->id) }}" class="btn btn-primary">Add Photos</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
