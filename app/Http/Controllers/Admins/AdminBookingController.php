<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    private string $table = 'booking'; // <- sesuai model/tabel kamu

    public function index(Request $request)
    {
        $bookings = DB::table($this->table)
            ->select('id','name','email','date','num_people','status','created_at')
            ->orderByDesc(DB::raw('COALESCE(date, created_at)'))
            ->paginate(10)->withQueryString();

        return view('admins.bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('admins.bookings.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required','string','max:150'],
            'email'      => ['required','email','max:150'],
            'date'       => ['nullable','date'],
            'num_people' => ['required','integer','min:1'],
            'status'     => ['required','string','max:30'], // pending|confirmed|cancelled
            'request'    => ['nullable','string','max:2000'],
        ]);

        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($this->table)->insert($data);

        return redirect()->route('admins.bookings.index')->with('success','Booking created.');
    }

    public function edit($id)
    {
        $booking = DB::table($this->table)->find($id);
        abort_if(!$booking, 404);
        return view('admins.bookings.form', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = DB::table($this->table)->find($id);
        abort_if(!$booking, 404);

        $data = $request->validate([
            'name'       => ['required','string','max:150'],
            'email'      => ['required','email','max:150'],
            'date'       => ['nullable','date'],
            'num_people' => ['required','integer','min:1'],
            'status'     => ['required','string','max:30'],
            'request'    => ['nullable','string','max:2000'],
        ]);

        $data['updated_at'] = now();

        DB::table($this->table)->where('id',$id)->update($data);

        return redirect()->route('admins.bookings.index')->with('success','Booking updated.');
    }

    public function destroy($id)
    {
        DB::table($this->table)->where('id',$id)->delete();
        return back()->with('success','Booking deleted.');
    }
}
