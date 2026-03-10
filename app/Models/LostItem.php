<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    protected $fillable = [
    'item_name',
    'description',
    'location_lost',
    'date_lost',
    'reporter_name',
    'contact',
    'status',
    ];
}

