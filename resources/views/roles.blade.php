<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Roles</title>
</head>
<body>
        <div class="container">
            <h1 class="text text-center">Registrar Roles</h1>
            <form class="container" role="form" method="POST" action="{{url('roles')}}">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputRoll">Ingrese el roll:</label>
                            <input type="text" class="form-control" id="inputIdentificacion" placeholder="Ingresar  roll" required>
                        </div>
                    </div>
                       
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>   
        </body>
        </html>
</body>
</html>