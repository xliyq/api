<?php

namespace App\Containers\Authorization\Models;

use Porto\Core\Traits\ActivityTrait;
use Porto\Core\Traits\HasResourceKeyTrait;
use Porto\Core\Traits\HashIdTrait;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HashIdTrait;
    use ActivityTrait;
    use HasResourceKeyTrait;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];
}
