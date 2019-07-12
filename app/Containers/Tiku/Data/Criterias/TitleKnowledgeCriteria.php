<?php


namespace App\Containers\Tiku\Data\Criterias;


use Porto\Core\Criterias\CoreCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class TitleKnowledgeCriteria extends CoreCriteria
{
    private $knowledge;

    public function __construct($knowledge) {
        $this->knowledge = $knowledge;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository) {
        $model->whereHas('knowledge', function ($query) {
            if (is_array($this->knowledge)) {
                $query->whereIn('knowledge_id', $this->knowledge);
            } else if (is_numeric($this->knowledge)) {
                $query->where('knowldge_id', $this->knowledge);
            }

        });
    }
}