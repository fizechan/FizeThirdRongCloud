<?php

namespace fize\third\rongcloud\group;

use fize\third\rongcloud\Common;

/**
 * 群组成员管理方法
 */
class User extends Common
{
    /**
     * 查询群成员方法
     * @param string $group_id 创建群组 Id。
     * @return bool
     */
    public function query($group_id)
    {
        $uri = '/group/user/query';
        $params = [
            'groupId' => $group_id
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }
}
