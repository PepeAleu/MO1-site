<?php

class SQL {

    private $con;

    public function SQL($servidor = "db513912217.db.1and1.com", $usuario = "dbo513912217", $password = "Antoniolocales88", $BD = "db513912217") {
        $this->con = mysqli_connect($servidor, $usuario, $password, $BD);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    public function insert($tabla, $valores, $columnas = false, $mostrar = false) {
        include_once "cadenas.php";
        $cadenasControl = new Cadenas;
        $valores = "(" . $cadenasControl->Delimitar($valores) . ")";
        if ($columnas) {
            $columnas = "(" . $cadenasControl->Delimitar($columnas) . ")";
        }
        $consulta = "INSERT INTO $tabla $columnas VALUES $valores";
        if ($mostrar) {
            echo $consulta;
        } else {
            mysqli_query($this->con, $consulta);
        }
        mysqli_close($this->con);
    }
    
    public function delete($tabla, $where = false, $mostrar = false) {
        include_once "cadenas.php";
        $cadenasControl = new Cadenas;
       
        if ($where) {
            $where = $cadenasControl->Delimitar($where);
            $where = "WHERE $where";
        }
        $consulta = "DELETE FROM $tabla $where";
        if ($mostrar) {
            echo $consulta;
        } else {
            mysqli_query($this->con, $consulta);
        }
        mysqli_close($this->con);
    }

    public function select($tabla, $where = false, $columnas = false, $order = false, $limit = false, $mostrar = false) {
        include_once "cadenas.php";
        $cadenasControl = new Cadenas;

        if ($where) {
            $where = $cadenasControl->Delimitar($where);
            $where = "WHERE $where";
        }
        if ($order) {
            $order = "ORDER BY $order";
        }
        if ($limit) {
            $limit = "LIMIT $limit";
        }
        
        if ($columnas) {
            $columnas = $cadenasControl->Delimitar($columnas);
        } else {
            $columnas = "*";
        }
        $consulta = "SELECT $columnas FROM $tabla $where $order $limit";
        //echo $consulta;

        if ($mostrar) {
            echo "$consulta<br>";
        }
        $result = $this->conectar($consulta);
        while ($fila = mysqli_fetch_array($result)) {
            $filas[] = $fila;
        }
        mysqli_close($this->con);
        return $filas;
    }

    public function getUltimo($tabla) {
        $filas = $this->select($tabla, false, false, "ID DESC", "0,1");
        return $filas[0];
    }

    private function conectar($consulta) {
        $result = mysqli_query($this->con, $consulta);
        return $result;
    }

}

?>