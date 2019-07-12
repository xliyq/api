<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleTypeRepository;
use Porto\Core\Criterias\Eloquent\ThisEqualThatCriteria;
use Porto\Core\Tasks\CoreTask;

class GetAllTitleTypesTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleTypeRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $subjectId
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function run(int $subjectId) {
        $this->subject($subjectId);
        return $this->repository->paginate();
    }

    /**
     * @param int $subjectId
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    private function subject(int $subjectId) {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('subject_id', $subjectId));
    }
}