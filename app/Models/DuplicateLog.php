<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuplicateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'duplicate_type',
        'detection_reason',
        'status',
        'remarks',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }
}
