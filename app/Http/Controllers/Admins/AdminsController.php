<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;   
use Illuminate\Support\Facades\DB;       
use App\Models\Food\Food;                     
use App\Models\Food\Booking;                 


class AdminsController extends Controller
{
    
    public function viewLogin(){

        return view('admins.login');
    }

    public function checkLogin(Request $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    // public function index(){

    //     return view('admins.index');
    // }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('view.login'); // back to admin login
    }

    public function index(Request $request)
{
    // COUNTS
    $foodsCount     = Schema::hasTable('foods')    ? Food::count()    : 0;
    $bookingsCount  = Schema::hasTable('booking') ? Booking::count() : 0;
    $ordersCount    = Schema::hasTable('orders')   ? DB::table('orders')->count() : 0;

    // RECENT LISTS (5 terbaru)
    $recentFoods    = Schema::hasTable('foods')
        ? Food::latest('created_at')->limit(5)->get()
        : collect();

    $recentBookings = Schema::hasTable('booking')
        ? Booking::latest('created_at')->limit(5)->get()
        : collect();

    $recentOrders   = Schema::hasTable('orders')
        ? DB::table('orders')->select('id','status','grand_total','created_at')
            ->latest('created_at')->limit(5)->get()
        : collect();

    return view('admins.index', compact(
        'foodsCount','bookingsCount','ordersCount',
        'recentFoods','recentBookings','recentOrders'
    ));
}

}
