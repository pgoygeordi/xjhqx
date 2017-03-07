<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DataOutput extends MY_Controller{
    public function index(){
        //http://codeigniter.org.cn/forums/thread-3224-1-1.html
        $listTable = $this->input->post('listTable', true); //with the true means turn xss on.
        $recordlimit = intval($this->input->post('limit', true)); //intval convert string to integer
        $pageNum = intval($this->input->post('pageNum', true));
        //$rs = $this->getResultForPageNav($listTable, $pageNum, $recordlimit);
        $rs = $this->getResultForPageNav("type", 0, 30);
        //var_dump($rs->result())."<br/><br/>";
        //get_object_vars($rs)."<br/><br/>";
        //var_export($rs->result())."<br/><br/>";
        //print_r($rs->result())."\n\n";
        $response = array("data"=> array());
        $rowJson;
        foreach ($rs->result() as $row){
            $rowJson = array();
            foreach($row as $key => $value){
                //print "$key => $value\n";
                $rowJson[$key] = urlencode($value);     //for every chinese content apply with urlencode and apply urlencode function right before json_encode 
            }
            //var_dump($response["data"]);
            array_push($response["data"], $rowJson);
        }
        // $response = array("data"=> [
        //  array("title"=>urlencode("啊不不错方式"),"date"=>"2015-03-20"),
        //  array("title"=>urlencode("水陆兼浮沈"),"date"=>"2015-03-21"),
        //  array("title"=>urlencode("哈哈"),"date"=>"2015-03-21"),
        //  array("title"=>urlencode("大开发机构"),"date"=>"2015-03-23")
        // ]);
        var_dump($response);
        /*$this->output
        ->set_status_header(200)
        ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
        ->set_header('Pragma: no-cache')
        ->set_header('Expires: 0')
        ->set_content_type('application/json', 'utf-8')
        ->set_output(urldecode(json_encode($response)));*/
    }
    private function getResultForPageNav($tableName="type", $pageNum=0, $limit=30){
        $table = $this->db->dbprefix($tableName);
        $fromNum = $pageNum*$limit;
        $numOfRs = $limit;
        return $this->db->query('SELECT * FROM  `'.$table.'` LIMIT '.$fromNum.' , '.$numOfRs);
    }
}
?>

