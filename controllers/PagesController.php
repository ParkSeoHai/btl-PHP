<?php

namespace controllers;
require_once('BaseController.php');

class PagesController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'pages';
    }

    public function home()
    {
        if(isset($_SESSION['userAdmin'])){
            $this->render('home');
        }
        $this->render('home');
    }

    public function login()
    {
        $this->render('login');
    }

    public function error()
    {
        $this->render('error');
    }
}