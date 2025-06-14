<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchOffice extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'alamat'];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function bootcamps()
    {
        return $this->hasMany(Bootcamp::class);
    }

    public function manager()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
}