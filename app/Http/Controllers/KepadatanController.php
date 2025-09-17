<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepadatanController extends Controller
{
    public function apiLineChart()
    {
        $data = DB::table('fakta_kepadatan as f')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->join('dim_jenis_kendaraan as j', 'f.id_jenis_kendaraan', '=', 'j.id_jenis_kendaraan')
            ->where('j.nama_jenis_kendaraan', '<>', 'sepeda_motor') // exclude sepeda_motor
            ->select(
                't.tahun',
                'j.nama_jenis_kendaraan',
                DB::raw('SUM(f.total_kendaraan) as total_kendaraan')
            )
            ->groupBy('t.tahun', 'j.nama_jenis_kendaraan')
            ->orderBy('t.tahun')
            ->get();

        // Ambil list tahun unik (untuk kategori X axis)
        $categories = $data->pluck('tahun')->unique()->values();

        // Grupkan berdasarkan nama jenis kendaraan
        $grouped = $data->groupBy('nama_jenis_kendaraan');

        $series = [];
        foreach ($grouped as $jenis => $rows) {
            $values = [];
            foreach ($categories as $tahun) {
                // cari data untuk tahun tertentu, kalau tidak ada isi 0
                $values[] = optional($rows->firstWhere('tahun', $tahun))->total_kendaraan ?? 0;
            }
            $series[] = [
                "name" => $jenis,
                "data" => $values
            ];
        }

        return response()->json([
            "categories" => $categories,
            "series" => $series
        ]);
    }
    public function apiTopKepadatanMotor($tahun)
    {
        $data = DB::table('fakta_kepadatan as f')
            ->join('dim_lokasi as l', 'f.id_lokasi', '=', 'l.id_lokasi')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->join('dim_jenis_kendaraan as j', 'f.id_jenis_kendaraan', '=', 'j.id_jenis_kendaraan')
            ->where('t.tahun', $tahun)
            ->where('j.nama_jenis_kendaraan', 'sepeda_motor')
            ->select('l.kabupaten_kota', 'f.kendaraan_per_km')
            ->orderByDesc('f.kendaraan_per_km')
            ->limit(5)
            ->get();

        return response()->json([
            "categories" => $data->pluck('kabupaten_kota'),
            "series" => [
                [
                    "name" => "Kepadatan Sepeda Motor (kendaraan/km)",
                    "data" => $data->pluck('kendaraan_per_km')
                ]
            ]
        ]);
    }




}
