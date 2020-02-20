<?php

namespace fize\third\rongcloud;

/**
 * 用户服务
 */
class User extends Common
{

    /**
     * 获取 Token 方法，即用户注册
     * @param string $user_id 用户唯一标识
     * @param string $name 用户名称
     * @param string $portrait_uri 用户头像URI
     * @return mixed
     */
    public function getToken($user_id, $name, $portrait_uri)
    {
        $uri = '/user/getToken';
        $params = [
            'userId'      => $user_id,
            'name'        => $name,
            'portraitUri' => $portrait_uri
        ];
        return $this->httpPost($uri, $params);
    }

    /**
     * 刷新用户信息方法，即更新用户信息
     * @param string $user_id 用户唯一标识
     * @param string $name 用户名称,可选，提供即刷新，不提供忽略
     * @param string $portrait_uri 用户头像URI,可选，提供即刷新，不提供忽略
     * @return bool
     */
    public function refresh($user_id, $name = null, $portrait_uri = null)
    {
        $uri = '/user/refresh';
        $params = [
            'userId' => $user_id
        ];
        if (!is_null($name)) {
            $params['name'] = $name;
        }
        if (!is_null($portrait_uri)) {
            $params['portraitUri'] = $portrait_uri;
        }

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 检查用户在线状态方法,调用频率：每秒钟限 100 次
     * @param string $user_id 用户唯一ID
     * @return mixed
     */
    public function checkOnline($user_id)
    {
        $uri = '/user/checkOnline';
        $params = [
            'userId' => $user_id
        ];
        return $this->httpPost($uri, $params);
    }

    /**
     * 封禁用户方法
     * @param mixed $user_id 用户唯一ID，可以传入数组以封禁多个用户
     * @param int $minute 封禁时长，单位为分钟，最大值为43200分钟。
     * @return bool
     */
    public function block($user_id, $minute)
    {
        $uri = '/user/block';
        if (is_array($user_id)) {
            $params = "minute={$minute}";
            foreach ($user_id as $id) {
                $params .= "&userId={$id}";
            }
        } else {
            $params = [
                'userId' => $user_id,
                'minute' => $minute
            ];
        }

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 解除用户封禁方法
     * @param mixed $user_id 用户唯一ID，可以传入数组以封禁多个用户
     * @return bool
     */
    public function unblock($user_id)
    {
        $uri = '/user/unblock';
        if (is_array($user_id)) {
            $params = implode('&userId=', $user_id);
            $params = "userId=" . $params;
        } else {
            $params = [
                'userId' => $user_id
            ];
        }

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }
}
