<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionScheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_name',
        'scheme_code',
        'scheme_type',
        'provider_type',
        'eligibility_criteria',
        'monthly_benefit',
        'status',
    ];

    public function citizenPensions()
    {
        return $this->hasMany(CitizenPension::class);
    }
}
