<?php

namespace fize\third\rongcloud;


/**
 * 敏感词服务
 */
class SensitiveWord extends Common
{
    /**
     * 添加敏感词方法
     * @param string $word 敏感词，最长不超过 32 个字符，格式为汉字、数字、字母。
     * @param string $replace_word 需要替换的敏感词，最长不超过 32 个字符
     * @return bool
     */
    public function add($word, $replace_word)
    {
        $uri = '/sensitiveword/add';
        $params = [
            'word'        => $word,
            'replaceWord' => $replace_word
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 移除敏感词方法
     * @param string $word 敏感词，最长不超过 32 个字符，格式为汉字、数字、字母。
     * @return bool
     */
    public function delete($word)
    {
        $uri = '/sensitiveword/delete';
        $params = [
            'word' => $word
        ];

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 批量移除敏感词方法
     * @param array $words 敏感词数组，一次最多移除 50 个敏感词。
     * @return bool
     */
    public function batchDelete(array $words)
    {
        $uri = '/sensitiveword/batch/delete';
        $params = implode('&words=', $words);
        $params = "words=" . $params;

        $rst = $this->httpPost($uri, $params);

        if (isset($rst['code']) && $rst['code'] == 200) {
            return true;
        }

        return false;
    }

    /**
     * 查询敏感词列表方法
     * @param string $type 查询敏感词的类型，0 为查询替换敏感词，1 为查询屏蔽敏感词，2 为查询全部敏感词。默认为 1。
     * @return mixed 成功时返回array，失败时返回false
     */
    public function getList($type = '1')
    {
        $uri = '/sensitiveword/list';
        $params = ['type' => $type];
        $rst = $this->httpPost($uri, $params);

        if (!isset($rst['code']) || $rst['code'] != 200) {
            return false;
        }

        return $rst['words'];
    }
}
