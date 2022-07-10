<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insertar datos</title>
</head>
<body>
    <form action="actualizar.php" method="POST">
        <input type="text" name="texto" id="texto">
        <input type="text" name="texto2" id="texto">
        <input type="submit" value="Añadir pendiente">
    </form>

    <div id="todolist">
        <?php

            
            $servidor = "127.0.0.1";
            $nombreusuario = "root";
            $password = "";
            $db = "indicator";
        
            $conexion = new mysqli($servidor, $nombreusuario, $password, $db);
        
            if($conexion->connect_error){
                die("Conexión fallida: " . $conexion->connect_error);
            }

           
            
            
                
                $texto = $_POST['texto'];
                $texto2 = $_POST['texto'];
                $sql = "UPDATE indicadores SET UF = $texto, Dolar_observado = $texto2 WHERE id = 10";

                if($conexion->query($sql) === true){
                    
                }else{
                    die("Error al actualizar datos: " . $conexion->error);
                } 
            
           
            $sql = "SELECT * FROM indicadores WHERE id = 10";
            $resultado = $conexion->query($sql);

            if($resultado->num_rows > 0){
                while($row = $resultado->fetch_assoc()){
                    ?>
                    <div>
                        <form method="POST" id="form<?php echo $row['id']; ?>" action="">
                            <input name ="UF" value="<?php echo $row['UF']; ?>" id="<?php echo $row['UF']; ?>" type="checkbox" onchange="completarPendiente(this)">El valor actual de la UF es $ <?php echo $row['UF'];?>
                            <input name ="UF" value="<?php echo $row['Dolar_observado']; ?>" id="<?php echo $row['Dolar_observado']; ?>" type="checkbox" onchange="completarPendiente(this)">El valor actual del Dólar observado es $ <?php echo $row['Dolar_observado'];?>
                            
                        </form>
                    </div>
                    <?php
                    
                }
            }

            $conexion->close();

        ?>
    </div>

    <script>
        function completarPendiente(e){
            var id = "form" + e.id;
            var formulario = document.getElementById(id);
            formulario.submit();
        }
    </script>
</body>
</html>