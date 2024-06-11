<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function about(){
        return view('home pages.about');
    }

    public function allCars(){
        $cars = Car::all();
        $photos = CarPhoto::all();
        return view('home pages.car',compact('cars','photos'));
    }

    public function carDetails(string $id){
        $car = Car::findOrFail($id);
        $photos = CarPhoto::all();
        return view('home pages.car-single', compact('car','photos'));
    }
    public function showCreateContractPage($id)
    {
        $user = Auth::user();
        $car = Car::findOrFail($id);
        return view('home pages.createContract', [
            'user' => $user,
            'car' => $car
        ]);
    }
    public function storeContract(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to reserve a car.');
        }

        // Validate the request
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date|after_or_equal:rental_start_date',
            'total_price' => 'required',
        ]);

        $userId = auth()->id();
        $carId = $request->input('car_id');

        // Check if the user has already reserved this car
        $existingContract = Contract::where('userId', $userId)->where('carId', $carId)->first();

        if ($existingContract) {
            return redirect()->route('homePage')->with('error', 'You have already reserved this car.');
        }

        // Create the new contract
        $contract = new Contract();
        $contract->carId = $carId;
        $contract->userId = $userId;
        $contract->dateDeput = $request->input('rental_start_date');
        $contract->dateFin = $request->input('rental_end_date');
        $contract->montant = $request->input('total_price');
        $contract->save();

        // Generate the PDF and return success message
//        $this->generateContractPDF($contract->id); // Assuming this method generates and saves the PDF

        return redirect()->route('homePage')->with('success', 'Contract created successfully and saved as PDF.');
    }


    public function generateContractPDF($contractId)
    {
        $contract = Contract::where('contractId', $contractId)->first();
        $car = Car::findOrFail($contract->carId);
        $user = Auth::user();

        $pdf = \PDF::loadView('home pages.pdf', compact('contract', 'car', 'user'));

        return $pdf->download('contract_'.$contract->id.'.pdf');
    }

    public function contracts()
    {
        $user = Auth::user();
        $contracts = Contract::where('userId', $user->id)->get();

        // Fetch car names associated with contracts
        $contractDetails = [];
        foreach ($contracts as $contract) {
            $car = Car::find($contract->carId);
            if ($car) {
                $contractDetails[] = [
                    'userName' => $user->name,
                    'carName' => $car->name, // Assuming 'car_name' is the field in the Car model
                    'dateDeput' => $contract->dateDeput,
                    'dateFin' => $contract->dateFin,
                    'montant' => $contract->montant,
                    'contractId' => $contract->contractId, // Assuming 'id' is the primary key of Contract model
                ];
            }
        }

        return view('home pages.contract', compact('contractDetails'));
    }



}
