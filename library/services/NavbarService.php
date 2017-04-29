<?php
/**
 * 导航栏相关
 * @author ShuangYa
 * @date 2017-4-29
 */
namespace services;

use common\YCore;
use models\Admin;
use models\Navbar;

class NavbarService extends BaseService {
	const NAV_NEWS = 1;
	const NAV_NEWS_LIST = 2;
	const NAV_ATLAS = 3;
	const NAV_ATLAS_LIST = 4;
	const NAV_PAGE = 5;
	const NAV_URL = 6;
	public static function getList() {
		$cached_list = YCore::getCache()->get(YCore::appconfig('database.redis.prefix', '') . 'navbar');
		if (empty($cached_list)) {
			$navbar_model = new Navbar();
			$navbar_list = $navbar_model->getByParent(0);
			if (is_array($navbar_list)) {
				foreach ($navbar_list as $key => $menu) {
					$navbar_list[$key]['sub'] = $navbar_model->getByParent($menu['id']);
				}
			}
			YCore::getCache()->set(YCore::appconfig('database.redis.prefix', '') . 'navbar', serialize($navbar_list));
		} else {
			$navbar_list = unserialize($cached_list);
		}
		return $navbar_list;
	}
	public static function get($id) {
		$navbar_model = new Navbar();
		$rs = $navbar_model->fetchOne([], ['id' => $id]);
		return $rs;
	}
	public static function add($parent_id, $name, $type, $content) {
		$navbar_model = new Navbar();
		$rs = $navbar_model->insert(['parent_id' => $parent_id, 'name' => $name, 'type' => $type, 'content' => $content]);
		//清除缓存
		YCore::getCache()->del(YCore::appconfig('database.redis.prefix', '') . 'navbar');
		return $rs;
	}
	public static function set($id, $parent_id, $name, $type, $content) {
		$navbar_model = new Navbar();
		$rs = $navbar_model->update(['parent_id' => $parent_id, 'name' => $name, 'type' => $type, 'content' => $content], ['id' => $id]);
		//清除缓存
		YCore::getCache()->del(YCore::appconfig('database.redis.prefix', '') . 'navbar');
		return $rs;
	}
	public static function del($id) {
		$navbar_model = new Navbar();
		$rs = $navbar_model->del($id);
		//清除缓存
		YCore::getCache()->del(YCore::appconfig('database.redis.prefix', '') . 'navbar');
		return $rs;
	}
	public static function getUrl($nav_item) {
		switch ($nav_item['type']) {
			case self::NAV_NEWS:
				$url = '/archives/' . $nav_item['content'];
				break;
			case self::NAV_NEWS_LIST:
				$url = '/list/' . $nav_item['content'];
				break;
			case self::NAV_ATLAS:
				$url = '/atlas/view/' . $nav_item['content'];
				break;
			case self::NAV_ATLAS_LIST:
				$url = '/atlas/list/' . $nav_item['content'];
				break;
			case self::NAV_PAGE:
				$url = '/page/' . $nav_item['content'];
				break;
			case self::NAV_URL:
				$url = $nav_item['content'];
				break;
			default:
				$url = '#';
				break;
		}
		return $url;
	}
}