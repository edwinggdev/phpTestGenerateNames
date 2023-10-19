<?php
require 'vendor/autoload.php'; // Include Composer's autoloader
use Faker\Factory as FakerFactory;

class PersonCtrl extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->message = "";
        $this->view->data = [];
        //echo "<p>ctrl Consulta</p>";
    }

    function render(){
        $persons =  $this->model->get();
        $this->view->persons = $persons;
        $this->view->render('person/index');
    }

    public function generate() {
        $faker = FakerFactory::create();
        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $id= 0;
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $age = rand(15,80);

            // $user = new PersonClass($id, $firstName, $lastName, $age);
            $user['name'] = $firstName;
            $user['lastaname'] = $lastName;
            $users[] = $user;

            if($this->model->insert([ 'nombre'=>$firstName, 'apellido'=>$lastName,'edad'=>$age])){
                $mensaje = "Alumno Creado";
            }else{
                $mensaje = " Alumno ya Existe";
            }
        }
        echo json_encode($users);
    }

    function get(){
        header('Content-Type: application/json');

        //echo "get!!!";
        $persons =  $this->model->get();
        //$this->view->persons = $persons;
        echo json_encode($persons);
        // return $this->prepareJsonResponse("0","ok",$persons);
    }

    function put(){
        header('Content-Type: application/json');
        $data = array();
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        $id = $data['id'];
        $name = $data['name'];
        $lastname   = $data['lastname'];
        // $lastname2  = $data['lastname2'];
        $age  = $data['age'];
        $person = new Person();
        if($this->model->update(['name'=>$name,'lastname'=>$lastname,'age'=>$age, 'id'=>$id])){
            
            $data['response'] = "ok";
            $data['message'] = "Registro Actualizado";
            // $data[0]['response']= "ok";
            
        }else{
            $data['response'] = "no";
            $data['message'] = "Problema al Actualizar";
        }
        echo json_encode($data);
    }
    
    function delete(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        $id = $data['id'];

        if($this->model->delete($id)){
            $data['response'] = "ok";
            $data['message'] = "Registro Eliminado";
        }else{
            $data['response'] = "no";
            $data['message'] = "Problema al Eliminar";
        }
        $this->render();
    }

    function ver($param = null){
        //var_dump($param);
        $idAlumno = $param[0];
        $alumno = $this->model->getById($idAlumno);

        session_start();
        $_SESSION['alumno_id'] = $alumno->id;
        echo "alumno_id ".$_SESSION['alumno_id']."-".$alumno->id;
        $this->view->alumno = $alumno;
        $this->view->render('alumno/detalle');
    }

    function registrar(){
        $this->view->render('alumno/registrar');
    }

    function guardar(){
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        
        if($this->model->insert(['matricula'=>$matricula, 'nombre'=>$nombre, 'apellido'=>$apellido])){
            $mensaje = "Alumno Creado";
        }else{
            $mensaje = " Alumno ya Existe";
        }

        $this->view->mensaje = $mensaje;
        $this->render();
    }

    function actualizar(){
        session_start();
        //$id = $_SESSION['alumno_id'];
        //echo "alumno_id ".$_SESSION['alumno_id'] ;
        $id = $_POST['id'];
        $matricula = $_POST['matricula'];
        echo "matricula ".$_POST['matricula'] ;
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        echo "id.".$id;
        $alumno = new Alumno();
        unset($_SESSION['alumno_id']);
        if($this->model->update(['matricula'=>$matricula,'nombre'=>$nombre,'apellido'=>$apellido, 'id'=>$id])){
            
            $alumno->matricula = $matricula;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;

            $this->view->alumno = $alumno;
            $this->view->mensaje = "Registro Actualizado";
        }else{
            $this->view->alumno = $alumno;
            $this->view->mensaje = "Problema al Actualizar";
        }
        $this->view->render('alumno/detalle');
    }

    function eliminar($param = null){
        $matricula = $param[0];

        if($this->model->delete($matricula)){
            $this->view->mensaje = "Alumno eliminado";
        }else{
            $this->view->mensaje = "No se pudo";
        }
        $this->render();
    }

}
?>