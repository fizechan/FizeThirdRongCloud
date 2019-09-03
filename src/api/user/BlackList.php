<?php
/**
 * 用户黑名单服务API
 */

namespace fize\third\rongcloud\api\user;

use fize\third\rongcloud\Api;

class BlackList extends Api
{
    /**
     * 添加用户到黑名单方法
     * @param string $user_id 用户唯一标识
     * @param string $black_user_id 被加黑的用户Id
     * @return bool
     */
    public function add($user_id, $black_user_id)
    {
        $uri = '/user/blacklist/add';
        $params = [
            'userId' => $user_id,
            'blackUserId' => $black_user_id
        ];
        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 移除黑名单中用户方法
     * @param string $user_id 用户唯一标识
     * @param string $black_user_id 被加黑的用户Id
     * @return bool
     */
    public function remove($user_id, $black_user_id)
    {
        $uri = '/user/blacklist/remove';
        $params = [
            'userId' => $user_id,
            'blackUserId' => $black_user_id
        ];
        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 获取某用户黑名单列表方法
     * @param string $user_id 用户唯一标识
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query($user_id)
    {
        $uri = '/user/blacklist/query';
        $params = [
            'userId' => $user_id
        ];
        $rst = $this->httpPost($uri, $params);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['users'];
    }
}