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
                width: 80px;
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
        
                section{
                clear: left;
                }
        
                #cliente{
                text-align: left;
                }
        
                #facliente{
                width: 40%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 15px;
                }
        
                #fac, #fv, #fa{
                color: #FFFFFF;
                font-size: 15px;
                }
        
                #facliente thead{
                padding: 20px;
                background: #2183E3;
                text-align: left;
                border-bottom: 1px solid #FFFFFF;  
                }
        
                #facvendedor{
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 15px;
                }
        
                #facvendedor thead{
                padding: 20px;
                background: #2183E3;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;  
                }
        
                #facarticulo{
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 15px;
                }
        
                #facarticulo thead{
                padding: 20px;
                background: #2183E3;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;  
                }
        
                #gracias{
                text-align: center; 
                }
    </style>
</head>
<body>
    <header>
        <div id="logo">
            <img id="imagen"  src="img/logo.png" alt="">
        </div>
        <div id="datos">
            <h1>Colegio Evángelico Shaddai</h1>
            <h2>Chiquimulilla, Santa Rosa</h2>
            <h2>{{now()}}</h2>
        </div>
    </header>
    <br>
    <section>
        <div>
            @foreach($persona as $p)
           
            <h1 id="fac">{{$p->nombreTp}}</h1><br><br>
            <p>Nombre: {{$p->nombrep}}<br> Apellido: {{$p->apellido}}<br>
            Identificación: {{$p->identifiacion}}<br> Genero:{{$p->nombreGenero}}<br>
            Dirección: {{$p->direccion}}<br> Tel: {{$p->tel}}<br>
            Correo: {{$p->correo}}<br>Usuario: {{$p->usuario}}<br>
            Contraseña: {{$p->pass}}<br></p>
            @endforeach    
        </div>
    </section>
    <footer>
        <div id="gracias">
                <p><strong>Por seguridad cambie su contraseña al iniciar seción por primera vez</strong></p>
        </div>
    </footer>

</body>
</html>