<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $connection = 'mysql';


    protected $fillable = [
        'en', 'ru', 'ua',
    ];
    protected $attributes = [
        'en',
        'ru',
        'ua',
    ];
}
