<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleTypeRepository;
use App\Containers\Tiku\Models\TitleType;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class CreateTitleTypeTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleTypeRepository $repository) {
        $this->repository = $repository;
    }

    public function run(string $name, int $subjectId, bool $supportOnline = false): TitleType {
        try {
            return $this->repository->create([
                'name'           => $name,
                'subject_id'     => $subjectId,
                'support_online' => $supportOnline,
            ]);
        } catch (\Exception $exception) {
            throw  new CreateResourceFailedException();
        }
    }
}