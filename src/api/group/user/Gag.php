<?php
/**
 * 群组成员禁言服务
 */

namespace fize\third\rongcloud\api\group\user;

use fize\third\rongcloud\Api;

class Gag extends Api
{
    /**
     * 添加禁言群成员方法
     * @param string $user_id 用户Id。
     * @param string $group_id 群组Id。
     * @param int $minute 禁言时长，以分钟为单位，最大值为43200分钟，为 0 表示永久禁言。
     * @return bool
     */
    public function add($user_id, $group_id, $minute)
    {
        $uri = '/group/user/gag/add';
        $params = [
            'userId' => $user_id,
            'groupId' => $group_id,
            'minute' => $minute
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 移除禁言群成员方法
     * @param string $user_id 用户Id。
     * @param string $group_id 群组Id。
     * @return bool
     */
    public function rollback($user_id, $group_id)
    {
        $uri = '/group/user/gag/rollback';
        $params = [
            'userId' => $user_id,
            'groupId' => $group_id
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 查询被禁言群成员方法
     * @param string $group_id 群组Id。
     * @return mixed 成功时返回array，失败时返回false
     */
    public function getList($group_id)
    {
        $uri = '/group/user/gag/list';
        $params = ['groupId' => $group_id];
        $rst = $this->httpPost($uri, $params);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['users'];
    }
}