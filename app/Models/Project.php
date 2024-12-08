<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "link",
        "date",
        "image"
    ];

    protected static function booted()
    {
        static::creating(function ($project) {
            if (empty($project->date)) {
                $project->date = now();
            }
        });
    }
}
