<?php
/**
 * 应用自身的引导程序。
 * -- 1、当与公共引导程序不一样则可以在这里自行配置。
 * @author ShuangYa
 * @date 2017-4-28
 */

class Bootstrap extends \common\Bootstrap {
    
    /**
     * 路由协议注册。
     * -- 1、之所以单独放在frontend,是希望不要影响其他应用。
     * 
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initRoute(\Yaf\Dispatcher $dispatcher) {
        $config = \Yaf\Application::app()->getConfig();
        $router = \Yaf\Dispatcher::getInstance()->getRouter();
        $router->addRoute('news_detail', new \Yaf\Route\Rewrite('/archives/:code', ['controller' => 'News', 'action' => 'detail']));
        $router->addRoute('news_list', new \Yaf\Route\Rewrite('/list/:cat', ['controller' => 'News', 'action' => 'list']));
        $router->addRoute('news_list_page', new \Yaf\Route\Rewrite('/list/:cat/:page', ['controller' => 'News', 'action' => 'list']));
        $router->addRoute('atlas_detail', new \Yaf\Route\Rewrite('/atlas/view/:code', ['controller' => 'Atlas', 'action' => 'detail']));
        $router->addRoute('atlas_list', new \Yaf\Route\Rewrite('/atlas/list/:cat', ['controller' => 'Atlas', 'action' => 'list']));
        $router->addRoute('atlas_list_page', new \Yaf\Route\Rewrite('/atlas/list/:cat/:page', ['controller' => 'Atlas', 'action' => 'list']));
    }
}