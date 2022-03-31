<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thematic extends Model
{
    use HasFactory;

    protected $table = 'thematics';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $hidden = [
        'status'
    ];
}
