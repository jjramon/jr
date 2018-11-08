<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Registro</title>
    <style>
            body {
                /*position: relative;*/
                /*width: 16cm;  */
                /*height: 29.7cm; */
                /*margin: 0 auto; */
                /*color: #555555;*/
                /*background: #FFFFFF; */
                font-family: Arial, sans-serif; 
                font-size: 14px;
                /*font-family: SourceSansPro;*/
                }
        
                #logo{
                float: left;
                margin-top: 1%;
                margin-left: 2%;
                margin-right: 2%;
                }
        
                #imagen{
                width: 125px;
                }
        
                #datos{
                float: left;
                margin-top: 0%;
                margin-left: 2%;
                margin-right: 2%;
                /*text-align: justify;*/
                }
        
                #encabezado{
                text-align: center;
                margin-left: 10%;
                margin-right: 35%;
                font-size: 15px;
                }
        
                #fact{
                /*position: relative;*/
                float: right;
                margin-top: 2%;
                margin-left: 2%;
                margin-right: 2%;
                font-size: 20px;
                }
        
                #marco{
                clear: left;
                }
                #registro{
                    margin:10px;
                    padding: 10px;
                }
        
                #facliente{
                    background: #2f3640;
                    color: #fff;
                    width: 100%;
                    text-align: center;
                }

                #gracias{
                text-align: center; 
                }
    </style>
</head>
<body>
    <header >
        <div >
            <div id="logo">
                <img id="imagen"  src="img/logo.png" alt="">
            </div>
            <div id="datos">
                <h2>Colegio Evángelico Shaddai</h2>
                <h4>Chiquimulilla, Santa Rosa</h4>
                <h4>{{now()}}</h4>
            </div>
        </div>
    </header>
    <br>
    <section id="marco">
        <div id="registro">
            @foreach($persona as $p)
           
            <h2 id="facliente">{{$p->nombreTPersona}}</h2><br>
            <p>Nombre: {{$p->nombrePersona}}<br> Apellido: {{$p->apellido}}<br>
            Identificación: {{$p->identificacion}}<br> Genero:{{$p->nombreGenero}}<br>
            Dirección: {{$p->direccion}}<br> Tel: {{$p->tel}}<br>
            Correo: {{$p->correo}}<br>Usuario: {{$p->usuario}}<br>
            Contraseña: {{$pass}}<br></p> <br><br>
            @endforeach    
        </div>
    </section>
    <footer>
        <div id="gracias">
                <p><strong>Por seguridad cambie su contraseña al iniciar seción</strong></p>
        </div>
    </footer>

</body>
</html>