<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    private string $table = 'orders';

    public function index(Request $request)
    {
        $orders = DB::table($this->table)
            ->select('id','user_id','status','grand_total','created_at')
            ->orderByDesc('created_at')
            ->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'     => ['required','integer','min:1'],
            'status'      => ['required','string','max:30'],
            'grand_total' => ['nullable','numeric','min:0'],
        ]);

        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($this->table)->insert($data);

        return redirect()->route('admin.orders.index')->with('success','Order created.');
    }

    public function edit($id)
    {
        $order = DB::table($this->table)->find($id);
        abort_if(!$order, 404);
        return view('admin.orders.form', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = DB::table($this->table)->find($id);
        abort_if(!$order, 404);

        $data = $request->validate([
            'user_id'     => ['required','integer','min:1'],
            'status'      => ['required','string','max:30'],
            'grand_total' => ['nullable','numeric','min:0'],
        ]);

        $data['updated_at'] = now();

        DB::table($this->table)->where('id',$id)->update($data);

        return redirect()->route('admin.orders.index')->with('success','Order updated.');
    }

    public function destroy($id)
    {
        DB::table($this->table)->where('id',$id)->delete();
        return back()->with('success','Order deleted.');
    }
}
