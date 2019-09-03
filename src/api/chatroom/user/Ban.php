<?php
/**
 * 聊天室成员禁言服务
 */

namespace fize\third\rongcloud\api\chatroom\user;

use fize\third\rongcloud\Api;

class Ban extends Api
{
    /**
     * 添加聊天室全局禁言方法
     * @param mixed $user_id 用户Id,要添加多个时请传入数组。
     * @param int $minute 禁言时长，以分钟为单位，最大值为43200分钟，为 0 表示永久禁言。
     * @return bool
     */
    public function add($user_id, $minute)
    {
        $uri = '/chatroom/user/ban/add';
        if(is_array($user_id)){
            $params = "minute={$minute}";
            foreach ($user_id as $id){
                $params .= "&userId={$id}";
            }
        }else{
            $params = [
                'userId' => $user_id,
                'minute' => $minute
            ];
        }

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 移除聊天室全局禁言方法
     * @param mixed $user_id 用户Id,要删除多个时请传入数组。
     * @return bool
     */
    public function remove($user_id)
    {
        $uri = '/chatroom/user/ban/remove';
        if(is_array($user_id)){
            $params = implode('&userId=', $user_id);
            $params = "userId=" . $params;
        }else{
            $params = ['userId' => $user_id];
        }

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 查询聊天室全局禁言用户方法
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query()
    {
        $uri = '/chatroom/user/ban/query';
        $rst = $this->httpPost($uri, []);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['users'];
    }
}