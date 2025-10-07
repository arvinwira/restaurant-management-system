<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use App\Models\Food\Cart;
use App\Models\Food\Booking;

use Auth;

class FoodsController extends Controller
{
    public function foodDetails($id){

        $foodItem = Food::find($id);

        //verify if user added item to cart

        $cartVerifying = Cart::where('food_id', $id)
        ->where('user_id', Auth::user()->id)->count();

        return view('foods.food-details', compact('foodItem','cartVerifying'));
    }

    public function cart(Request $request, $id){

        $cart = Cart::create([
            "user_id" => $request->user_id,
            "food_id" => $request->food_id,
            "name" => $request->name,
            "image" => $request->image,
            "price" => $request->price,

        ]);

        if($cart){
            return redirect()->route('food.details', $id)->with(['success'=> 'Item added to cart successfully']);
        }

        // return view('foods.food-details', compact('foodItem'));
    }

    public function displayCartItems(){

        if(auth()->user()){
            //diplay cart items
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            // display price
            $price = Cart::where('user_id', Auth::user()->id)->sum('price');


            return view('foods.cart', compact('cartItems', 'price'));
        } else {
            abort('404');
        }

       
    }

    public function deleteCartItems($id){


        $deleteItem = Cart::where('user_id', Auth::user()->id)
        ->where('food_id', $id);

        $deleteItem->delete();

        if($deleteItem){
            return redirect()->route('food.display.cart')->with(['delete'=> 'Item deleted successfully']);
        }

    }

    public function bookingTables(Request $request){

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:40",
            "date" => "required",
            "num_people" => "required",
            "request" => "required",
        ]);

        $currentDate = date('m/d/Y h:i:sa');

        if($request->date == $currentDate OR $request->date < $currentDate){
            
            return redirect()->route('home')->with(['booked'=>'you cannot book on the current date or date in the past']);

        } else {
            $bookingTables = Booking::create([
                "user_id" => Auth::user()->id,
                "name" => $request->name,
                "email" => $request->email,
                "date" => $request->date,
                "num_people" =>$request->num_people,
                "request"=> $request->input('request'), // ✅ fixed
            ]);

            if($bookingTables){
                return redirect()->route('home')->with(['booked'=>'you booked a table']);
            }
        }
    }

    public function menu(){

        $breakfastFoods = Food::where('category', 'Breakfast')->take(4)->orderBy('id','desc')->get();

        $lunchFoods = Food::where('category', 'Lunch')->take(4)->orderBy('id','desc')->get();

        $dinnerFoods = Food::where('category', 'Dinner')->take(4)->orderBy('id','desc')->get();

        return view('foods.menu', compact('breakfastFoods','lunchFoods','dinnerFoods'));

    }
    
    public function bookingHistory(Request $request){
       
        $bookings = Booking::where('user_id', Auth::id())
            ->latest('date')
            ->paginate(10)
            ->withQueryString();

        return view('foods.booking-history', compact('bookings'));

    }

    


}
