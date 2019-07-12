<?php


namespace App\Containers\Tiku\Models\Traits;


use App\Containers\Tiku\Models\Subject;

trait HasSubject
{
    public function subject() {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}