<?php

namespace APP;
use APP\Request;

final class App{

    static protected $action;
    static protected $req;

    public static function run(){

        $session=new Session();
        $routes = self::getRoutes();

        self::$req=new Request;
        $controller = self::$req->getController();
        self::$action = self::$req->getAction();
        self::dispatch($controller, $routes, $session);
    }


    private static function dispatch($controller,$routes,$session):void{

        try{
            if(in_array($controller,$routes)){
                // nombre del controlador
                // instancia del controlador
                // llamada a la funcion accion
                // dispatcher
                $nameController = '\\APP\Controllers\\'.ucfirst($controller).'Controller';
                $objContr = new $nameController(self::$req,$session);
                // comprobar si existe la accion como metodo en el objeto
                if(is_callable([$objContr,self::$action])){
                    call_user_func([$objContr,self::$action]);
                }else{
                    call_user_func([$objContr, 'error']);
                }
            }else{
                throw new \Exception("Ruta no disponible");
            }
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }
    /**
     * @return array
     * returns registered route array
     */

    static function getRoutes(){

        $dir =  __DIR__."/Controllers";
        $handle = opendir($dir);

        while(false != ($entry = readdir($handle))){

            if($entry != "." && $entry != ".."){
                $routes[] = strtolower(substr($entry,0,-14));
            }

        }

        return $routes;

    }

}