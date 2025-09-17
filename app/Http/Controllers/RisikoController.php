<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RisikoController extends Controller
{
    /**
     * API: Multiple Bar Chart
     * X = Kabupaten/Kota
     * Y = Rasio Kecelakaan per Km
     * Series = Tahun (2020, 2021, dst)
     */
    public function apiMultipleRasio()
    {
        $data = DB::table('fakta_risiko as f')
            ->join('dim_lokasi as l', 'f.id_lokasi', '=', 'l.id_lokasi')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->select('l.kabupaten_kota', 't.tahun', 'f.rasio_kecelakaan_per_km')
            ->orderBy('l.kabupaten_kota')
            ->orderBy('t.tahun')
            ->get();

        // ambil semua tahun unik
        $tahunList = $data->pluck('tahun')->unique()->values();

        // ambil semua kabupaten unik
        $categories = $data->pluck('kabupaten_kota')->unique()->values();

        // format series per tahun
        $series = [];
        foreach ($tahunList as $tahun) {
            $values = [];
            foreach ($categories as $kab) {
                $row = $data->where('kabupaten_kota', $kab)
                            ->where('tahun', $tahun)
                            ->first();
                $values[] = $row->rasio_kecelakaan_per_km ?? 0;
            }
            $series[] = [
                "name" => (string) $tahun,
                "data" => $values
            ];
        }

        return response()->json([
            "categories" => $categories,
            "series" => $series
        ]);
    }
}
