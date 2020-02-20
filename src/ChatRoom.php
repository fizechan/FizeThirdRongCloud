<?php

namespace fize\third\rongcloud;

/**
 * 聊天室服务
 */
class ChatRoom extends Common
{

    /**
     * 创建聊天室方法
     * @param array $chatrooms id:要创建的聊天室的id；name:要创建的聊天室的name。
     * @return bool
     */
    public function create(array $chatrooms)
    {
        $uri = '/chatroom/create';
        $params = [];
        foreach ($chatrooms as $id => $name) {
            $params[] = "chatroom[{$id}]={$name}";
        }
        $params = implode('&', $params);

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 销毁聊天室方法
     * @param string $chatroom_id 要销毁的聊天室 Id
     * @return bool
     */
    public function destroy($chatroom_id)
    {
        $uri = '/chatroom/destroy';
        $params = ['chatroomId' => $chatroom_id];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 查询聊天室信息方法
     * @param string $chatroom_id 要查询的聊天室id
     * @return mixed 成功时返回array，失败时返回false
     */
    public function query($chatroom_id)
    {
        $uri = '/chatroom/query';
        $params = ['chatroomId' => $chatroom_id];
        $rst = $this->httpPost($uri, $params);

        if (!isset($rst['code']) || $rst['code'] != 200) {
            return false;
        }

        return $rst['chatRooms'];
    }
}
