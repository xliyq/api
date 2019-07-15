<?php


namespace App\Containers\Tiku\Data\Criterias;


use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Porto\Core\Criterias\Eloquent\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class TitleAttrCriteria extends Criteria
{
    /**
     * @var array
     */
    private $attrs;

    public function __construct(array $attrs) {
        $this->attrs = $attrs;
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
//        $table = $model->getModel()->getTable();
//        return DB::table($table)
//            ->join('title_attrs', function (JoinClause $join) use ($table) {
//                $join->on($table . 'id', '=', 'title_id')->where($this->attrs);
//            });
        return $model->whereHas('attr', function ($query) {
            $query->where($this->attrs);
        });
    }
}