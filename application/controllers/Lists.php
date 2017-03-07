<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lists extends MY_Controller {
    private $perPage = 30;
    public function view($page = 'type', $offset=0)
    {
        //每页显示3条信息
        if(!file_exists(APPPATH.'views/lists/'.$page.'.php')){
            show_404();
        }

        $data['title'] = ucfirst($page); // Uppercase the first letter
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        $data['orderBy'] = "id";
        $data['formOn'] = $page;
        $data['orderDir'] = "asc";
        $data['searchOption'] = "";
        $totalRows = 0;
        switch($page){
            case "type":
                $queryAll = $this->type_model->select_entry();
                $totalRows = $queryAll->num_rows();
                $query = $this->type_model->select_entry(array('pageOffset'=>$offset, 'rowsPerPage'=>$this->perPage));
                break;
            case "part":
                $queryAll = $this->part_model->select_entry();
                $totalRows = $queryAll->num_rows();
                $query = $this->part_model->select_entry(array('pageOffset'=>$offset, 'rowsPerPage'=>$this->perPage));
                break;
        }
        //http://codeigniter.org.cn/user_guide/libraries/pagination.html#id7
        //1、载入分页类    
        $this->load->library('pagination');

        //2、配置项设置
        $config['base_url'] = site_url('/lists/view/type');
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $this->perPage;
        $config['uri_segment'] = 4;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        //$config['use_page_numbers'] = TRUE;

        //3、使用配置初始化分页类
        $this->pagination->initialize($config);
        /*
        $b['links'] = $this->pagination->create_links();
        $offset = $this->uri->segment(4);
        $this->db->limit($perPage, $offset);*/

        /*
        $b['goods'] = $this->g->select('goods'); 
        $this->load->view('admin/goodslist.html',$b);*/
        //die("orderBy = $orderBy, table = $table, option = $searchOpt");
        $data["listData"] = $query;
        $this->goToView($page, $data);
    }
    public function doSearch(){
        //$data['title'] = ucfirst($page); // Uppercase the first letter
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        $orderDir = ($this->input->post("orderDir") == "asc")?"asc":"desc";
        $orderBy = ($this->input->post("orderBy"));
        $table = ($this->input->post("formOn"));
        $searchOpt = ($this->input->post("searchOption"));
        $data['orderDir'] = $orderDir;
        $data['orderBy'] = $orderBy;
        $data['formOn'] = $table;
        $data['searchOption'] = $searchOpt;
        //echo "orderBy = $orderBy, table = $table, option = $searchOpt";
        //die();
        switch($table){
            case "type":
                $orderBy = $this->getOrderByColumnForType($orderBy);
                break;
            case "record":
                break;
            case "part":
                break;
            //default:

        }
        if(!!$table){
            $table = "type";
        }
        $options = [
            'table' => $table, 
            'orderBy' => $orderBy,
            'orderDir' => $orderDir,
        ];        
        if(!!$searchOpt){
            $options["where"] = "where `name` like '%$searchOpt%' or `fuelType` like '%$searchOpt%' or `capacity` like '%$searchOpt%'";
        }
        
        $query = $this->conditionalQuery($options);
        $data["typeList"] = $query;
        $this->goToView($table, $data);
    }
    private function getOrderByColumnForType($val){
        $ret = "";
        switch($val){
            case "name":
                $ret = "name";
                break;
            case "fuel":
                $ret = "fuelType";
                break;
            case "capacity":
                $ret = "capacity";
                break;
            default:
                $ret = "t_id";        
                break;
        }
        return $ret;
    }
    private function getOrderByColumnForPart($val){

    }
    private function getOrderByColumnForRecord($val){

    }
    public function index($listItems = "type")
    {
        $data['title'] = ucfirst("Home"); // Uppercase the first letter
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';
        $this->view($listItems);
    }
    private function goToView($page, $data){
        //die(var_dump($data));
        $this->load->view('siders/header.php', $data);
        $this->load->view('siders/left.php', $data);
        $this->load->view('lists/'.$page.'.php', $data);
        $this->load->view('siders/footer.php', $data);
    }
    
    public function search(){

    }
}
?>