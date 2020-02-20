<?php

namespace fize\third\rongcloud;

/**
 * 消息发送服务
 */
class Message extends Common
{
    public function privatePublish($from_user_id, $to_user_id)
    {
        //@todo
        //发送单聊消息方法
    }

    public function privatePublishTemplate()
    {
        //@todo
        //发送单聊模板消息方法
    }

    public function systemPublish()
    {
        //@todo
        //发送系统消息方法
    }

    public function systemPublishTemplate()
    {
        //@todo
        //发送系统模板消息方法
    }

    public function groupPublish()
    {
        //@todo
        //发送群组消息方法
    }

    public function chatroomPublish()
    {
        //@todo
        //发送聊天室消息方法
    }

    public function chatroomBroadcast()
    {
        //@todo
        //发送聊天室广播消息方法
    }

    public function broadcast()
    {
        //@todo
        //发送广播消息方法
    }

    /**
     * 消息撤回服务
     * @param string $from_user_id 消息发送人用户 Id
     * @param int $conversation_type 会话类型，二人会话是 1 、群组会话是 3 。
     * @param string $target_id 目标 Id，根据不同的 ConversationType，可能是用户 Id、群组 Id。
     * @param string $message_uid 消息唯一标识，可通过服务端实时消息路由获取，对应名称为 msgUID。
     * @param int $sent_time 消息发送时间，可通过服务端实时消息路由获取，对应名称为 msgTimestamp。
     * @return mixed
     */
    public function recall($from_user_id, $conversation_type, $target_id, $message_uid, $sent_time)
    {
        $uri = '/message/recall';
        $params = [
            'fromUserId'       => $from_user_id,
            'conversationType' => $conversation_type,
            'targetId'         => $target_id,
            'messageUID'       => $message_uid,
            'sentTime'         => $sent_time
        ];
        return $this->httpPost($uri, $params);
    }

    /**
     * 消息历史记录下载地址获取方法
     * @param string $date 指定北京时间某天某小时，格式为2014010101
     * @return mixed
     */
    public function history($date)
    {
        $uri = '/message/history';
        $params = [
            '$date' => $date
        ];
        return $this->httpPost($uri, $params);
    }

    /**
     * 消息历史记录删除方法
     * @param string $date 指定北京时间某天某小时，格式为2014010101
     * @return mixed
     */
    public function historyDelete($date)
    {
        $uri = '/message/history/delete';
        $params = [
            '$date' => $date
        ];
        return $this->httpPost($uri, $params);
    }
}
