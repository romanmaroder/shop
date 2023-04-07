<?php


namespace core\tests\unit\entities\User;


use Codeception\Test\Unit;
use core\entities\user\User;

class SignByNetworkTest extends Unit
{
    public function testSuccess()
    {
        $user = User::signupByNetwork($network = 'vk', $identity = '123456');
        
        $this->assertCount(1, $networks = $user->networks);
        
        $this->assertEquals($identity, $networks[0]->identity);
        $this->assertEquals($network, $networks[0]->network);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertTrue($user->isActive());
    }
}