<?php

namespace App\Controllers;
use App\View;
use App\Model;
use App\Controller;
use App\Request;
use App\Session;
use App\DB;

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
        Header('Location:'.BASE.'user');
           
        }else{
            echo "Error";
        }
    }
}