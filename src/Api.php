<?php
/**
 * 融云API基类
 */

namespace fize\third\rongcloud;

use fize\net\Http;
use fize\crypt\Json;

class Api
{

    /**
     * @var Http
     */
    private $http;

    /**
     * @var string
     */
    private $appKey;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var int 错误码
     */
    private $errCode = 0;

    /**
     * @var string 错误描述
     */
    private $errMsg = "";

    /**
     * @var string API域名
     */
    private static $DOMAIN_NAME = 'http://api.cn.ronghub.com';

    /**
     * @var array HTTP状态码描述
     */
    private static $HTTP_CODE_MSG = [
        '200' => '成功',
        '400' => '该请求是无效的，详细的错误信息会说明原因',
        '401' => '验证失败，详细的错误信息会说明原因',
        '403' => '被拒绝调用，详细的错误信息会说明原因',
        '404' => '服务器找不到请求的地址',
        '405' => '群容量超出上限，禁止调用',
        '429' => '超出了调用频率限制，详细的错误信息会说明原因',
        '500' => '服务器内部错误',
        '504' => '服务器在运行，本次请求响应超时，请稍后重试'
    ];

    /**
     * @var array 业务状态码
     */
    private static $BUSINESS_CODE_MSG = [
        '200'  => '成功',
        '404'  => '服务器找不到请求的地址',
        '1000' => '服务器端内部逻辑错误,请稍后重试',
        '1001' => 'App Key 与 App Secret 不匹配',
        '1002' => '参数错误，详细的描述信息会说明',
        '1003' => '没有 POST 任何数据',
        '1004' => '验证签名错误',
        '1005' => '参数长度超限，详细的描述信息会说明',
        '1006' => 'App 被锁定或删除',
        '1007' => '该方法被限制调用，详细的描述信息会说明',
        '1008' => '调用频率超限，详细的描述信息会说明，广播消息未开通时也会返回此状态码。',
        '1009' => '未开通该服务，请到开发者管理后台开通或提交工单申请。',
        '1015' => '要删除的保活聊天室 ID 不存在。',
        '1016' => '设置的保活聊天室个数超限。',
        '1050' => '内部服务响应超时',
        '2007' => '测试用户数量超限'
    ];

    /**
     * Api constructor.
     * @param string $app_key APP KEY
     * @param string $app_secret APP密钥
     */
    public function __construct($app_key, $app_secret)
    {
        $this->appKey = $app_key;
        $this->appSecret = $app_secret;
        $this->http = new Http();
    }

    /**
     * @return int 取得最后的错误码
     */
    public function getErrCode()
    {
        return $this->errCode;
    }

    /**
     * @return string 取得最后的错误描述
     */
    public function getErrMsg()
    {
        return $this->errMsg;
    }

    /**
     * @param bool $rc
     * @return array
     */
    private function getSendHeader($rc = false)
    {
        srand((double)microtime()*1000000); // 重置随机数种子。
        $nonce = rand(); // 获取随机数。
        $timestamp = time()*1000; // 获取时间戳（毫秒）。
        $signature = sha1($this->appSecret . $nonce . $timestamp);

        if($rc){
            return [
                'RC-App-Key' => $this->appKey,
                'RC-Nonce' => $nonce,
                'RC-Timestamp' => $timestamp,
                'RC-Signature' => $signature
            ];
        }
        return [
            'App-Key' => $this->appKey,
            'Nonce' => $nonce,
            'Timestamp' => $timestamp,
            'Signature' => $signature
        ];
    }


    protected function httpGet($p_url)
    {
        //@todo
    }

    /**
     * 核心POST函数
     * @param string $uri 请求的URI
     * @param mixed $param 提交的参数，可以是数组或者字符串，如果需要上传文件必须使用数组
     * @param bool $encode 是否对结果进行JSON编码
     * @return mixed 成功时返回对应结果，失败时返回false
     */
    protected function httpPost($uri, $param, $encode = true)
    {
        $url = self::$DOMAIN_NAME . $uri . '.json';

        $rst = $this->http->post($url, $param, $this->getSendHeader());

        if($rst === false){
            $this->errCode = $this->http->getLastErrCode();
            $this->errMsg = self::$HTTP_CODE_MSG[(string)$this->http->getLastErrCode()];
            return false;
        }

        if ($encode) {
            $json = Json::decode($rst);

            if($json === false){
                $this->errCode = '500';
                $this->errMsg = '解析JSON结果时发生错误';
                return false;
            }

            if (isset($json['code']) && $json['code'] != 200) {
                $this->errCode = $json['code'];
                $this->errMsg = self::$BUSINESS_CODE_MSG[(string)$json['code']];
                return false;
            }

            return $json;
        } else {
            return $rst;
        }
    }
}