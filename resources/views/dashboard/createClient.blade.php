@extends('dashboard.layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-white">
                <h3>Add New Client</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('addClient') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control"  name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="matricule">Email</label>
                        <input type="email" class="form-control"  name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Telephone</label>
                        <input type="number" class="form-control"  name="tel" required>
                    </div>
                    <div class="form-group">
                        <label for="numbreDePlaces">Password</label>
                        <input type="password" class="form-control"  name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Client</button>
                </form>
            </div>
        </div>
    </div>
@endsection
