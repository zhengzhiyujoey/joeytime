<?php
namespace Fan;
class Tool{
    /**
     * 
     * @param string $ip2long
     * @return string
     */
    public static function getClientIp($ip2long = true) {
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
     * 
     * @param string $string
     * @return string 
     */
    public static function filter($string){
        return addslashes(htmlentities($string));
    }
    
}
