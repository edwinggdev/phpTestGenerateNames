<?php 
include_once 'models/personClass.php';

class personModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM personas");
            while($row = $query->fetch()){
                $item = new Person();
                $item->id = $row['id'];
                $item->name = $row['nombre'];
                $item->lastname = $row['apellido'];       
                $item->age = $row['edad'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOExceptio $e){
            echo $e;
        }
    }

    function getById($id){
        $item = new Alumno();
        $query = $this->db->connect()->prepare("SELECT * FROM alumnos WHERE id = :id");
        try{
            $query->execute(['id'=> $id]);
            while($row = $query->fetch()){
                $item->id = $row['id'];
                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
            }
            return $item;
        }catch(DBOException $e){
            return [];
        }
    }

    public function insert($datos){
        try{ 
            $query = $this->db->connect()->prepare('INSERT INTO personas (nombre,apellido,edad) VALUES (:nombre, :apellido,:edad)');
            $query->execute(['nombre'=>$datos['nombre'], 'apellido'=>$datos['apellido'],'edad'=>$datos['edad']]);
            //echo "datos insertados"; 
        }catch(PDOExceptio $e){
            echo " Error Insertando " .$e;
        }
        //echo "datos insertados";
    }

    function update($item){
        // var_dump($item);
        //$sql = ; echo $sql;
        //$query = $this->db->connect()->prepare("UPDATE alumnos SET nombre = ':nombre', apellido=':apellido' WHERE matricula = :matricula");
        try{
            $query = $this->db->connect()->prepare("UPDATE personas SET apellido=:lastname, nombre=:name, edad=:age WHERE id = :id");
            $query->bindValue('id', $item['id']);
            
            $query->bindValue('name', $item['name']);
            $query->bindValue('lastname', $item['lastname']);
            $query->bindValue('age', $item['age']);
            $query->execute();
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    function delete($id){
        echo $id;
        //$sql = ; echo $sql;
        $query = $this->db->connect()->prepare("DELETE FROM alumnos WHERE matricula = :matricula");
        try{
            $query->execute(
                [
                'matricula'=>$id,
                ]
            );
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
}
?>