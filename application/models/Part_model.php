<?php 
class Part_model extends CI_Model{
    private $table;
    public function __construct(){
        parent::__construct();
        $this->initial();
    }
    private function initial(){
        if(!isset($this->table)){
            $this->table = $this->db->dbprefix("part");
        } 
    }
    public function select_entry($options = array()){
        $sql = 'SELECT * FROM  `'.$this->table.'`';
        if(isset($options['where'])){
           $sql .= " ".$options['where']; 
        }
        if(isset($options['orderBy'])){
            $orderDir = (isset($options['orderDir']))?$options['orderDir']:"asc";
            $orderBy = $options['orderBy'];
            $sql .= " ORDER BY CONVERT(`$this->table`.`$orderBy` USING gbk) $orderDir ";
        }
        if(isset($options['pageOffset']) && isset($options['rowsPerPage'])){
            $sql.=" limit ".$options['pageOffset'].",".$options['rowsPerPage'];
        }
        //echo ($sql);
        return $this->db->query($sql);
    }
    public function insert_entry(){}
    public function update_entry(){}
    public function del_entry(){

    }   
}
?>