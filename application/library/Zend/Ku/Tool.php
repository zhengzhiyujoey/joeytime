<?php

namespace Ku;

/**
 * 一些可能用到的小函数
 * 尽量用 "静态方法" 实现, 这样调用时就比较方便.
 *
 * @author Ghost
 */
class Tool {

    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @link http://php.net/manual/zh/function.array-column.php
     * @link https://github.com/ramsey/array_column
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    static public function arrayColumn($input = null, $columnKey = null, $indexKey = null) {
        static $isArrColumn = null;

        if ($isArrColumn === null) {
            $isArrColumn = function_exists('arr_column');
        }

        if ($isArrColumn) {
            return arr_column($input, $columnKey, $indexKey);
        }
        else {
            // Using func_get_args() in order to check for proper number of
            // parameters and trigger errors exactly as the built-in array_column()
            // does in PHP 5.5.
            $argc   = func_num_args();
            $params = func_get_args();

            if ($argc < 2) {
                trigger_error("array_column() expects at least 2 parameters, {$argc} given", \E_USER_WARNING);
                return null;
            }

            if (!is_array($params[0])) {
                trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', \E_USER_WARNING);
                return null;
            }

            if (!is_int($params[1]) && !is_float($params[1]) && !is_string($params[1]) && $params[1] !== null && !(is_object($params[1]) && method_exists($params[1], '__toString'))
            ) {
                trigger_error('array_column(): The column key should be either a string or an integer', \E_USER_WARNING);
                return false;
            }

            if (isset($params[2]) && !is_int($params[2]) && !is_float($params[2]) && !is_string($params[2]) && !(is_object($params[2]) && method_exists($params[2], '__toString'))
            ) {
                trigger_error('array_column(): The index key should be either a string or an integer', \E_USER_WARNING);
                return false;
            }

            $paramsInput     = $params[0];
            $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

            $paramsIndexKey = null;
            if (isset($params[2])) {
                if (is_float($params[2]) || is_int($params[2])) {
                    $paramsIndexKey = (int) $params[2];
                }
                else {
                    $paramsIndexKey = (string) $params[2];
                }
            }

            $resultArray = array();

            foreach ($paramsInput as $row) {

                $key      = $value    = null;
                $keySet   = $valueSet = false;

                if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                    $keySet = true;
                    $key    = (string) $row[$paramsIndexKey];
                }

                if ($paramsColumnKey === null) {
                    $valueSet = true;
                    $value    = $row;
                }
                else if (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                    $valueSet = true;
                    $value    = $row[$paramsColumnKey];
                }

                if ($valueSet) {
                    if ($keySet) {
                        $resultArray[$key] = $value;
                    }
                    else {
                        $resultArray[] = $value;
                    }
                }
            }

            return $resultArray;
        }
    }

    /**
     * 判断两个IP是否同个子网的.
     *
     * 注意: 如果 $ip = 0.0.0.0, 将来被认为是无效IP, 返回 false
     *
     * @author Ghost
     * @param string $ip        需要判断的IP
     * @param string $localIp   我的子网IP
     * @param string $netmask   我的子网掩码
     *
     * @return boolean
     */
    static public function checkNetAddress($ip, $localIp = '127.0.0.1', $netmask = '255.255.255.0') {
        $ipL = ip2long($ip);

        if (!$ipL) {
            return false;
        }

        $localIpL = ip2long($localIp);
        $netmaskL = ip2long($netmask);

        // 本地网络地址
        $localNetAddr = ($localIpL & $netmaskL);
        // 需要计算的网络地址
        $netAddr      = ($ipL & $netmaskL);

        return ($localNetAddr == $netAddr) ? true : false;
    }

    /**
     * 获取客户端的 IP
     *
     * @param boolean $ip2long 是否转换成为整形
     *
     * @return int|string
     */
    static public function getClientIp($ip2long = true) {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                $ip = $_SERVER ['HTTP_X_REAL_IP'];
            }
            else if (isset($_SERVER ['HTTP_X_FORWARDED_FOR'])) {
                $ip = array_pop(explode(',', $_SERVER ['HTTP_X_FORWARDED_FOR']));
            }
            elseif (isset($_SERVER ['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER ['HTTP_CLIENT_IP'];
            }
            else {
                $ip = $_SERVER ['REMOTE_ADDR'];
            }
        }
        else {
            if (getenv('HTTP_X_REAL_IP')) {
                $ip = getenv('HTTP_X_REAL_IP');
            }
            else if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = array_pop(explode(',', getenv('HTTP_X_FORWARDED_FOR')));
            }
            elseif (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            }
            else {
                $ip = getenv('REMOTE_ADDR');
            }
        }

        return $ip2long ? ip2long($ip) : long2ip(ip2long($ip));
    }

    /**
     * 获取客户端的 UA
     *
     * @return string
     */
    static public function getClientUa() {
        return isset($_SERVER['HTTP_USER_AGENT']) ? self::filter($_SERVER['HTTP_USER_AGENT']) : '';
    }

    /**
     * 字符串处理
     *
     * @param type $str
     * @return string
     */
    static public function filter($str) {
        return addslashes(htmlentities(trim($str)));
    }

    /**
     * url http
     *
     * @param string $url
     * @return string
     */
    static public function urlComplete($url) {
        $url = trim($url);
        return ((stripos($url, 'http://') === false && stripos($url, 'https://') === false && !empty($url)) ? 'http://' . $url : $url);
    }

    /**
     * 加密
     *
     * @param string $needle
     * @param string $secure
     * @return string
     */
    public static function encryption($needle, $secure = null){
        $mustStr = !$secure ? \Yaf\Registry::get('secureConfig')->get('encryption.default') : $secure;

        $md5str  = md5($needle . ':' . $mustStr);
        $randArr = str_split($md5str, 2);
        $randStr = strrev($randArr[mt_rand(0, count($randArr) - 1)]);

        return sha1($md5str. ':' . $randStr) . ':' . $randStr;
    }

    /**
     * 验证
     *
     * @param string $input
     * @param string $needle
     * @param string $secure
     *
     * return boolean
     */
    public static function valid($input, $needle, $secure = null){
        $mustStr = $secure === null ? \Yaf\Registry::get('secureConfig')->get('encryption.default') : $secure;
        $needleArr = explode(':', $needle);

        if(count($needleArr) == 2){
            $sha1Str = sha1(md5($input . ':' . $mustStr) . ':' . $needleArr[1]);

            if(strcmp($sha1Str, $needleArr[0]) === 0){
                return true;
            }
        }

        return false;
    }

      /**
     * 创建目录
     * @param string $path
     * @return boolean
     */
    public static function makeDir($path) {
        if (DIRECTORY_SEPARATOR == "\\") {//windows os
            $path = iconv('utf-8', 'gbk', $path);
        }
        if (!$path) {
            return false;
        }
        if (file_exists($path)) {
            return true;
        }
        if (mkdir($path, 0777, true)) {
            return true;
        }
        return false;
    }

    /**
     * API配置文件下的指定域名
     * @param string $conName
     * @return string
     */
    public static function getApiDomain($conName){
        $ini = new \Yaf\Config\Ini(APPLICATION_PATH . '/conf/api.ini', \Yaf\Application::app()->environ());
        return isset($ini[$conName])?$ini[$conName]:'';
    }

    /**
     * 获取来源地址
     * @return string
     */
    public static function getReferer(){
        $url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        return $url;
    }

}
