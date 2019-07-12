<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Data\Repositories\TitleRepository;
use App\Containers\Tiku\Models\Title;
use Illuminate\Support\Facades\DB;
use Porto\Core\Exceptions\DeleteResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class DeleteTitleTask extends CoreTask
{

    public function run(Title $title) {
        try {
            DB::beginTransaction();
            // 先删除试题关联数据
            $title->attr()->delete();
            $title->options()->delete();
            $title->knowledge()->delete();

            $title->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new DeleteResourceFailedException();
        }
    }
}