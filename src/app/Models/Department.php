<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['nama_departemen'];

    public function branchOffices()
    {
        return $this->belongsToMany(BranchOffice::class);
    }
}

