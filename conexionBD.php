<?php
class Conexion
{  
    //--------------------------conectarse ala base de datos----------------------------------------
	public static function conectar()
	{
        $dsn = 'mysql:dbname=registrosPersonas;host=localhost';
        $usuario = 'root';
        $contraseña = 'surigorbag13';
       
        try 
        {
            $gbd = new PDO($dsn, $usuario, $contraseña);
        }catch (PDOException $e)
        {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
       return $gbd;  
	}

    //---------------------------desconectarse de la base de datos----------------------------------
    private function desconectar($gdb)
    {
    	$gdb-> close();
    }
    //-------------------------------Consultas-------------------------------------------------------
    private function mostrar($consulta)
    {
        $pdo = self::conectar();
        $arreglo = array();
        $resultado = $pdo->query($consulta);
        /* obtener el array de objetos */
        //devuelve un array de cadenas que se corresponde con la fila obtenida o NULL si no hay más filas en el conjunto de resultados. 
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) 
        {
            $arreglo[] = $fila;
        }
        return $arreglo;     
        $this-> desconectar($pdo);      
    }

   
    public function verificarTabla($nombreTabla)
    {
        $pdo = self::conectar();
      $arreglo = array();
      $resultado = $pdo->query("SHOW TABLES");
      while($row= $resultado->fetch(PDO::FETCH_NUM))
      {
        if($row[0] == $nombreTabla)
            $arreglo[] = $row[0];
          
      }
      return $arreglo;

    }
    public function mostrarDatos($nombreTabla)
    {    
        //hago la consulta
        $consulta= "SELECT * FROM {$nombreTabla}";
        return $this->mostrar($consulta);           
    }
  
}
?>