<?php


namespace App\Containers\Tiku\Tasks;


use App\Containers\Tiku\Models\Title;
use Porto\Core\Exceptions\UpdateResourceFailedException;
use Porto\Core\Tasks\CoreTask;

class UpdateTitleTask extends CoreTask
{

    public function run(Title $title, array $titleData, array $attr, $options, $knowledge): Title {
        try {
            if (empty($titleData) && empty($attr) && empty($options) && empty($knowledge)) {
                throw new UpdateResourceFailedException();
            }

            if ($titleData) {
                $title->update($titleData);
            }

            if ($attr) {
                $title->attr()->update($attr);
            }

            if ($options) {
                foreach ($options as $option) {
                    $title->options->where('id', $option['id'])->first()->update($option);
                }
            }

            if ($knowledge) {
                $title->knowledge()->sync($knowledge);
            }

            return $title;

        } catch (\Exception $exception) {
            throw  new UpdateResourceFailedException();
        }
    }
}