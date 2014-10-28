<?php

namespace Ku;

/**
 * 一些常用的判断
 */
class Is {

    /**
     * 是否是邮箱地址
     *
     * @param string $email
     * @return boolean
     */
    static public function email($email) {
        return \filter_var($email, \FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * 是否是有效的大陆手机号码
     *
     * 13+,145+,147+,15+,18+,
     *
     * @param string|int $num   号码
     * @return boolean
     */
    static public function mobileNum($num) {
        $num = trim($num);

        // 是否是11位
        if (11 !== strlen($num)) {
            return false;
        }

        $pattern = '/^(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/';

        return \preg_match($pattern, $num) ? true : false;
    }

    /**
     * 是否是有效的QQ号码
     *
     * @param string|int $num
     * @return boolean
     */
    static public function qqNum($num) {

        $pattern = '/^[1-9][0-9]{4,9}$/';

        return \preg_match($pattern, $num) ? true : false;
    }

}
