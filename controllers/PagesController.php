<?php

namespace controllers;
require_once('BaseController.php');

class PagesController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'pages';
    }

    public function index()
    {
        $this->render('index', array(),false);
    }

    public function home()
    {
        $data = array(
            'name' => 'Nguyễn Văn A',
            'age' => 20,
            'address' => 'Hà Nội'
        );
        $this->render('home', $data);
    }

    public function error()
    {
        $this->render('error', array(), false);
    }
}