<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\House;
use App\Models\Tenant;
use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $houses = House::count();

        $houseRented = House::has('tenant')->count();

        $tenants = Tenant::count();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $totalPaymentsThisMonth = Payment::whereMonth('created_at', $currentMonth)
                                         ->whereYear('created_at', $currentYear)
                                         ->sum('amount');

        return view('home', compact('houses', 'houseRented', 'totalPaymentsThisMonth', 'tenants'));
    }
}
