<?php
require_once 'controllers/errorCtrl.php';
class App{
    
    function __construct(){
        //echo "ctrl App";
        $url = isset($_GET['url']) ? $_GET['url']  : null;
        //echo $url;
        $url = rtrim($url, '/');
        $url = explode('/',$url);

        // var_dump($url);
        if(empty($url[0])){
            $archivoController = 'controllers/mainCtrl.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }
        $archivoController = 'controllers/'. $url[0]. 'Ctrl.php';
        if(file_exists($archivoController)){
            require_once $archivoController;
            $class = $url[0]."Ctrl";
            $controller = new $class;
            
            $controller->loadModel($url[0]);

            $nparam = sizeof($url);
            if($nparam> 1){
                if($nparam >2){
                    $param = [];
                    for($i=2;$i<$nparam;$i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }
        }else{
            $controller = new Errorr();
        }

        
    }
}
?>