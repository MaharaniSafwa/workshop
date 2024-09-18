<?php

class Profile extends Controller {
    public function index(){
        $data['judul'] = "profile";
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('profile/index', $data);
        $this->view('templates/footer');
    }
}