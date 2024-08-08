<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesDet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as Alert;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $sales = DB::table('sales_summary')->get();
        if ($request->ajax()) {
            return DataTables::of($sales)
            ->addColumn('tanggal', function($row){
                $tanggal = date('d-m-Y', strtotime($row->tanggal));
                return $tanggal;
            })
            ->make(true);
        }
        return view('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customer = Customer::where('is_delete', false)->get();
        $transaction = Sales::all();
        $barang = Barang::where('is_delete', false)->get();

        if($transaction->count() > 0){
            $transaction = $transaction->last();
            $transaction = $transaction->id + 1;
        }else{
            $transaction = 1;
        }
        
        
        return view('transaction.create', compact('customer', 'transaction', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'tanggal' => 'required',
        ]);
        if($request->diskon_total == null){
            Alert::error('Error', 'Diskon Total tidak boleh kosong');
            return redirect()->back()->withInput();
        }
        $sales = Sales::create([
            'kode' => $request->no_transaction,
            'customer_id' => $request->kode,
            'tanggal' => $request->tanggal,
            'subtotal' => (int) $request->sub_total,
            'diskon' => (int) ($request->diskon_total ? $request->diskon_total : 0),
            'ongkir' => (int) ($request->ongkir_total ? $request->ongkir_total : 0),
            'total_bayar' => (int) $request->bayar_total,
        ]);
        for ($i=0; $i < count($request->kode_barang); $i++) { 
            $kode_barang = Barang::where('kode', $request->kode_barang[$i])->first();
            SalesDet::create([
                'sales_id' => (int) $sales->id,
                'barang_id' => (int) $kode_barang->id,
                'harga_bandrol' => (int) $request->harga_bandrol[$i],
                'qty' => (int) $request->qty[$i],
                'diskon_pct' => (int) $request->persen_diskon[$i],
                'diskon_nilai' => (int) $request->rupiah_diskon[$i],
                'total' => (int) $request->harga_diskon[$i],
            ]);
        }

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function customerShow($id){
        $customer = Customer::find($id);
        return response()->json($customer);
    }
}
