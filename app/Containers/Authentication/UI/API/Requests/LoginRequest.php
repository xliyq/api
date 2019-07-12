<?php


namespace App\Containers\Authentication\UI\API\Requests;


use Illuminate\Support\Arr;
use Porto\Core\Requests\Request;

class LoginRequest extends Request
{
    protected $access = [
        'permissions' => null,
        'roles' => null
    ];

    public function rules() {
        $prefix = config('authentication.login.prefix', '');
        $allowedLoginFields = config('authentication.login.allowed_login_attributes', ['phone' => []]);

        $rules = [
            'password' => 'required|min:6|max:15',
        ];

        foreach ($allowedLoginFields as $key => $optionalValidators) {
            $allOtherLoginFields = Arr::except($allowedLoginFields, $key);
            $allOtherLoginFields = array_keys($allOtherLoginFields);
            $allOtherLoginFields = preg_filter('/^/', $prefix, $allOtherLoginFields);
            $allOtherLoginFields = implode(',', $allOtherLoginFields);

            $validators = implode('|', $optionalValidators);
            $keyName = $prefix . $key;
            $rules = array_merge($rules, [
                $keyName => "required_without_all:{$allOtherLoginFields}|exists:users,{$key}|{$validators}",
            ]);
        }
        return $rules;
    }

    public function authorize() {
        return $this->check([
            'hasAccess'
        ]);
    }
}