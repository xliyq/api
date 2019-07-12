# Criterias

## 定义
`Criterias`是用于在通过存储库从数据库检索数据时保存和应用查询条件的类。

如果不使用Criteria类，则可以将查询条件添加到存储库或作为范围的模型。但是使用Criterias，您的查询条件可以在多个模型和存储库之间共享。
它允许您定义查询条件一次，并在程序中的任何位置使用它。


原则
每个Container都有自己的Criterias。但是，共享`Criterias`应该应该在Ship层中创建。

Criteria必须不包含任何额外的代码，如果需要数据，数据应该从Actions或Task传递给它。它不应该运行（调用）任何数据任务。


## 规则
* 每个容器都有自己的`Criterias`。但是，共享`Criterias`应该应该在`Ship`层中创建。
* Criteria **必须** 不包含任何额外的代码，如果需要数据，数据应该从Actions或Task传递给它。它不应该运行（调用）任何数据任务。
* 所有`Criterias`必须延伸`Porto\Core\CoreCriteria`。
* 每个`Criterias`都应该有一个`apply()`方法。

## 文件夹结构
```text
- app
    - Containers
        - {container-name}
            - Data
                - Criterias
                  - RoleCriteria.php
                  - ...
    - Ship
        - Features
            - Criterias
               - Eloquent
                  - CreatedTodayCriteria.php
                  - NotNullCriteria.php
                  - ...
```

##  代码示例
```php
<?php

namespace App\Ship\Criterias\Eloquent;

use Illuminate\Support\Facades\DB;
use Porto\Core\Criterias\CoreCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CountCriteria
 *
 * @package Porto\Core\Criterias\Eloquent
 *
 * author liyq <2847895875@qq.com>
 */
class CountCriteria extends CoreCriteria
{

    /**
     * @var string
     */
    private $field;

    /**
     * CountCriteria constructor.
     *
     * @param $field
     */
    public function __construct($field) {
        $this->field = $field;
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
        return DB::table($model->getMedel()->getTable())
            ->select($this->field, DB::raw("count({$this->field}) as total_count"))
            ->groupBy($this->field);
    }
}
```