<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "issued_by",
        "issued_at",
        "description",
        "file"
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($certificate) {
            if (empty($certificate->issued_at)) {
                $certificate->issued_at = now();
            }
        });
    }
}
