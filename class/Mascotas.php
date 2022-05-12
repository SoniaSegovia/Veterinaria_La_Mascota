<?php
class Mascotas
{
    private $DB;

    function __construct($conn)
    {
        $this -> DB = $conn;
    }

    public function Listar($consulta)
    {
        $establecer = $this -> DB -> prepare($consulta);
        $establecer -> execute() > 0;
         
        while($columna = $establecer -> fetch(PDO::FETCH_ASSOC))
        {
            ?> 
            <tr>
            <td><?php echo $columna['idmascota']?></td>
            <td><?php echo $columna['nombre']?></td>
            <td><?php echo $columna['raza']?></td>
            <td><?php echo $columna['color']?></td>
            <td><?php echo $columna['tamaño']?></td>
            <td><?php echo $columna['edad']?></td>
            
            <td>
                <a href="Editar_Animal.php?EditId=<?php echo $columna['idmascota']?>" class="btn btn-warning">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </td>
            <td>
                <a href="Eliminar_Mascota.php?ElimId=<?php echo $columna['idmascota']?>" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
             </td>
         </tr>
            
         <?php
        } 
    }

    public function Actualizar($Id, $nombre, $raza, $color, $tamaño, $edad)
    {
        try
        {
            $establecer = $this -> DB -> prepare("UPDATE Mascotas SET nombre = :nombre, 
           raza = :raza, color = :color, tamaño = :tamaño, edad= :edad WHERE idmascota = :idmascota");
            $establecer->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $establecer->bindParam(":razas", $raza, PDO::PARAM_STR);
            $establecer->bindParam(":color ", $color , PDO::PARAM_STR);
            $establecer->bindParam(":tamaño", $tamaño, PDO::PARAM_STR);
            $establecer->bindParam(":edad", $edad, PDO::PARAM_STR);
            $establecer->bindParam(":idmascota", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }

    public function Eliminar($Id)
    {
        try
        {
            $establecer = $this -> DB -> prepare("DELETE FROM Mascotas WHERE idmascotas=:idmascotas");
            $establecer->bindParam(":idmascota", $Id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }
}
?>