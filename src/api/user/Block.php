<?php
/**
 * 封禁用户管理API
 */

namespace fize\third\rongcloud\api\user;

use fize\third\rongcloud\Api;

class Block extends Api
{

    /**
     * 获取被封禁用户方法
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query()
    {
        $uri = '/user/block/query';
        $rst = $this->httpPost($uri, []);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['users'];
    }
}