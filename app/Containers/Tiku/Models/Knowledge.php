<?php


namespace App\Containers\Tiku\Models;


use App\Containers\Tiku\Models\Traits\HasSubject;
use Porto\Core\Models\CoreModel;

class Knowledge extends CoreModel
{
    use HasSubject;

    protected $fillable = [
        'name',
        'subject_id',
        'pid',
        'sort'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function children() {
        return $this->hasMany($this, 'pid', 'id')->with('children');
    }

}