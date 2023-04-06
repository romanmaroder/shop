<?php


namespace core\tests\unit\entities\User;


use Codeception\Test\Unit;
use core\entities\user\User;

class RequestSignupTest extends Unit
{
    public function testSuccess()
    {
        $user = User::requestSignup($username= 'username', $email='email@site.com', $password='password');

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->verification_token);
        $this->assertTrue($user->isInactive());
        $this->assertFalse($user->isActive());
    }
}