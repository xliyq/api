<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\KnowledgeRepository;
use Porto\Core\Criterias\Eloquent\ThisEqualThatCriteria;
use Porto\Core\Tasks\CoreTask;

class GetAllKnowledgesTask extends CoreTask
{
    protected $repository;

    public function __construct(KnowledgeRepository $repository) {
        $this->repository = $repository;
    }

    public function run() {
        return $this->repository->all();
    }

    /**
     * 设置pid为0的条件
     *
     * @param int $pid
     *
     * @return KnowledgeRepository
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function tree(int $pid = 0) {
        return $this->repository->pushCriteria(new ThisEqualThatCriteria('pid', $pid));
    }

    /**
     * @param $subjectId
     *
     * @return KnowledgeRepository
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function filterSubjectId($subjectId) {
        return $this->repository->pushCriteria(new ThisEqualThatCriteria('subject_id', $subjectId));
    }
}