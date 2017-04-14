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
}