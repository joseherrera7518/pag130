<?php
include("conexion.php");

if(isset($_POST['guardar'])){

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO tareas(titulo, descripcion, fecha, estado)
            VALUES('$titulo','$descripcion','$fecha','$estado')";

    $conn->query($sql);
}

$datos = $conn->query("SELECT * FROM tareas ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Tareas</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container{
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h1{
            text-align: center;
            color: #333;
        }

        form{
            display: grid;
            gap: 10px;
            margin-bottom: 30px;
        }

        input, textarea, select{
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button{
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover{
            background: #0056b3;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td{
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th{
            background: #007bff;
            color: white;
        }

        .pendiente{
            color: orange;
            font-weight: bold;
        }

        .completada{
            color: green;
            font-weight: bold;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>Control de Tareas</h1>

    <form method="POST">

        <input type="text" name="titulo" placeholder="Título de tarea" required>

        <textarea name="descripcion" placeholder="Descripción" required></textarea>

        <input type="date" name="fecha" required>

        <select name="estado" required>
            <option value="">Seleccione estado</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Completada">Completada</option>
        </select>

        <button type="submit" name="guardar">
            Guardar Tarea
        </button>

    </form>

    <table>

        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

        <?php while($row = $datos->fetch_assoc()) { ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['titulo']; ?></td>

            <td><?php echo $row['descripcion']; ?></td>

            <td><?php echo $row['fecha']; ?></td>

            <td class="<?php echo strtolower($row['estado']); ?>">
                <?php echo $row['estado']; ?>
            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>