<?php

namespace App\Api;

use PhalApi\Api;


/**
 * 后端转发接口
 */

class Dorward extends Api {
    
        public function getRules() {
            return array(
                'getDorward' => array(
                    'url' => array('name' => 'url', 'type' => 'string', 'require' => true, 'desc' => '请求地址'),
                    'cookie' => array('name' => 'cookie', 'type' => 'string', 'require' => false, 'desc' => 'Cookie'),
                    'method' => array('name' => 'method', 'type' => 'string', 'require' => true, 'desc' => '请求方法'),
                ),
            );
        }

        public function getDorward() {
            $url = $this->url;
            $cookie = $this->cookie;
            $method = $this->method;
            $curl = curl_init(); // 启动一个CURL会话
            curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
            curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
            curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
            curl_setopt($curl, CURLOPT_COOKIE, $cookie); // 带上COOKIE请求
            curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
            curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
            $result = curl_exec($curl); // 执行操作
            $output = json_decode($result, true);
             
            if (curl_errno($curl)) {
                echo 'Errno'.curl_error($curl);//捕抓异常
            }
            curl_close($curl); // 关闭CURL会话
            // 返回data
            return $output;
        }
    
}