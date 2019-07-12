<?php


namespace App\Containers\Tiku\Models\Traits;


use App\Containers\Tiku\Models\Grade;

trait HasGrade
{
    public function grade() {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }
}