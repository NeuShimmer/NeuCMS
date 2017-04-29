<?php
/**
 * 页面管理。
 * @author ShuangYa
 * @date 2017-4-29
 */

use common\YCore;
use services\NavbarService;

class PageController extends \common\controllers\Admin {
    /**
	 * 列出所有特殊页面
	 */
	public function pagesAction() {
        $code = YCore::appconfig('connection.code');
        $frontend_home_page_url = YUrl::createFrontendUrl('', 'Index', 'getPages', [
                'code' => $code 
        ]);
        $ret = json_decode(YCore::pc_file_get_contents($frontend_home_page_url, 10), 1);
		$this->_view->assign('list', $ret);
	}
    /**
     * 导航栏列表。
     */
    public function navbarAction() {
        $list = NavbarService::getList();
        $this->_view->assign('list', $list);
    }

	public function navbarAddAction() {
        if ($this->_request->isXmlHttpRequest()) {
			$parent_id = $this->getInt('parent_id');
			$type = $this->getInt('type');
            $name = $this->getString('name');
            $content = $this->getString('content');
            $status = NavbarService::add($parent_id, $name, $type, $content);
            if ($status) {
                $this->json($status, '操作成功');
            } else {
                $this->json($status, '操作失败');
            }
        }
        $list = NavbarService::getList();
		$parentid = isset($_GET['parentid']) ? $_GET['parentid'] : NULL;
        $this->_view->assign('list', $list);
        $this->_view->assign('parentid', $parentid);
	}
	public function navbarEditAction() {
        if ($this->_request->isXmlHttpRequest()) {
			$id = $this->getInt('id');
			$parent_id = $this->getInt('parent_id');
			$type = $this->getInt('type');
            $name = $this->getString('name');
            $content = $this->getString('content');
            $status = NavbarService::set($id, $parent_id, $name, $type, $content);
            if ($status) {
                $this->json($status, '操作成功');
            } else {
                $this->json($status, '操作失败');
            }
        }
		$id = $this->getInt('id');
        $list = NavbarService::getList();
        $this->_view->assign('list', $list);
		$nav = NavbarService::get($id);
        $this->_view->assign('nav', $nav);
	}
    public function navbarDelAction() {
        $id = $this->getInt('id');
        $status = NavbarService::del($id);
        $this->json($status, '删除成功');
    }
}