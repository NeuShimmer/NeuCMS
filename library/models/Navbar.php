<?php
/**
 * 导航栏表。
 * @author ShuangYa
 * @date 2017-4-29
 */

namespace models;

class Navbar extends DbBase {

    /**
     * 表名。
     *
     * @var string
     */
    protected $_table_name = 'ms_navbar';

	public function getByParent($id) {
        $sql = "SELECT * FROM {$this->_table_name} WHERE parent_id = :id ORDER BY rank ASC,id ASC";
        $sth = $this->link->prepare($sql);
        $sth->execute([':id' => $id]);
        $list = $sth->fetchAll();
        return $list;
	}

	public function del($id) {
        $sql = "DELETE FROM {$this->_table_name} WHERE id = :id";
        $sth = $this->link->prepare($sql);
        $sth->execute([':id' => $id]);
	}
}