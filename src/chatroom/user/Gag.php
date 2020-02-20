<?php

namespace fize\third\rongcloud\chatroom\user;

use fize\third\rongcloud\Common;

/**
 * 聊天室成员禁言服务
 */
class Gag extends Common
{
    /**
     * 添加禁言聊天室成员方法
     * @param string $user_id 用户Id。
     * @param string $chatroom_id 聊天室Id。
     * @param int $minute 禁言时长，以分钟为单位，最大值为43200分钟，为 0 表示永久禁言。
     * @return bool
     */
    public function add($user_id, $chatroom_id, $minute)
    {
        $uri = '/chatroom/user/gag/add';
        $params = [
            'userId'     => $user_id,
            'chatroomId' => $chatroom_id,
            'minute'     => $minute
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 移除禁言聊天室成员方法
     * @param string $user_id 用户Id。
     * @param string $chatroom_id 聊天室Id。
     * @return bool
     */
    public function rollback($user_id, $chatroom_id)
    {
        $uri = '/chatroom/user/gag/rollback';
        $params = [
            'userId'     => $user_id,
            'chatroomId' => $chatroom_id
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 查询被禁言群成员方法
     * @param string $chatroom_id 聊天室Id。
     * @return mixed 成功时返回array，失败时返回false
     */
    public function getList($chatroom_id)
    {
        $uri = '/chatroom/user/gag/list';
        $params = ['chatroomId' => $chatroom_id];
        $rst = $this->httpPost($uri, $params);

        if (!isset($rst['code']) || $rst['code'] != 200) {
            return false;
        }

        return $rst['users'];
    }
}
