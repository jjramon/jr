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
            border-style:solid;
            border:1px;
            border-color:#000;
            width:90%;
        }
        #registro{
            margin:10px;
            padding: 10px;
            font-size: 18px;
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
        .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 3px solid #2F3640; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; }.datagrid table td, .datagrid table th { padding: 16px 20px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2F3640), color-stop(1, #2F3640) );background:-moz-linear-gradient( center top, #2F3640 5%, #2F3640 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2F3640', endColorstr='#2F3640');background-color:#2F3640; color:#FFFFFF; font-size: 16px; font-weight: bold; border-left: 2px solid #DCDDE1; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #2F3640; border-left: 3px solid #DCDDE1;font-size: 19px;border-bottom: 3px solid #DCDDE1;font-weight: normal; }.datagrid table tbody .alt td { background: #DCDDE1; color: #2F3640; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #2F3640;background: #DCDDE1;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }</head>
<body>
    <header >
        <div >
            <div id="logo">
                <img id="imagen"  src="img/logo.jpg" alt="">
            </div>
            <div id="datos">
                <h2>Colegio Evángelico Shaddai</h2>
                <h4>Chiquimulilla, Santa Rosa</h4>
                <h4>Fecha: {{ $fechaimpresion }} Hora: {{ $horaimpresion }}</h4>
            </div>
        </div>
    </header>
    <br>
    <section id="marco">
        <div id="registro">
            <p>{{ $alumno->nombre }} {{ $alumno->apellido }}<br>
            {{ $bimestre->nombre }} Bimestre<br>
           Ciclo escolar:  {{ $ciclo->nombre }}</p>
        </div>
    </section>
    <div class="datagrid"><table>
        <thead><tr><th>Materias</th>
            <th>Calificación</th>
            <th>Observaciones</th>
        </tr></thead>
        <tbody>
            @foreach($alumnos as $alumno_calificacion)
            <tr>
                <td>{{ $alumno_calificacion->nombreMateria }}</td>
                <td>{{ $alumno_calificacion->calificaciones }}</td>
                <td>{{ $alumno_calificacion->observacion }}</td>
            </tr>
            @endforeach
        </tbody>
        </table></div>

        

</body>
</html>