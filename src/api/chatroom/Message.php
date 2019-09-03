<?php
/**
 * 聊天室消息分发服务
 */

namespace fize\third\rongcloud\api\chatroom;

use fize\third\rongcloud\Api;

class Message extends Api
{

    /**
     * 聊天室消息停止分发方法
     * @param string $chatroom_id 聊天室Id
     * @return bool
     */
    public function stopDistribution($chatroom_id)
    {
        $uri = '/chatroom/message/stopDistribution';
        $params = [
            'chatroomId' => $chatroom_id
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 聊天室消息停止分发方法
     * @param string $chatroom_id 聊天室Id
     * @return bool
     */
    public function resumeDistribution($chatroom_id)
    {
        $uri = '/chatroom/message/resumeDistribution';
        $params = [
            'chatroomId' => $chatroom_id
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }
}