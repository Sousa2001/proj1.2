<?php
use APP\DB;
use APP\View;
use APP\Model;
use APP\Controller;
use APP\Request;
use APP\Session;

    $db = $this->getDB();
    $sql=file_get_contents('prouf1.sql');
    try{
        $db -> exec($sql);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }