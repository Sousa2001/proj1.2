<?php

namespace APP\Controllers;
use APP\View;
use APP\Model;
use APP\Controller;
use APP\Request;
use APP\Session;
use APP\DB;

class LoginController extends Controller implements View,Model{
    
    public function __construct(Request $request, Session $session){
        parent::__construct($request,$session);
    }

    public function index(){
        $dataview=['index'];
        $this->render($dataview,'index');
    }
    public function logeable(){
        $uname=filter_input(INPUT_POST,'your_name');
        $passwd=filter_input(INPUT_POST,'your_pass');
        $db = $this->getDB();
        $logeable=$db->login($db, $uname, $passwd);
        if($logeable==True){
        $_SESSION['uname']=$uname;
        Header('Location: /user');
           
        }else{
            echo "Error";
        }
    }
}