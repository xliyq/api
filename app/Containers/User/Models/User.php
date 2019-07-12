<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use Liyq\Laravel\Notifications\JPush\JPushSender;
use Porto\Core\Models\CoreUserModel;

class User extends CoreUserModel
{

    use AuthorizationTrait;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'users';


    public function routeNotificationForSms() {
        return $this->phone;
    }

    public function routeNotificationForJpush() {
        return JPushSender::create('all', ['tag' => ['D5'], 'tag111' => '']);
    }
}
