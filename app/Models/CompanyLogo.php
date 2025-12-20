<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyLogo extends Model
{
    protected $fillable = [
        'logo_path',
        'original_name',
        'order',
    ];
}
