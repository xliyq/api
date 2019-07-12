<?php


namespace App\Containers\Tiku\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Porto\Core\Models\CoreModel;

class TitleOption extends CoreModel
{
    use SoftDeletes;
    protected $fillable = [
        'title_id',
        'content',
        'is_right'
    ];

    protected $casts = [
        'is_right' => 'bool'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}