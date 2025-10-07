<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food\Food;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        $breakfastFoods = Food::where('category', 'Breakfast')->take(4)->orderBy('id','desc')->get();

        $lunchFoods = Food::where('category', 'Lunch')->take(4)->orderBy('id','desc')->get();

        $dinnerFoods = Food::where('category', 'Dinner')->take(4)->orderBy('id','desc')->get();

        return view('home', compact('breakfastFoods','lunchFoods','dinnerFoods'));
    }
}
