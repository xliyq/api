<?php


namespace App\Containers\Tiku\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class GetAllTitlesAction extends CoreAction
{
    /**
     * @param DataDto $dto
     *
     * @return mixed
     * @throws \Dto\Exceptions\InvalidDataTypeException
     */
    public function run(DataDto $dto) {
        $attrs = $dto->sanitizeInput(['subject_id', 'type_id', 'grade_id']);

        $knowledge = $dto->knowledge_id;

        $titles = Porto::call('Tiku@GetAllTitlesTask', [], [
            ['attr' => [$attrs]],
            ['knowledge' => [$knowledge]]
        ]);

        return $titles;
    }
}