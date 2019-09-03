<?php
/**
 * 会话消息免打扰服务
 */

namespace fize\third\rongcloud\api;

use  fize\third\rongcloud\Api;

class Conversation extends Api
{

    /**
     * 设置会话消息免打扰方法
     * @param int $conversation_type 会话类型，二人会话是 1 、讨论组会话是 2 、群组会话是 3 、客服会话是 5 、系统通知是 6 、应用公众服务是 7 、公众服务是 8 。
     * @param string $request_id 设置消息免打扰的用户 Id
     * @param string $target_id 目标Id，根据不同的 ConversationType，可能是用户 Id、讨论组 Id、群组 Id、客服 Id、公众号 Id。
     * @param int $is_muted 消息免打扰设置状态，0 表示为关闭，1 表示为开启。
     * @return bool
     */
    public function notificationSet($conversation_type, $request_id, $target_id, $is_muted)
    {
        $uri = '/conversation/notification/set';
        $params = [
            'conversationType' => $conversation_type,
            'requestId' => $request_id,
            'targetId' => $target_id,
            'isMuted' => $is_muted
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 查询会话消息免打扰方法
     * @param int $conversation_type 会话类型，二人会话是 1 、讨论组会话是 2 、群组会话是 3 、客服会话是 5 、系统通知是 6 、应用公众服务是 7 、公众服务是 8 。
     * @param string $request_id 设置消息免打扰的用户 Id
     * @param string $target_id 目标Id，根据不同的 ConversationType，可能是用户 Id、讨论组 Id、群组 Id、客服 Id、公众号 Id。
     * @return mixed 失败时返回false，成功时返回数字。0 表示为关闭，1 表示为开启。
     */
    public function notificationGet($conversation_type, $request_id, $target_id)
    {
        $uri = '/conversation/notification/get';
        $params = [
            'conversationType' => $conversation_type,
            'requestId' => $request_id,
            'targetId' => $target_id
        ];

        $rst = $this->httpPost($uri, $params);

        if(!isset($rst['code']) || $rst['code'] != 200){
            return false;
        }

        return $rst['isMuted'];
    }
}