<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'status',
    ];

    public function timeAttendances()
    {
        return $this->hasMany(TimeAttendance::class);
    }
}
