<?php

namespace APP\Controllers;
use APP\Request;
use APP\Controller;
use APP\Session;

final class IndexController extends Controller{

    public function __construct(Request $request, Session $session){
        parent::__construct($request,$session);
    }

    public function index(){
        $db = $this->getDB();
        //$data=$db->selectAll('users');

        // uso de functiones declaradas en el modelo 
        // y definidas en la clase abstracta
        //$stmt = $this->query($db, "SELECT * FROM users",null);
        //$result = $this->row_extract($stmt);
    $dataview=['title'=>'Todo'/*,'data'=>$data*/];
        $this->render($dataview);

    }

}