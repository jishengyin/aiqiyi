<?php
namespace  app\admins\controller;
use think\Controller;

class Index extends Controller
{
    public function Index()
    {

        $this->redirect('Account/login');
    }
}