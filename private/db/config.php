<?php
class DB{
    private $conxion, $result;

    public function DB($server, $user, $passs){
        $this ->conxion =new PDO($server, $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO:: ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION)) or die ('Error al conectar con la base de datos ');
    }

    public function consulta($sql=''){
        try{
            $parametros = func_get_arg();
            array_shift($parametros);
            $this ->preparado = $this->conexion ->prepare($sql);
            $this->result = $this ->preparado->execute($parametros);

        }catch(PDOExeption $e){
            echo 'Error: '.$e->getMessage();

        }
    }

    public function obtener_datos(){
        return $this->preparado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_respuestas(){
        return $this->result; //devuelve true si es exitoso o false si no 
    }

    public function obtenerUltimoId(){
        return $this->conxion->lastInsertId();
    }
}

?>