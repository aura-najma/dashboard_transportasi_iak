<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactTransportasi extends Model
{
    use HasFactory;

    protected $table = 'fakta_transportasi';   // nama tabel
    public $timestamps = false;                // karena di skema gak ada created_at / updated_at
}
