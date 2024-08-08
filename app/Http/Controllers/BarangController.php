<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $barang = Barang::where('is_delete', false)->get();

        $title = 'Delete Barang!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            return DataTables::of($barang)
                ->addColumn('action', function ($data) {
                    $button = '<a href=' . route('barang.edit', $data->id) . ' class="edit btn btn-primary btn-xs mb-1">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href=' . route('barang.destroy', $data->id) . ' class="delete btn btn-danger btn-xs mb-1" data-confirm-delete="true">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('barang.create');
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
            'harga.min' => 'Harga minimal lebih dari 0',
        ];
        $request->validate([
            'kode' => 'required|unique:m_barang',
            'nama' => 'required',
            'harga' => 'required|min:0',
        ], $message);

        Barang::create($request->all());

        Alert::success('Success', 'Data Barang berhasil disimpan');
        return redirect()->route('barang.index');
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
        $barang = Barang::find($id);
        return view('barang.edit', compact('barang'));
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
            'kode.unique' => 'Kode sudah terdaftar',
            'harga.min' => 'Harga minimal lebih dari 0',
        ];
        $request->validate([
            'kode' => 'required|unique:m_barang',
            'nama' => 'required',
            'harga' => 'required',
            'harga' => 'required|min:0',
        ], $message);

        Barang::find($id)->update($request->all());
        Alert::success('Success', 'Data Barang berhasil diubah');
        return redirect()->route('barang.index');
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
        // Barang::destroy($id);
        $barang = Barang::find($id);
        $barang->is_delete = 1;
        $barang->save();
        Alert::success('Success', 'Data Barang berhasil dihapus');
        return redirect()->route('barang.index');
    }
}
