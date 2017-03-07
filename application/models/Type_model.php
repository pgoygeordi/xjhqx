<?php 
class Type_model extends CI_Model{
    private $table;
    public function __construct(){
        parent::__construct();
        $this->initial();
    }
    private function initial(){
        if(!isset($this->table)){
            $this->table = $this->db->dbprefix("type");
        } 
    }    
    public function select_entry($options = array()){
        $sql = 'SELECT * FROM  `'.$this->table.'`';
        if(isset($options)){
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
        }
        //echo ($sql);
        return $this->db->query($sql);
    }
    public function conditionalQuery($options){
        $sql = 'SELECT * FROM  `'.$this->table.'`';
        if(isset($options['table'])){
            if(isset($options['where'])){
               $sql .= " ".$options['where']; 
            }
            if(isset($options['orderBy'])){
                $orderDir = (isset($options['orderDir']))?$options['orderDir']:"asc";
                $orderBy = $options['orderBy'];
                $sql .= " ORDER BY CONVERT(`$this->table`.`$orderBy` USING gbk) $orderDir ";
            }
            return $this->db->query($sql);
        }
        else{
            return false;
        }
    }
    public function getRowsWithParentId($targetId, $allRows = null){
        $rtArray = [];
        if(!isset($allRows)){
            $allRows = $this->select_entry();
        }
        if(!isset($targetId)){
            die("missing parameter targetId!!!");
        }   
        foreach ($allRows->result() as $row)
        {
            $id = $row->t_id;
            $name = $row->name;
            $pid = $row->parentId;
            if($pid == $targetId){
                //echo ("$pid == $targetId?".(!!($pid == $targetId)).",\n");
                $temp = ["id"=>$id, "name"=>$name, "parentId"=>$pid];
                $children = $this->getRowsWithParentId($id, $allRows);
                if(count($children) != 0){
                    $temp["children"] = $children;
                }
                array_push($rtArray, $temp);
            }
        }
        return $rtArray;
    }
    public function insert_entry(){
        $id = $this->input->post("id", true);
        $name = $this->input->post('name', true);
        $fuelType = $this->input->post('fuelType', true);
        $capacity = $this->input->post('capacity', true);
        $parentId = $this->input->post('parentId', true);
        if(!$parentId){
            $parentId = 0;
        }
        if($name && $fuelType){
            //generate insert query
            $sql = "INSERT INTO $this->table (`t_id`,`parentId` ,`childrenIds` ,`name` ,`fuelType` ,`capacity` ,`t1` ,`t2`) VALUES (NULL ,'".$parentId."', '0','".$name."',  '".$fuelType."','".$capacity."', NULL , NULL)";

            //echo $name.",".$fuelType.",".$capacity.",".$parentId.".";
            //echo $sql;
            if($this->db->query($sql)){
                redirect(site_url('lists/view'));
            }
            else{
                die("error when insert car types!");
            }
        }
        else{
            die("error when insert car types! invalid type name and fuel type!");
        }
    }
    public function update_entry(){
        $id = $this->input->post("id", true);
        $name = $this->input->post('name', true);
        $fuelType = $this->input->post('fuelType', true);
        $capacity = $this->input->post('capacity', true);
        $parentId = $this->input->post('parentId', true);
        if(!$parentId){
            $parentId = 0;
        }
        if($name && $fuelType){
            //update recode
            $sql = "UPDATE  $this->table SET  `name` =  '$name', `fuelType` =  '$fuelType',`capacity` =  '$capacity', `parentId` = '$parentId' WHERE `t_id` = $id;";

            //echo $name.",".$fuelType.",".$capacity.",".$parentId.".";
            //echo $sql;
            if($this->db->query($sql)){
                redirect(site_url('lists/view'));
            }
            else{
                die("error when update car types!");
            }
        }
        else{
            die("error when update car types! invalid type name and fuel type!");
        }    
    }
    public function del_entry($idstr){
        $sql = "DELETE FROM $this->table WHERE `$this->table`.`t_id` in (".$idstr.")";
        //echo $sql;
        // if($this->db->query($sql)){
        //     redirect(site_url('lists/view'));
        // }
    }   
}
?>