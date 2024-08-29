<?php

namespace App\Http\Controllers;

use App\Models\DisampaikanKepada;
use Illuminate\Http\Request;

class DisampaikanKepadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->level == 'master') {
            $view = 'dashboardDisampaikan.indexStaff';
        } else {
            $view = 'dashboardDisampaikan.index';
        }

        return view($view, [
            'disposisiDisampaikan' => DisampaikanKepada::with('disposisi.suratMasuk')->where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DisampaikanKepada $disampaikanKepada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DisampaikanKepada $disampaikanKepada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DisampaikanKepada $disampaikanKepada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DisampaikanKepada $disampaikanKepada)
    {
        //
    }
}
