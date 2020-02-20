<?php

namespace fize\third\rongcloud\user;

use fize\third\rongcloud\Common;

/**
 * 封禁用户管理
 */
class Block extends Common
{

    /**
     * 获取被封禁用户方法
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query()
    {
        $uri = '/user/block/query';
        $rst = $this->httpPost($uri, []);

        if (!isset($rst['code']) || $rst['code'] != 200) {
            return false;
        }

        return $rst['users'];
    }
}
