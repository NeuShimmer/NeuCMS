<?php
use common\YCore;
/**
 * 图集相关
 * 
 * @author ShuangYa
 * @date 2017-4-29
 */

use common\YUrl;
use services\CategoryService;
use services\NewsService;
use winer\Paginator;
class AtlasController extends \common\controllers\Common {
    
    /**
     * 详情
     */
    public function detailAction() {
        $code = $this->getString('code');
		if (is_numeric($code)) {
			//Code is id
			$detail = NewsService::getNewsDetail($code, true);
		} else {
			//User self-define code
			$detail = NewsService::getByCodeDetail($code);
		}
		$connection_code_get = $this->getString('connection_code', '');
		if (!empty($connection_code_get)) {
			$connection_code = YCore::appconfig('connection.code');
		}
		if ($detail['display'] != 1 && (empty($connection_code_get) || $connection_code !== $connection_code_get)) {
			$this->error('图集不存在或已经删除', YUrl::createFrontendUrl('Index', 'Index', 'Index'));
		}
		$detail['content'] = json_decode($detail['content'], 1);
		$cat_info = CategoryService::getCategoryDetail($detail['cat_id']);
		$this->_view->assign('detail', $detail);
		$this->_view->assign('cat', $cat_info);
    }
	/**
	 * 列表
	 */
	public function listAction() {
        $cat = $this->getInt('cat');
        $page = $this->getInt('page', 1);
		$cat_info = CategoryService::getCategoryDetail($cat);
		$list = NewsService::getNewsList('', '', '', '', $page, 20, $cat, 1, 1, 2);
        $paginator = new Paginator($list['total'], 20);
        $page_html = $paginator->backendPageShow();
        $this->_view->assign('page_html', $page_html);
        $this->_view->assign('list', $list);
        $this->_view->assign('cat', $cat_info);
	}
}