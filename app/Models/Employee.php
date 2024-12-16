<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'number',
        'employee_type',
        'specialization',
        'availability_schema',
        'is_active',
        'note',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
}
