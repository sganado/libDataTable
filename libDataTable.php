<?php
//a partir de una BD con atributos crea una tabla.
include("conexionBD.php");
class libDataTable
{

	private static $tabla;
	public function __construct()
	{

	}

	//Metodo que conecta a la base de datos.
    public static function conectar($nombreTabla)
	{

	 	$conexion1 = new Conexion();
	    self::$tabla = $conexion1->mostrarDatos($nombreTabla);
	    return self::$tabla;
	}

	private static function verificarNombreTabla($nombreTabla)
	{
		$conexion1 = new Conexion();
	    $existeTabla = $conexion1->verificarTabla($nombreTabla);
	  
	    return $existeTabla;
	}

	static function tabla($nombreTabla)
	{
		//var_dump(self::verificarNombreTabla($nombreTabla));
	    if (!self::verificarNombreTabla($nombreTabla))
        {
            trigger_error("Esta tabla no existe,Vuelva a renombrar el nombre d ela tabla.");
            return false;
        }else
        {
        	
    		$dato =  self::conectar($nombreTabla);
    		//verifico si la tabla tiene datos o no
    		if (!$dato)
        	{
        		trigger_error("Esta tabla esta vacia.");
                return false;
        	}else
        	{
				//me traigo los nombres de las columnas
				foreach ($dato as $fila)  $columnas = array_keys($fila);	
				
    	    } 
        }
      
		//empiezo a crear la tabla con losnombres de la columna y las filas
		echo "<table><thead>";

		//columnas
		echo "<tr>";
		foreach ($columnas as $columna) 
		{
			echo "<th>" . $columna . "</th>"; 
		}
		echo "</tr></thead><tbody>";

		//filas
		foreach ($dato as $fila) 
		{
			echo "<tr>";
			foreach ($columnas as $columna) 
			{				 			
				echo '<td ondblclick= texTarea(this)>'.$fila[$columna].'</td>';
			}

			echo "</tr>";
		}	

		echo "</tbody></table>";
	}
}
?>
<script>
//document.getElementById("ocultar").style.display.visibility = "hidden";
var texTarea = function(td)
{

	//td.innerHTML = "<textarea>" + td.id + "</textarea>";

	var valor = td.innerHTML;
	
    td.innerHTML = "<textarea>" + valor + "</textarea>";
	var tipo = casting(valor);
	
	switch(tipo) 
	{
		case "numero":
			td1= document.createElement("td");

			td.appendChild(td1);
			td1.innerHTML="<input type='button' value='guardar'onclick=guardar() src=guardar.png'/>";
			alert(td1.id);
			td1.style.float = "right";
			break;
		case "string":
			td1= document.createElement("td");
			td.appendChild(td1);
			td1.innerHTML="<input type='button' value ='guardar' onclick='guardar(this)' src=guardar.png'/>";
			td1.style.float = "right";
			break;
		case "hora":
			td1= document.createElement("td");
			td.appendChild(td1);
			td1.innerHTML="<input type='button' value ='guardar' onclick='guardar(this)' src=guardar.png'/>";
			td1.style.float = "right";
			break;
		case "Date":
			td1= document.createElement("td");
			td.appendChild(td1);
			td1.innerHTML="<input type='button' value ='guardar' onclick='guardar(this)' src=guardar.png'/>";
			td1.style.float = "right";
			break;
	}

} 

var casting=function(string)
{
	var n=Number(string)
	var	hora= string.split(':');

	//Evaluo si es un numero.
	if (!isNaN(n)) return "numero";
	
	//evaluo si es hora
	if ((hora[0]<24)&&(hora[0]>0))
	{
		if ((hora[1]<59) && (hora[1]>0)) return "hora";
	}
	//Evaluo si es una fecha.
	if (new Date(string) != "Invalid Date") return "Date";
	
	
	
	// Evaluo si es un booleano.
	if ((string.toLowerCase() === "true") || (string.toLowerCase() === "false")) return "booleano";

	//Evaluo si es un string.
	if (string==String(string)) return "string";
}

var guardar=function guardar(datoAguardar)
{
	alert(datoAguardar);
}
</script>