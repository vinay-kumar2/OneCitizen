<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenPension extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'pension_scheme_id',
        'enrollment_number',
        'enrollment_date',
        'pension_start_date',
        'pension_status',
        'remarks',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function pensionScheme()
    {
        return $this->belongsTo(PensionScheme::class);
    }
}
