<?php
/**
 * 微信配置文件
 * User: heyiw
 * Date: 2017/9/11
 * Time: 22:03
 */

return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    // 小程序app_id
    'app_id' => 'wx720cf9c5765a5c4d',
    // 小程序app_secret
    'app_secret' => '14710b02d2505e63fc982db05a9204d9',

    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",


];