<?php

namespace App\Http\Controllers;

use App\Models\FaktaKecelakaan;
use Illuminate\Support\Facades\DB;

class KecelakaanController extends Controller
{
    // Grafik 1: Jumlah kecelakaan per tahun per kabupaten/kota
    public function chartKecelakaanTahunan()
    {
        $data = DB::table('fakta_kecelakaan as f')
            ->join('dim_lokasi as l', 'f.id_lokasi', '=', 'l.id_lokasi')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->join('dim_indikator_kecelakaan as i', 'f.id_indikator', '=', 'i.id_indikator')
            ->select(
                'l.kabupaten_kota',
                't.tahun',
                DB::raw('SUM(f.nilai) as total')
            )
            ->where('i.nama_indikator', '=', 'jumlah_kecelakaan') // pakai nama asli
            ->groupBy('l.kabupaten_kota', 't.tahun')
            ->orderBy('l.kabupaten_kota')
            ->orderBy('t.tahun')
            ->get();

        // Ambil semua kabupaten unik
        $categories = $data->pluck('kabupaten_kota')->unique()->values();

        // Ambil semua tahun unik
        $tahunList = $data->pluck('tahun')->unique()->values();

        // Format jadi series
        $series = [];
        foreach ($tahunList as $tahun) {
            $series[] = [
                'name' => $tahun,
                'data' => $categories->map(function ($kab) use ($data, $tahun) {
                    $row = $data->where('kabupaten_kota', $kab)
                                ->where('tahun', $tahun)
                                ->first();
                    return $row ? $row->total : 0;
                })->toArray()
            ];
        }

        return response()->json([
            'categories' => $categories,
            'series' => $series
        ]);
    }

    public function apiTopMeninggal($tahun)
    {
        $data = DB::table('fakta_kecelakaan as f')
            ->join('dim_lokasi as l', 'f.id_lokasi', '=', 'l.id_lokasi')
            ->join('dim_tahun  as t', 'f.id_tahun',  '=', 't.id_tahun')
            ->join('dim_indikator_kecelakaan as i', 'f.id_indikator', '=', 'i.id_indikator')
            ->where('t.tahun', $tahun)
            ->where('i.nama_indikator', 'meninggal')   // fokus indikator meninggal
            ->select('l.kabupaten_kota', DB::raw('SUM(f.nilai) as jumlah_meninggal'))
            ->groupBy('l.kabupaten_kota')
            ->orderByDesc('jumlah_meninggal')
            ->limit(5)
            ->get();

        return response()->json([
            'categories' => $data->pluck('kabupaten_kota'),
            'series' => [[
                'name' => 'Jumlah Meninggal',
                'data' => $data->pluck('jumlah_meninggal'),
            ]],
        ]);
    }
    public function chartTopKerugian($tahun)
    {
        $data = DB::table('fakta_kecelakaan as f')
            ->join('dim_lokasi as l', 'f.id_lokasi', '=', 'l.id_lokasi')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->join('dim_indikator_kecelakaan as i', 'f.id_indikator', '=', 'i.id_indikator')
            ->where('t.tahun', $tahun)
            ->where('i.nama_indikator', 'kerugian')
            ->select('l.kabupaten_kota', DB::raw('SUM(f.nilai) as total'))
            ->groupBy('l.kabupaten_kota')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return response()->json([
            "categories" => $data->pluck('kabupaten_kota'),
            "series" => [[
                "name" => "Kerugian (Rp)",
                "data" => $data->pluck('total')
            ]]
        ]);
    }


}
