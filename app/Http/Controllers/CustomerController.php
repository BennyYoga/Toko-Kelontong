<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $customer = Customer::where('is_delete', false)->get();

        $title = 'Delete Customer!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if($request->ajax()){
            return DataTables::of($customer)
            ->addColumn('action', function($data){
                $button = '<a href='. route('customer.edit', $data->id) . ' class="edit btn btn-primary btn-xs mb-1">Edit</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a href=' . route('customer.destroy', $data->id) . ' class="delete btn btn-danger btn-xs mb-1" data-confirm-delete="true">Delete</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customer.create');
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
        $message = [
            'required' => 'Kolom :attribute diisi',
            'kode.unique' => 'Kode sudah terdaftar',
            'telp.min' => 'Nomor telepon minimal 10 karakter',
            'telp.max' => 'Nomor telepon maksimal 13 karakter',
        ];
        $request->validate([
            'kode' => 'required|unique:m_customer',
            'nama' => 'required',
            'telp' => 'required|min:10|max:13',
        ], $message);

        Customer::create($request->all());

        Alert::success('Success', 'Data Customer berhasil disimpan');
        return redirect()->route('customer.index');
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
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
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
        $message = [
            'required' => 'Kolom :attribute diisi',
            'telp.min' => 'Nomor telepon minimal 10 karakter',
            'telp.max' => 'Nomor telepon maksimal 13 karakter',
        ];
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'telp' => 'required|min:10|max:13',
        ], $message);

        Customer::find($id)->update($request->all());

        Alert::success('Success', 'Data Customer berhasil diupdate');
        return redirect()->route('customer.index');
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
        // Customer::find($id)->delete();
        $customer = Customer::find($id);
        $customer->is_delete = 1;
        $customer->save();
        alert()->success('Success', 'Data Customer berhasil dihapus');
        return redirect()->route('customer.index');
    }
}
