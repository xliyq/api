<?php


namespace App\Containers\Tiku\Models;


use App\Containers\Tiku\Models\Traits\HasGrade;
use App\Containers\Tiku\Models\Traits\HasSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Porto\Core\Models\CoreModel;

class TitleAttr extends CoreModel
{
    use SoftDeletes;
    use HasSubject, HasGrade;

    protected $fillable = [
        'title_id',
        'subject_id',
        'grade_id',
        'type_id',

    ];

    protected $casts = [
        'title_id'   => 'int',
        'subject_id' => 'int',
        'grade_id'   => 'int',
        'type_id'    => 'int',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $resourceKey = 'attr';


    public function type() {
        return $this->hasOne(TitleType::class, 'id', 'type_id');
    }
}