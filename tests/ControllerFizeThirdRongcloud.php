<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controller;

use fize\third\rongcloud\api\User;
use fize\third\rongcloud\api\user\Block;
use fize\third\rongcloud\api\user\BlackList;

/**
 * Description of Index
 *
 * @author Administrator
 */
class ControllerFizeThirdRongcloud
{

	public function actionUserGetToken()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        //$result = $user->getToken('chenfengzhan', '陈峰展', 'https://qlogo4.store.qq.com/qzone/411370875/411370875/100?1343043837');
        $result = $user->getToken('liangyanping', '梁燕萍', 'https://qlogo1.store.qq.com/qzone/836110928/836110928/100?1389933367');
        var_dump($result);
	}

    public function actionUserRefresh()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->refresh('chenfengzhan', '陈峰展');
        var_dump($result);
    }

    public function actionUserBlock()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->block(['chenfengzhan', 'liangyanping'], 2);
        //$result = $user->user('chenfengzhan', 2);
        var_dump($result);
        var_dump($user->getErrCode());
        var_dump($user->getErrMsg());
    }

    public function actionUserUnblock()
    {
        $user = new User('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $user->unblock(['chenfengzhan', 'liangyanping']);
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($user->getErrCode());
        var_dump($user->getErrMsg());
    }

    public function actionUserBlockQuery()
    {
        $block = new Block('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $block->query();
        var_dump($result);
        var_dump($block->getErrCode());
        var_dump($block->getErrMsg());
    }

    public function actionUserBlackListAdd()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->add('chenfengzhan', 'liangyanping');
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }

    public function actionUserBlackListRemove()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->remove('chenfengzhan', 'liangyanping');
        //$result = $user->unblock('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }

    public function actionUserBlackListQuery()
    {
        $bl = new BlackList('bmdehs6pbry3s', 'bkjAwyziOO');
        $result = $bl->query('chenfengzhan');
        var_dump($result);
        var_dump($bl->getErrCode());
        var_dump($bl->getErrMsg());
    }
}
