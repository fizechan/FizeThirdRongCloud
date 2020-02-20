<?php

namespace fize\third\rongcloud\chatroom;

use fize\third\rongcloud\Common;

/**
 * 聊天室成员管理
 */
class User extends Common
{
    /**
     * 查询聊天室内用户方法
     * @param string $chatroom_id 要查询的聊天室id
     * @param int $count 要获取的聊天室成员信息数，最多返回 500 个成员信息
     * @param int $order 加入聊天室的先后顺序， 1 为加入时间正序， 2 为加入时间倒序
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query($chatroom_id, $count, $order)
    {
        $uri = '/chatroom/user/query';
        $params = [
            'chatroomId' => $chatroom_id,
            'count'      => $count,
            'order'      => $order
        ];
        return $this->httpPost($uri, $params);
    }

    /**
     * 查询用户是否在聊天室方法
     * @param string $chatroom_id 要查询的聊天室 ID
     * @param string $user_id 要查询的用户 ID
     * @return bool
     */
    public function exist($chatroom_id, $user_id)
    {
        $uri = '/chatroom/user/exist';
        $params = [
            'chatroomId' => $chatroom_id,
            'userId'     => $user_id
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 批量查询用户是否在聊天室方法
     * @param string $chatroom_id 要查询的聊天室 ID
     * @param array $user_ids 要查询的用户 ID，每次最多不超过 1000 个用户 ID
     * @return mixed 成功时返回array，失败时返回false
     */
    public function exists($chatroom_id, array $user_ids)
    {
        $uri = '/chatroom/users/exist';
        $params = "chatroomId={$chatroom_id}";
        foreach ($user_ids as $user_id) {
            $params .= "&userId={$user_id}";
        }
        $rst = $this->httpPost($uri, $params);

        if (!isset($rst['code']) || $rst['code'] != 200) {
            return false;
        }

        return $rst['result'];
    }
}
