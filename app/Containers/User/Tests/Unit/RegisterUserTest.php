<?php


namespace App\Containers\User\Tests\Unit;


use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Porto\Core\Dto\DataDto;

/**
 * Class RegisterUserTest
 * 注册功能测试
 *
 * @package App\Containers\User\Tests\Unit
 *
 * author liyq <2847895875@qq.com>
 */
class RegisterUserTest extends TestCase
{
    /**
     * @test
     */
    public function testCreateUser_() {
        $data = [
            'phone'    => '15871450001',
            'password' => 'secret',
            'name'     => 'liyq',
        ];
        $dto = new DataDto($data);
        $action = App::make(RegisterUserAction::class);
        $user = $action->run($dto);

        // 断言返回值是否为用户对象
        $this->assertInstanceOf(User::class, $user);

        // 断言用户名称是否一致
        $this->assertEquals($user->name, $data['name']);
    }
}