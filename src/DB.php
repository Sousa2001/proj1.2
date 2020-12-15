<?php

namespace APP;

class DB extends \PDO{
    static $instance;
    protected array $config;

    static function singleton(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct(){
        $config=$this->loadConf();

        $strdbconf='dbconf_'.$this->env();
        $dbconf=(array)$config->$strdbconf;
        $dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
        $usr=$dbconf['dbuser'];
        $pwd=$dbconf['dbpass'];

        
        parent::__construct($dsn,$usr,$pwd);
    }
    private function env(){
        $ipAddress=gethostbyname($_SERVER['SERVER_NAME']);
        if($ipAddress=='127.0.0.1'){
            return 'dev';
        }else{
            return 'pro';
        }
    }
    private function loadConf(){
        $file="config.json";
        $jsonStr=file_get_contents($file);
        $arrayJson=json_decode($jsonStr);
        return $arrayJson;
    }
    public function login($db, $uname, $passwd){
        try{
            $stmt=$db->prepare('SELECT * FROM users WHERE uname=:uname LIMIT 1');
            $stmt->execute([':uname'=>$uname]);
            $count=$stmt->rowCount();
            
            $row=$stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            if($count==1){
                $user=$row[0];
                $res=password_verify($passwd,$user['passwd']);
    
                if($res){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(PDOExcetion $e){
            return false;
        }
    }
    function insertSchema($db,$email,$uname,$passwd){ 
        $command="
        INSERT INTO users(email,uname, passwd)
        VALUES ('$email','$uname', '$passwd')";
        try{
            $db->exec($command);
            echo 'Usuario Creado correctamente...';
            Header('Location: /login');
           // return True;
        }catch(PDOExeception $e){
           // return False;
           die($e->getMessage());
        }
    }

    
    function looktaskid($db,$uname){
        $command="SELECT * FROM task WHERE user='$uname';";
    
    try{
        foreach ($db->query($command) as $row) {
            print $row['id'] . "<br>";
        }
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
    }  
    
    function looktaskdesc($db,$uname){
        $command="SELECT * FROM task WHERE user='$uname';";
    
    try{
        foreach ($db->query($command) as $row) {
            print $row['description'] . "<br>";
        }
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
    } 
    
    function looktaskuser($db,$uname){
        $command="SELECT * FROM task WHERE user='$uname';";
    
    try{
        foreach ($db->query($command) as $row) {
            print $row['user'] . "<br>";
        }
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
    } 
    
    function looktaskdate($db,$uname){
        $command="SELECT * FROM task WHERE user='$uname';";
    
    try{
        foreach ($db->query($command) as $row) {
            print $row['due_date'] . "<br>";
        }
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
    } 
    
    function inserttask($db,$desc,$user,$date){
        $command="
    INSERT INTO task(description,user, due_date)
    VALUES ('$desc','$user', '$date')";
    try{
        $db->exec($command);
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
}   

    function deltask($db,$id_task,$user){
        $command="
        DELETE FROM task WHERE id='$id_task' AND user='$user'";
    try{
        $db->exec($command);
    }catch(PDOExeception $e){
       die($e->getMessage());
    }
    }  
}
