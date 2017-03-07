<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {

    public function view($page = 'home')
    {
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
        $data['title'] = ucfirst($page); // Uppercase the first letter
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/left.php', $data);
        $this->load->view('pages/'.$page.'.php', $data);
        $this->load->view('templates/footer.php', $data);

    }
    public function index()
    {
        $data['title'] = ucfirst("Home"); // Uppercase the first letter
        $data['siteTitle'] = '北京欣晶华汽车修理厂';
        $data['authorCopy'] = '<a href="mailto:pgoygeordi@outlook.com">PGOY</a> 2016';

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/left.php', $data);
        $this->load->view('pages/home.php', $data);
        $this->load->view('templates/footer.php', $data);
        $this->load->model('display');  
        $this->display->mainpage($data);
    }
}
?>