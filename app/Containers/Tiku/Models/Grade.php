<?php


namespace App\Containers\Tiku\Models;


use Porto\Core\Models\CoreModel;

class Grade extends CoreModel
{
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}