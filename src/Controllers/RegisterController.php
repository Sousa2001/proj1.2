<?php

namespace App\Controllers;
use App\View;
use App\Model;
use App\Controller;
use App\Request;
use App\Session;

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