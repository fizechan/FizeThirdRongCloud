<?php
/**
 * 聊天室封禁服务
 */

namespace fize\third\rongcloud\api\chatroom\user;

use fize\third\rongcloud\Api;

class Block extends Api
{
    /**
     * 添加封禁聊天室成员方法
     * @param string $user_id 用户Id。
     * @param string $chatroom_id 聊天室Id。
     * @param int $minute 封禁时长，以分钟为单位，最大值为43200分钟，为 0 表示永久禁言。
     * @return bool
     */
    public function add($user_id, $chatroom_id, $minute)
    {
        $uri = '/chatroom/user/block/add';
        $params = [
            'userId' => $user_id,
            'chatroomId' => $chatroom_id,
            'minute' => $minute
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 移除封禁聊天室成员方法
     * @param string $user_id 用户Id。
     * @param string $chatroom_id 聊天室Id。
     * @return bool
     */
    public function rollback($user_id, $chatroom_id)
    {
        $uri = '/chatroom/user/block/rollback';
        $params = [
            'userId' => $user_id,
            'chatroomId' => $chatroom_id
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 查询被封禁聊天室成员方法
     * @param string $chatroom_id 聊天室Id。
     * @return mixed 成功时返回array，失败时返回false
     */
    public function getList($chatroom_id)
    {
        $uri = '/chatroom/user/block/list';
        $params = ['chatroomId' => $chatroom_id];
        $rst = $this->httpPost($uri, $params);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['users'];
    }
}