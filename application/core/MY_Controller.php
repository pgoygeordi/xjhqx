<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	function  __construct()
	{
		parent::__construct();
	}
	/*protected function queryWithPagination($tableName, $orderby=null, $orderDir="asc", $offset){
        $table = $this->db->dbprefix($tableName);
        $sql = 'SELECT * FROM  `'.$table.'`';
        if(isset($orderby)){
            $sql .= " ORDER BY CONVERT(`$table`.`$orderby` USING gbk) $orderDir ";
        }
        $sql.=" limit ".$offset.", 3";
        //echo ($sql);
        return $this->db->query($sql);
    }
    protected function queryAll($tableName, $orderby=null){
        $table = $this->db->dbprefix($tableName);
        $sql = 'SELECT * FROM  `'.$table.'`';
        if(isset($orderby)){
        	$sql .= " ORDER BY CONVERT(`$table`.`$orderby` USING gbk) $orderDir ";
        }
        //$sql.=" limit ".$offset.", 3";
        //echo ($sql);
        return $this->db->query($sql);
    }*/
}
?>