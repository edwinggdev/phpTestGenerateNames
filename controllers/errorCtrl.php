<?php 
class Errorr extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->message = "Error 404";
        $this->view->render('error/index');
        //echo "<p>Error al cargar el recurso</p>";
    }
}
?>