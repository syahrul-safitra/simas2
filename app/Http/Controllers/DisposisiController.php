<?php

namespace App\Http\Controllers;

use App\Models\DisampaikanKepada;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SuratMasuk $suratMasuk)
    {

        $view = "";
        // jika level adalah master maka tampilkan create disposisi master : 
        if (auth()->user()->level == 'master') {
            $view = 'dashboardDisposisi.create';
        } else {
            $view = 'dashboardPengguna.disposisi.create';
        }

        return view($view, [
            'users' => User::where('permission', '1')->get(),
            'suratMasuk' => $suratMasuk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validation data : 
        $validated = $request->validate([
            'indek_berkas' => 'required|unique:disposisis',
            'kode_klasifikasi_arsip' => 'required',
            'tanggal_penyelesaian' => '',
            'tanggal' => '',
            'kepada' => '',
            'pukul' => '',
            'isi' => 'required',
            'surat_masuk_id' => 'required',
            'disampaikan_kepada' => 'required'
        ]);

        $inputDisposisi['indek_berkas'] = $validated['indek_berkas'];
        $inputDisposisi['kode_klasifikasi_arsip'] = $validated['kode_klasifikasi_arsip'];
        $inputDisposisi['tanggal_penyelesaian'] = $validated['tanggal_penyelesaian'];
        $inputDisposisi['tanggal'] = $validated['tanggal'];
        $inputDisposisi['kepada'] = $validated['kepada'];
        $inputDisposisi['pukul'] = $validated['pukul'];
        $inputDisposisi['isi'] = $validated['isi'];
        $inputDisposisi['surat_masuk_id'] = $validated['surat_masuk_id'];

        // Transaction : 
        DB::beginTransaction();

        try {
            // input data disposisi : 
            $dataDisposisi = Disposisi::create($inputDisposisi);

            // input data disampaikan kepada : 
            foreach ($validated['disampaikan_kepada'] as $user_id) {
                DisampaikanKepada::create([
                    'disposisi_id' => $dataDisposisi->id,
                    'user_id' => $user_id
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        // return $dataDisposisi;

        // redirect ke
        return redirect('dashboard/disposisi/' . $validated['surat_masuk_id'])->with('success', 'Data disposisi berhasil di buat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $disposisi = Disposisi::with('disampaikanKepada')->where('surat_masuk_id', $id)->first();

        $getDisposisi = null;

        // cek apakah data ada atau tidak :
        if (Disposisi::where('surat_masuk_id', $id)->first()) {
            $getDisposisi = Disposisi::where('surat_masuk_id', $id)->first();
        }

        if (Auth::user()->level == 'master') {
            $view = 'dashboardDisposisi.index';
        } else {
            $view = 'dashboardPengguna.disposisi.index';
        }

        return view($view, [
            'suratMasuk' => SuratMasuk::find($id),
            'disposisi' => $getDisposisi,
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disposisi $disposisi)
    {

        if (Auth::user()->level == 'master') {
            $view = 'dashboardDisposisi.edit';
        } else {
            $view = 'dashboardPengguna.disposisi.edit';
        }

        $disposisi->diketahui = json_decode($disposisi->diketahui);

        return view($view, [
            'suratMasuk' => SuratMasuk::find($disposisi->surat_masuk_id),
            'disposisi' => $disposisi,
            'users' => User::where('permission', '1')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disposisi $disposisi)
    {

        $rules = [
            'indek_berkas' => '',
            'kode_klasifikasi_arsip' => '',
            'tanggal_penyelesaian' => '',
            'tanggal' => '',
            'kepada' => '',
            'pukul' => '',
            'isi' => 'required',
            'disampaikan_kepada' => 'required'
        ];

        // cek apakah nomor disposisi dirubah : 
        // INI DIRUBAH ---------------------------------------------
        // if ($request->indek_berkas != $disposisi->indek_berkas) {
        //     $rules['indek_berkas'] = 'required|unique:disposisis';
        // }

        // validation rules :
        $validated = $request->validate($rules);

        $editDisposisi['indek_berkas'] = $validated['indek_berkas'];
        $editDisposisi['kode_klasifikasi_arsip'] = $validated['kode_klasifikasi_arsip'];
        $editDisposisi['tanggal_penyelesaian'] = $validated['tanggal_penyelesaian'];
        $editDisposisi['tanggal'] = $validated['tanggal'];
        $editDisposisi['kepada'] = $validated['kepada'];
        $editDisposisi['pukul'] = $validated['pukul'];
        $editDisposisi['isi'] = $validated['isi'];

        // Transaction : 
        DB::beginTransaction();

        try {
            // Edit data disposisi : 
            Disposisi::where('id', $disposisi->id)
                ->update($editDisposisi);

            DisampaikanKepada::where('disposisi_id', $disposisi->id)->delete();

            // input data disampaikan kepada : 
            foreach ($validated['disampaikan_kepada'] as $user_id) {
                DisampaikanKepada::create([
                    'disposisi_id' => $disposisi->id,
                    'user_id' => $user_id
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
            // return $e;
        }

        // redirect ke
        return redirect('dashboard/disposisi/' . $disposisi->surat_masuk_id)->with('success', 'Data disposisi berhasil di edit!');
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Disposisi $disposisi)
    {
        $suratMasukId = $disposisi->surat_masuk_id;

        // hapus data dari db : 
        Disposisi::destroy($disposisi->id);

        // with() :: adalah session yang digunakan untuk mengirim pesan succes atau error saat data telah di inputkan : 
        return redirect('dashboard/disposisi/' . $suratMasukId)->with('success', 'Disposisi has been deleted!');

    }
    // public function delete(Disposisi $disposisi)
    // {
    //     $suratMasukId = $disposisi->surat_masuk_id;

    //     // hapus data dari db : 
    //     Disposisi::destroy($disposisi->id);

    //     // with() :: adalah session yang digunakan untuk mengirim pesan succes atau error saat data telah di inputkan : 
    //     return redirect('dashboard/disposisi/' . $suratMasukId)->with('success', 'Disposisi has been deleted!');
    // }

    // cetak disposisi : 
    public function cetak(Disposisi $disposisi)
    {
        return view('dashboardDisposisi.cetak', [
            'disposisi' => $disposisi,
            'users' => User::where('permission', '1')->get(),
        ]);
    }
}
