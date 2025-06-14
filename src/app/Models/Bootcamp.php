<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bootcamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'branch_office_id', // atau sesuai nama kolom FK ke branch office
    ];

    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class);
    }
}

