<?php

namespace App\Containers\Tiku\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Porto\Core\Models\CoreModel;

class Title extends CoreModel
{
    use SoftDeletes;

    protected $fillable = [
        'content',
        'analysis',
        'answers'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'answers' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'titles';

    public function attr() {
        return $this->hasOne(TitleAttr::class, 'title_id', '');
    }

    public function options() {
        return $this->hasMany(TitleOption::class, 'title_id', 'id');
    }

    public function knowledge() {
        return $this->belongsToMany(Knowledge::class, 'title_knowledges', 'title_id', 'knowledge_id');
    }
}
