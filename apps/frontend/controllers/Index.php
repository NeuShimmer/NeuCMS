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
        $connection_code = YCore::appconfig('connection.code');
        if ($code === $connection_code) {
            $tpl_path = APP_VIEW_PATH . '/index/index.php';
            $html = $this->_view->render($tpl_path);
            $index_html = APP_SITE_PATH . DIRECTORY_SEPARATOR . 'index.html';
            file_put_contents($index_html, $html);
            echo 'ok';
		} else {
			if (is_file(APP_SITE_PATH . DIRECTORY_SEPARATOR . 'index.html')) {
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: index.html');
			} else {
				$tpl_path = APP_VIEW_PATH . '/index/index.php';
				$this->_view->display($tpl_path);
			}
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

	public function getPagesAction() {
        $this->end();
        $code = $this->getString('code', '');
        $connection_code = YCore::appconfig('connection.code');
        if (!$code === $connection_code) {
			echo 'fail';
			return;
		}
		$viewPath = $this->getViewPath() . '/page';
		$list = [];
		$dh = opendir($viewPath);
		if ($dh) {
			while ($f = readdir($dh)) {
				if ($f === '.' || $f === '..') {
					continue;
				}
				if (!is_file($viewPath . '/' . $f)) {
					continue;
				}
				$list[] = pathinfo($f, PATHINFO_FILENAME);
			}
		}
		@closedir($dh);
		echo json_encode($list);
	}
}