<?php

namespace user;

use fize\third\rongcloud\user\BlackList;
use PHPUnit\Framework\TestCase;

class TestBlackList extends TestCase
{

    public function testAdd()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->add('chenfengzhan', 'liangyanping');
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }

    public function testRemove()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->remove('chenfengzhan', 'liangyanping');
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }

    public function testQuery()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->query('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }
}
