<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportasiController extends Controller
{
    // Halaman utama dashboard
    public function index()
    {
        return view('dashboard'); // nanti bikin Blade ini
    }

    // Grafik 1: Tren per kuartal per moda transportasi
    public function chartQuarterly($tahun = 2020)
    {
        $data = DB::table('fakta_transportasi as f')
            ->join('dim_bulan as b', 'f.id_bulan', '=', 'b.id_bulan')
            ->join('dim_jenis_transportasi as j', 'f.id_jenis_transportasi', '=', 'j.id_jenis_transportasi')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->select(
                'j.nama_jenis_transportasi',
                'b.kuartal',
                DB::raw('SUM(f.penumpang) as total')
            )
            ->where('t.tahun', $tahun)
            ->groupBy('j.nama_jenis_transportasi', 'b.kuartal')
            ->orderBy('b.kuartal')
            ->get();

        // format data series ApexCharts
        $series = [];
        foreach ($data->groupBy('nama_jenis_transportasi') as $jenis => $rows) {
            $series[] = [
                'name' => $jenis,
                'data' => $rows->pluck('total')->toArray()
            ];
        }

        return response()->json([
            'categories' => [1, 2, 3, 4], // kuartal
            'series' => $series
        ]);
    }

    // Grafik 2: Perbandingan total penumpang per moda transportasi
    public function chartStackedPercent()
    {
        $data = DB::table('fakta_transportasi as f')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->join('dim_jenis_transportasi as j', 'f.id_jenis_transportasi', '=', 'j.id_jenis_transportasi')
            ->select(
                't.tahun',
                'j.nama_jenis_transportasi',
                DB::raw('SUM(f.penumpang) as total')
            )
            ->groupBy('t.tahun', 'j.nama_jenis_transportasi')
            ->orderBy('t.tahun')
            ->get();

        $categories = $data->pluck('tahun')->unique()->values()->toArray();
        $totals = $data->groupBy('tahun')->map->sum('total');

        $series = [];
        foreach ($data->groupBy('nama_jenis_transportasi') as $jenis => $rows) {
            $series[] = [
                'name' => $jenis,
                'data' => $rows->map(function ($row) use ($totals) {
                    $persen = ($row->total / $totals[$row->tahun]) * 100;
                    return [
                        'x' => $row->tahun,
                        'y' => round($persen, 2),
                        'jumlah' => $row->total
                    ];
                })->toArray()
            ];
        }

        return response()->json([
            'categories' => $categories,
            'series' => $series
        ]);
    }
    // Grafik 3: Heatmap penumpang per bulan per tahun
    public function chartHeatmap()
    {
        $data = DB::table('fakta_transportasi as f')
            ->join('dim_bulan as b', 'f.id_bulan', '=', 'b.id_bulan')
            ->join('dim_tahun as t', 'f.id_tahun', '=', 't.id_tahun')
            ->select(
                't.tahun',
                'b.id_bulan',
                'b.nama_bulan',
                DB::raw('SUM(f.penumpang) as total')
            )
            ->groupBy('t.tahun', 'b.id_bulan', 'b.nama_bulan')
            ->orderBy('t.tahun')
            ->orderBy('b.id_bulan')
            ->get();

        $series = $data->groupBy('tahun')->map(function ($rows, $tahun) {
            return [
                'name' => $tahun,
                'data' => $rows->map(function ($row) {
                    return [
                        'x' => $row->nama_bulan,
                        'y' => (int) $row->total
                    ];
                })->toArray()
            ];
        })->values()->toArray();

        return response()->json($series);
    }


}
