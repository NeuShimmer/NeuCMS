<?php
use common\YCore;
/**
 * 文章相关
 * 
 * @author ShuangYa
 * @date 2017-4-28
 */

use common\YUrl;
use services\CategoryService;
use services\NewsService;
use winer\Paginator;
class NewsController extends \common\controllers\Common {
    
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
		if ($detail['display'] != 1) {
			$this->error('文章不存在或已经删除', YUrl::createFrontendUrl('Index', 'Index', 'Index'));
		}
		$this->_view->assign('detail', $detail);
    }
	/**
	 * 列表
	 */
	public function listAction() {
        $cat = $this->getInt('cat');
        $page = $this->getInt('page', 1);
		$cat_info = CategoryService::getCategoryDetail($cat);
        $list = NewsService::getNewsList('', '', '', '', $page, 20, $cat, 1);
        $paginator = new Paginator($list['total'], 20);
        $page_html = $paginator->backendPageShow();
        $this->_view->assign('page_html', $page_html);
        $this->_view->assign('list', $list);
        $this->_view->assign('cat', $cat_info);
	}
}