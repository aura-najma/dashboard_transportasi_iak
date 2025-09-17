<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaktaKecelakaan extends Model
{
    protected $table = 'fakta_kecelakaan';
    public $timestamps = false;

    protected $fillable = [
        'id_lokasi',
        'id_tahun',
        'id_indikator',
        'nilai'
    ];

    // Relasi ke dimensi
    public function lokasi()
    {
        return $this->belongsTo(DimLokasi::class, 'id_lokasi', 'id_lokasi');
    }

    public function tahun()
    {
        return $this->belongsTo(DimTahun::class, 'id_tahun', 'id_tahun');
    }

    public function indikator()
    {
        return $this->belongsTo(DimIndikatorKecelakaan::class, 'id_indikator', 'id_indikator');
    }
}
