<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleRepository;
use App\Containers\Tiku\Models\Title;
use Illuminate\Support\Facades\DB;
use Porto\Core\Exceptions\CreateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class CreateTitleTask extends CoreTask
{
    protected $repository;

    public function __construct(TitleRepository $repository) {
        $this->repository = $repository;
    }

    public function run($titleData, $attr, $options, $knowledge): Title {
        try {
            DB::beginTransaction();
            // 添加试题表
            /**
             * @var $title Title
             */
            $title = $this->repository->create($titleData);
            // 属性表
            $title->attr()->create($attr);
            // 选项关联表
            $title->options()->createMany($options);
            // 知识点关联表
            $title->knowledge()->attach($knowledge);
            DB::commit();
            return $title;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new CreateResourceFailedException();
        }
    }

}