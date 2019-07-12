<?php

namespace App\Containers\Authorization\Models;

use Porto\Core\Traits\ActivityTrait;
use Porto\Core\Traits\HasResourceKeyTrait;
use Porto\Core\Traits\HashIdTrait;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HashIdTrait;
    use ActivityTrait;
    use HasResourceKeyTrait;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];


    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'permissions';
}
