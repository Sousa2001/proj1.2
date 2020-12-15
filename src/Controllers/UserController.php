<?php

namespace APP\Controllers;
use APP\View;
use APP\Model;
use APP\Controller;
use APP\Request;
use APP\Session;


class UserController extends Controller implements View,Model{
    
    public function __construct(Request $request, Session $session){
        parent::__construct($request,$session);
    }

    
    public function index(){
        $dataview=['title'=>'home'];
        $this->render($dataview,'home');
    }
    public function dashboard(){
        $dataview=['title'=>'dashboard'];
        $this->render($dataview,'dashboard');
    }
    public function dashaction(){
        $desc=filter_input(INPUT_POST,'descripcion');
        $date=filter_input(INPUT_POST,'fecha');
        $user=$_SESSION['uname'];
        $db=$this->getDB();
        $inserttask=$db->inserttask($db,$desc,$user,$date);
        $dataview=['title'=>'dashboard'];
        $this->render($dataview,'dashboard');
    }

    public function deldashaction(){
        $id_task=filter_input(INPUT_POST,'id_task');
        $user=$_SESSION['uname'];
        $db=$this->getDB();
        $deletetask=$db->deltask($db,$id_task,$user);
        $dataview=['title'=>'dashboard'];
        $this->render($dataview,'dashboard');
    }
}