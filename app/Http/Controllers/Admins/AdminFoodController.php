<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminFoodController extends Controller
{
    private string $table = 'foods';

    public function index(Request $request)
    {
        $foods = DB::table($this->table)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admins.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admins.foods.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:150'],
            'category'    => ['nullable','string','max:100'],
            'price'       => ['required','numeric','min:0'],
            'description' => ['nullable','string','max:2000'],
            'image'       => ['nullable','image','max:2048'], 
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('foods', 'public');
            $data['image'] = $path; 
        } else {
            $data['image'] = ''; 
        }
    
        $data['created_at'] = now();
        $data['updated_at'] = now();
    
        DB::table('foods')->insert($data);
    
        return redirect()->route('admins.foods.index')->with('success', 'Food created.');
    }
    

    public function edit($id)
    {
        $food = DB::table($this->table)->find($id);
        abort_if(!$food, 404);
        return view('admins.foods.form', compact('food'));
    }

    public function update(Request $request, $id)
{
    $food = DB::table('foods')->find($id);
    abort_if(!$food, 404);

    $data = $request->validate([
        'name'        => ['required','string','max:150'],
        'category'    => ['nullable','string','max:100'],
        'price'       => ['required','numeric','min:0'],
        'description' => ['nullable','string','max:2000'],
        'image'       => ['nullable','image','max:2048'], // ← tambahkan
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('foods', 'public');
        $data['image'] = $path;
    }
    // kalau tidak upload, biarkan value lama tetap (jangan set ke kosong)

    $data['updated_at'] = now();

    DB::table('foods')->where('id', $id)->update($data);

    return redirect()->route('admins.foods.index')->with('success', 'Food updated.');
}


    public function destroy($id)
    {
        DB::table($this->table)->where('id',$id)->delete();
        return back()->with('success','Food deleted.');
    }
}
