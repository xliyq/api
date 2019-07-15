<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Criterias\TitleAttrCriteria;
use App\Containers\Tiku\Data\Criterias\TitleKnowledgeCriteria;
use App\Containers\Tiku\Data\Repositories\TitleRepository;
use Porto\Core\Criterias\Eloquent\ThisEqualThatCriteria;
use Porto\Core\Tasks\CoreTask;

class GetAllTitlesTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleRepository $repository) {
        $this->repository = $repository;
    }

    public function run() {
        return $this->repository->paginate();
    }

    /**
     * 属性表中的条件
     *
     * @param array $attrs
     *
     * @return void
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function attr(array $attrs) {
        if (!empty($attrs)) {
            $this->repository->pushCriteria(new TitleAttrCriteria($attrs));
        }
    }

    /**
     * 知识点条件
     *
     * @param $knowledge
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function knowledge($knowledge) {
        if (!empty($knowledge)) {
            $this->repository->pushCriteria(new TitleKnowledgeCriteria($knowledge));
        }
    }
}