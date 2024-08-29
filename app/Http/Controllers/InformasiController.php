<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboardInformasi.index', [
            'informasis' => Informasi::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardInformasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'deskripsi' => 'required',
            'tujuan' => 'required',
            'file' => 'required'
        ]);

        $file = $request->file('file');

        $renameFile = uniqid() . '_' . $file->getClientOriginalName();

        $tujuan = 'file';

        $file->move($tujuan, $renameFile);

        $validated['file'] = $renameFile;

        Informasi::create($validated);

        return redirect('dashboard/informasi')->with('success', 'Informasi berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        //
    }
}
