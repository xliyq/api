<?php


namespace App\Containers\Tiku\Models;


use App\Containers\Tiku\Models\Traits\HasSubject;
use Porto\Core\Models\CoreModel;

class TitleType extends CoreModel
{
    use HasSubject;

    protected $fillable = [
        'subject_id',
        'name',
        'support_online',
    ];

    protected $casts = [
        'support_online' => 'bool',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}