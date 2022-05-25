<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [
            'title' => 'home'
        ];

        $this->view('/index', $data);
    }
    public function register() {
  
        $this->view('register');
    }
    public function login() {

        $this->view('/login');
    }

}