<?php


namespace App\Containers\Tiku\Actions;


use App\Containers\Tiku\Models\Title;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class UpdateTitleAction extends CoreAction
{
    /**
     * @param DataDto $dto
     *
     * @return Title
     * @throws \Dto\Exceptions\InvalidDataTypeException
     */
    public function run(DataDto $dto): Title {
        $titleData = $dto->sanitizeInput(['content', 'analysis', 'answers']);
        $attr = $dto->sanitizeInput(['subject_id', 'grade_id', 'type_id']);
        $knowledge = $dto->knowledge;
        $options = $dto->options;

        $title = Porto::call('Tiku@FindTitleByIdTask', [$dto->id]);

        $title = Porto::call('Tiku@UpdateTitleTask', [$title, $titleData, $attr, $options, $knowledge]);

        return $title;
    }
}