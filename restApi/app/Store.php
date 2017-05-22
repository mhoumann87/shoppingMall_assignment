<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_number', 'store_name', 'store_logo', 'store_phoneno','store_event',
    ];

    protected $primaryKey = 'store_number';
}

