<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'status',
        'is_active',
        'note',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

