<?php
use common\YCore;
/**
 * 文章相关
 * 
 * @author ShuangYa
 * @date 2017-4-14
 */

use common\YUrl;
use services\NewsService;
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
        $page = $this->getInt(YCore::appconfig('pager'), 1);
        $list = NewsService::getNewsList($title, $admin_name, $starttime, $endtime, $page, 20);
        $paginator = new Paginator($list['total'], 20);
        $page_html = $paginator->backendPageShow();
        $this->_view->assign('page_html', $page_html);
        $this->_view->assign('list', $list['list']);
        $this->_view->assign('admin_name', $admin_name);
        $this->_view->assign('title', $title);
        $this->_view->assign('starttime', $starttime);
        $this->_view->assign('endtime', $endtime);
	}
}