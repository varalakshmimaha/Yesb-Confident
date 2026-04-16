<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'occupation',
        'affiliate_interest',
        'affiliate_experience',
        'status',
    ];
}
