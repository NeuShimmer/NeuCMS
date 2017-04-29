<?php
/**
 * 文章表。
 * @author ShuangYa
 * @date 2017-4-28
 */

namespace models;

class News extends DbBase {

    /**
     * 表名。
     *
     * @var string
     */
    protected $_table_name = 'ms_news';

    /**
     * 文章列表。
     *
     * @param string $title 文章标题。
     * @param number $admin_id 管理员ID。
     * @param string $starttime 开始时间。
     * @param string $endtime 截止时间。
     * @param number $page 分页页码。
     * @param number $count 每页显示记录条数。
	 * @param number $cat_id 分类ID
	 * @param number $cat_include_child 是否包含子分类
     * @return array
     */
    public function getList($title = '', $admin_id = -1, $starttime = '', $endtime = '', $page, $count, $cat_id = NULL, $cat_include_child = 1, $display = 0, $type = -1, $status = 1) {
        $offset  = $this->getPaginationOffset($page, $count);
        $columns = ' * ';
		$where = 'WHERE ';
        $params = [];
		if ($cat_id !== NULL) {
			if ($cat_include_child) {
				$ids = [$cat_id];
				$category_model = new Category();
				$childs = $category_model->getByParentToCategory($cat_id, 1, FALSE, TRUE);
				foreach ($childs as $v) {
					$ids[] = $v['cat_id'];
				}
				array_unique($ids);
				$where .= 'cat_id IN (' . implode(', ', $ids) . ') AND ';
			} else {
				$where .= 'cat_id = :cat_id AND ';
            	$params[':cat_id'] = $cat_id;
			}
		}
        if (strlen($title) > 0) {
            $where .= 'title LIKE :title AND ';
            $params[':title'] = "%{$title}%";
        }
        if (strlen($starttime) > 0) {
            $where .= 'created_time > :starttime AND ';
            $params[':starttime'] = strtotime($starttime);
        }
        if (strlen($endtime) > 0) {
            $where .= 'created_time < :endtime AND ';
            $params[':endtime'] = strtotime($endtime);
        }
        if ($admin_id != - 1) {
            $where .= 'created_by = :admin_id AND ';
            $params[':admin_id'] = $admin_id;
        }
        $where .= ' status = :status AND ';
        $params[':status'] = $status;
		if ($type !== -1) {
			$where .= 'type = :type AND ';
            $params[':type'] = $type;
		}
		if ($display) {
			$where .= 'display = 1 AND ';
		}
		$where = trim($where, 'AND ');
        //$order_by = ' ORDER BY news_id DESC ';
        $sql = "SELECT count(*) AS num FROM {$this->_table_name} {$where}";
        $sth = $this->link->prepare($sql);
        $sth->execute($params);
        $count_data = $sth->fetch();
        $total = $count_data ? $count_data['num'] : 0;
        $sql   = "SELECT {$columns} FROM {$this->_table_name} {$where} LIMIT {$offset},{$count}";
        $sth   = $this->link->prepare($sql);
        $sth->execute($params);
        $list = $sth->fetchAll();
        $result = [
            'list'   => $list,
            'total'  => $total,
            'page'   => $page,
            'count'  => $count,
            'isnext' => $this->IsHasNextPage($total, $page, $count)
        ];
        return $result;
    }
}