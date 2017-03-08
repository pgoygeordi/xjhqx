<?php
class newAdd extends MY_Controller {
    public function carType($action = "add"){
        if(!file_exists(APPPATH.'views/newEdit/carType.php')){
           show_404();
        }
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        if($action === "edit"){
            //echo $this->input->get("id");
            $data['action'] = "edit";
            $options = [
                "table" => "type", 
                "where" => "where `t_id` = '".$this->input->get("id")."'",
            ];
            $data['editQuery'] = $this->type_model->select_entry($options);
        }
        else{
            $data['action'] = "add";
        }
        $data["types"] = $this->type_model->getRowsWithParentId("0");

        $this->load->view('siders/header.php', $data);
        $this->load->view('siders/left.php', $data);
        $this->load->view('newEdit/carType.php', $data);
        $this->load->view('siders/footer.php', $data);
    }
    public function typeModification(){
        $formAction = $this->input->post("action", true);
        if(isset($formAction)){
            if($formAction === "edit"){
                $this->type_model->update_entry();
            }
            elseif ($formAction === "add") {
                $this->type_model->insert_entry();
            }
        }
    }
    public function deleteSelectedType (){
        if(isset($_POST['checkbox'])){
            $idArr = $_POST['checkbox'];
            if(count($idArr)){
                $selectedItems = implode(',', $idArr); 
                $this->type_model->del_entry($selectedItems);
            }
        }
        //echo $this->input->post('checkbox', true);
    }
    public function carPart(){
        if(!file_exists(APPPATH.'views/newEdit/carPart.php')){
            show_404();
        }
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        $data['action'] = "添加";
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/left.php', $data);
        $this->load->view('newEdit/carPart.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
    public function service(){
        if(!file_exists(APPPATH.'views/newEdit/carService.php')){
            show_404();
        }
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        $data['action'] = "添加";
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/left.php', $data);
        $this->load->view('newEdit/carService.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
}
?>