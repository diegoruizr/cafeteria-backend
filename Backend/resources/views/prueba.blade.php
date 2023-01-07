<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form class="form-group" method="post" action="/ResetDBController" enctype="multipart/form-data"> <!-- ruta entrenadores pokemon para dirigirla al controlador "Store" -->

        @csrf  <!-- proteccion contra Falsificacion de solicitudes entre sitios, osea comprobar que es un usuario identificado-->

            <!--CLASE DE BOOTSTRAP : FOMULARIO PARA QUE TOD LO QUE LO CONTIENE QUEDE DENTRO DEL DIV Y ORDENADO -->
            <div class="form-group">
                <label for="LabNombre">Nombre Empresa: </label>
                <input  type="text" name="txtNombre" class="form-control">
            </div>

            <div class="form-group">
                <label for="LabDescripcion">Descripcion: </label>
                <input  type="text" name="txtDescripcion" class="form-control">
            </div>

            <div class="form-group">
                <label for="LabAvatar">Avatar: </label>
                <input  type="file" name="fileAvatar">
            </div>

            <button type="submit" class="btn btn-primary">Guardar </button>
    </form>
</body>
</html>
