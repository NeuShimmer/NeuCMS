<?php
/**
 * 管理后台勿须权限即可访问的页面。
 * @author winerQin
 * @date 2015-11-19
 */

use services\AdminService;
use winer\Captcha;
use common\YUrl;

class PublicController extends \common\controllers\Guest {
    
    /**
     * 登录。
     */
    public function loginAction() {
        if ($this->_request->isPost()) {
            $username = $this->getString('username', '');
            $password = $this->getString('password', '');
            AdminService::login($username, $password);
            $url = YUrl::createBackendUrl('', 'Index', 'index');
            $this->success('<p>登录成功</p><p><a href="' . $url . '">如果页面长时间没有跳转，请点击这里继续</a></p>', $url, 1);
        }
    }
    
    /**
     * 登出。
     */
    public function logoutAction() {
        AdminService::logout();
        $url = YUrl::createBackendUrl('', 'Public', 'login');
        $this->success('退出成功', $url, 1);
    }
    
    /**
     * 验证码。
     */
    public function captchaAction() {
        $config = [
                'fontSize' => 22,'imageH' => 50,'imageW' => 160,'length' => 4,'useCurve' => false 
        ];
        $captcha = new Captcha($config);
        $captcha->entry(1);
        $this->end();
    }
} 