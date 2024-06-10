<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage()
    {
        $cars = Car::all();
        $photos = CarPhoto::all();
        return view('home pages.index', compact('cars','photos'));
    }

    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        $photos = CarPhoto::all();
        return view('dashboard.showCar', compact('car','photos'));
    }

}
