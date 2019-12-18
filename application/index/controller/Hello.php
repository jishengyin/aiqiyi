<?php
namespace app\index\controller;
use think\Controller;

class Hello extends Controller
{
    public function index()
    {
        debug(111);
    }
    public function demo($id)
    {

        return $id;
    }

    public function demo1($name)
    {

        return $name;
    }
}
