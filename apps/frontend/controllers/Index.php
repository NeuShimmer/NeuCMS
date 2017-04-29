<?php
use common\YCore;
/**
 * 首页。
 * 
 * @author winerQin
 *         @date 2015-01-28
 */

class IndexController extends \common\controllers\Common {
    
    /**
     * 首页。
     */
    public function indexAction() {
        $this->end();
        $code = $this->getString('code', '');
        $create_home_page_code = YCore::appconfig('create.home.page.code');
        if ($code != $create_home_page_code) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location:./index.html');
        } else {
            $tpl_path = APP_VIEW_PATH . '/index/index.php';
            $html = $this->_view->render($tpl_path);
            $index_html = APP_SITE_PATH . DIRECTORY_SEPARATOR . 'index.html';
            file_put_contents($index_html, $html);
            echo 'ok';
        }
    }

	/**
	 * 特殊页面
	 */
	public function pageAction() {
		$this->end();
        $page = $this->getString('page');
        $script_path = $this->getViewPath();
		$fullpath = $script_path . "/page/{$page}.php";
		if (!preg_match('/^([a-zA-Z0-9_]+)$/', $page) || !is_file($fullpath)) {
			$this->error('页面不存在或已经删除', YUrl::createFrontendUrl('Index', 'Index', 'Index'));
		}
        $this->_view->display($fullpath);
	}
}