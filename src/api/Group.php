<?php
/**
 * 群组服务
 */

namespace fize\third\rongcloud\api;

use fize\third\rongcloud\Api;

class Group extends Api
{

    /**
     * 同步用户所属群组方法
     * @param string $user_id
     * @param array $groups 该用户所属的群信息,当不提交group[id]=name参数时，表示解除userId对应群的绑定关系；
     * @return bool
     */
    public function sync($user_id, array $groups = null)
    {
        $uri = '/group/sync';
        $params = "userId={$user_id}";
        if(!is_null($groups)){
            foreach ($groups as $id => $name){
                $params .= "&group[{$id}]={$name}";
            }
        }

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 创建群组方法
     * @param string $user_id 要加入群的用户 Id。
     * @param string $group_id 创建群组 Id。
     * @param string $group_name 群组 Id 对应的名称。
     * @return bool
     */
    public function create($user_id, $group_id, $group_name)
    {
        $uri = '/group/create';
        if(is_array($user_id)){
            $params = "groupId={$group_id}&groupName={$group_name}";
            foreach ($user_id as $id){
                $params .= "&userId={$id}";
            }
        }else{
            $params = [
                'userId' => $user_id,
                'groupId' => $group_id,
                'groupName' => $group_name
            ];
        }

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 创建群组方法
     * @param string $user_id 要加入群的用户 Id。
     * @param string $group_id 创建群组 Id。
     * @param string $group_name 群组 Id 对应的名称。
     * @return bool
     */
    public function join($user_id, $group_id, $group_name)
    {
        $uri = '/group/join';
        if(is_array($user_id)){
            $params = "groupId={$group_id}&groupName={$group_name}";
            foreach ($user_id as $id){
                $params .= "&userId={$id}";
            }
        }else{
            $params = [
                'userId' => $user_id,
                'groupId' => $group_id,
                'groupName' => $group_name
            ];
        }

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }

    /**
     * 退出群组方法
     * @param string $user_id 要加入群的用户 Id。
     * @param string $group_id 创建群组 Id。
     * @return bool
     */
    public function quit($user_id, $group_id)
    {
        $uri = '/group/quit';
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
     * 解散群组方法
     * @param string $user_id 要加入群的用户 Id。
     * @param string $group_id 创建群组 Id。
     * @return bool
     */
    public function dismiss($user_id, $group_id)
    {
        $uri = '/group/dismiss';
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
     * 解散群组方法
     * @param string $group_id 创建群组 Id。
     * @param string $group_name 群组 Id 对应的名称。
     * @return bool
     */
    public function refresh($group_id, $group_name)
    {
        $uri = '/group/refresh';
        $params = [
            'groupId' => $group_id,
            'groupName' => $group_name
        ];

        $rst = $this->httpPost($uri, $params);

        if(isset($rst['code']) && $rst['code'] == 200){
            return true;
        }

        return false;
    }
}