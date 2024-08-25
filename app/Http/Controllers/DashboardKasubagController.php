<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class DashboardKasubagController extends Controller
{
    public function index()
    {

        return view('dashboardKasubag.index', [
            'seluruhSuratMasuk' => SuratMasuk::surat_masuk_all(),
            'seluruhSuratKeluar' => SuratKeluar::seluruh_surat(),
            'suratMasukBlnIni' => SuratMasuk::surat_masuk_bulan_ini(),
            'suratKeluarBlnIni' => SuratKeluar::surat_keluar_bulan_ini()
        ]);
    }
}
