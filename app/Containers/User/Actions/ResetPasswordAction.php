<?php


namespace App\Containers\User\Actions;


use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class ResetPasswordAction extends CoreAction
{
    /**
     * @param DataDto $data
     *
     * @throws InternalErrorException
     */
    public function run(DataDto $data): void {
        $data = [
            'phone'                 => $data->phone,
            'token'                 => $data->token,
            'password'              => $data->password,
            'password_confirmation' => $data->password
        ];
        try {
            Password::broker()->reset($data, function (User $user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            });
        } catch (\Exception $exception) {
            throw new InternalErrorException();
        }
    }
}