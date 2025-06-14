<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'tanggal_lahir',
        'foto',
        'jabatan',
        'branch_office_id',
        'department_id',
        'user_id',
    ];

    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
