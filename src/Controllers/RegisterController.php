<?php

namespace APP\Controllers;
use APP\View;
use APP\Model;
use APP\Controller;
use APP\Request;
use APP\Session;

class RegisterController extends Controller implements View,Model{
    
    public function __construct(Request $request, Session $session){
        parent::__construct($request,$session);
    }

    public function index(){
        $dataview=['register'];
        $this->render($dataview,'register');
           
    }
    public function registable(){
    $uname=filter_input(INPUT_POST,'name');
    $passwd=filter_input(INPUT_POST,'pass');
    $email=filter_input(INPUT_POST,'email');
    $passwd=password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>4]);
    $db = $this->getDB();
    $registrable=$db->insertSchema($db,$email,$uname,$passwd);
    }
}