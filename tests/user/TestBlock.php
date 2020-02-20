<?php

namespace user;

use fize\third\rongcloud\user\Block;
use PHPUnit\Framework\TestCase;

class TestBlock extends TestCase
{

    public function testQuery()
    {
        $block = new Block('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $block->query();
        var_dump($result);
        var_dump($block->getErrCode());
        var_dump($block->getErrMsg());
    }
}
