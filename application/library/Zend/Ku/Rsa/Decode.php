<?php

namespace Ku\Rsa;

/**
 * rsa解密
 *
 * 注意:
 * 些方法依赖于 OpenSSL 模块
 * 编译时, 需要增加 --with-openssl[=DIR] 参数
 */
class Decode {

    protected $_privateKeyFile = 'key.private';

    /**
     * 私钥解密
     *
     * @param string 密文（二进制格式且base64编码）
     * @param string 密钥文件（.pem / .key）
     * @param string 密文是否来源于JS的RSA加密
     * @return string|boolean 明文, 失败时, 返回 false
     */
    public function privatekeyDecodeing($crypttext, $fromjs = false) {
        $key_content = file_get_contents($this->getPrivateKeyFile());
        $prikeyid    = openssl_get_privatekey($key_content);
        $crypttext   = base64_decode($crypttext);
        $padding     = $fromjs ? OPENSSL_NO_PADDING : OPENSSL_PKCS1_PADDING;

        if (openssl_private_decrypt($crypttext, $sourcestr, $prikeyid, $padding)) {
            return $fromjs ? rtrim(strrev($sourcestr), "\0") : '' . $sourcestr;
        }

        return false;
    }

    public function getPrivateKeyFile() {
        return __DIR__ . DIRECTORY_SEPARATOR . $this->_privateKeyFile;
    }

}
