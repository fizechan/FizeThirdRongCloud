<?php


use fize\third\rongcloud\User;
use PHPUnit\Framework\TestCase;

class TestUser extends TestCase
{

    public function testGetToken()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        //$result = $user->getToken('chenfengzhan', '陈峰展', 'https://qlogo4.store.qq.com/qzone/411370875/411370875/100?1343043837');
        $result = $user->getToken('liangyanping', '梁燕萍', 'https://qlogo1.store.qq.com/qzone/836110928/836110928/100?1389933367');
        var_dump($result);
    }

    public function testRefresh()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->refresh('chenfengzhan', '陈峰展');
        var_dump($result);
    }

    public function testBlock()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->block(['chenfengzhan', 'liangyanping'], 2);
        //$result = $user->user('chenfengzhan', 2);
        var_dump($result);
        var_dump($user->getErrCode());
        var_dump($user->getErrMsg());
    }

    public function testUnblock()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->unblock(['chenfengzhan', 'liangyanping']);
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($user->getErrCode());
        var_dump($user->getErrMsg());
    }

    public function testCheckOnline()
    {

    }
}
