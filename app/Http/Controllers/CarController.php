<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = CarPhoto::all();
        $cars = Car::all();
        return view('dashboard.fetchCars', compact('cars','photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.createCar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'nombreDePlaces' => 'required|integer',
            'tarif' => 'required|numeric',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Car created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        $photos = CarPhoto::all();
        return view('dashboard.showCar', compact('car','photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photos = CarPhoto::all();
        $car = Car::findOrFail($id);
        return view('dashboard.editCar', compact('car','photos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'nombreDePlaces' => 'required|integer',
            'tarif' => 'required|numeric',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }

    public function addPhotos($id)
    {
        $car = Car::findOrFail($id);
        return view('dashboard.uploadPhotos', compact('car'));
    }

    public function storePhotos(Request $request, $id)
    {
        $request->validate([
            'photos' => 'required|array|max:5',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $car = Car::findOrFail($id);

        foreach ($request->file('photos') as $photo) {
            // Store the photo and get the stored path
            $storedPath = $photo->store('public');

            // Generate the public URL to the stored photo
            $publicPath = asset(str_replace('public', 'storage', $storedPath));

            // Save the photo path to the car_photos table
            CarPhoto::create([
                'name' => $publicPath,
                'carId' => $car->id
            ]);
        }

        return redirect()->route('cars.index')->with('success', 'Photos uploaded successfully');
    }

    public function destroyPhotos($id)
    {
        $photo = CarPhoto::findOrFail($id);

        // Delete the photo file from storage
        Storage::delete(str_replace('storage/', 'public/', $photo->name));

        // Delete the photo record from the database
        $photo->delete();

        return response()->json(['success' => true]);
    }

}
