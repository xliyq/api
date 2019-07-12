<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Title;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class CreateTitleAction extends CoreAction
{
    public function run(DataDto $dto): Title {
        $titleData = $dto->only(['content', 'analysis', 'answers']);
        $attr = $dto->only(['subject_id', 'grade_id', 'type_id']);
        $options = $dto->options;
        $knowledge = $dto->knowledge;

        $title = Porto::call('Tiku@CreateTitleTask', [
            $titleData,
            $attr,
            $options,
            $knowledge
        ]);

        return $title;
    }
}