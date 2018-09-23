@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <main class="main">
                <!-- Breadcrumb -->
        
                <div class="container-fluid texte-center">
                    <div class="card container">
                        <div class="card-header">
                            Bienvenido
                        </div>
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                            ea commodo consequat.
                        </div>
                    </div>
                </div>
        </main>
    </template>
    <!--mantenimiento-->
        <!---Mantenimiento menu personas -->
            <template v-if="menu==1">
                <genero></genero>
            </template>
            <template v-if="menu==2">
                <tipopersona></tipopersona>       
            </template>
        <!---Mantenimiento menu usuarios -->
            <template v-if="menu==3">
                <rol></rol>
            </template>
            <template v-if="menu==4">
                <h1>asignar vistas</h1>      
            </template>
        <!--Mantenimiento menu materias -->
            <template v-if="menu==5">
                <ciclo></ciclo>
            </template>
            <template v-if="menu==6">
                <dia></dia>
            </template>
            <template v-if="menu==7">
                <horario></horario>
            </template>
            <template v-if="menu==8">
                <bimestre></bimestre>
            </template>
            <template v-if="menu==9">
                <materia></materia>
            </template>
        <!---Mantenimiento menu grados -->
            <template v-if="menu==10">
                <seccion></seccion>
            </template>
            <template v-if="menu==11">
                <nivel></nivel>
            </template>
            <template v-if="menu==12">
                <h1>grado</h1>      
            </template>

        <!---Maenu personas -->
            <template v-if="menu==13">
                <persona></persona>      
            </template>
            <template v-if="menu==14">
                <alumno></alumno> 
            </template>
            <template v-if="menu==15">
            <padrealumno></padrealumno>       
            </template>

        <!---Maenu materias -->
            <template v-if="menu==16">
                <h1>Materia</h1>      
            </template>
            <template v-if="menu==17">
                <h1>asignar grado</h1>      
            </template>
            <template v-if="menu==18">
                <h1>asignar docente</h1>      
            </template>
            <template v-if="menu==19">
                <h1>asignar alumno</h1>      
            </template>
            <template v-if="menu==20">
                <h1>ingresar calificaicones</h1>      
            </template>

        <!---Maenu pagos -->
            <template v-if="menu==21">
                <h1>Pagos</h1>     
            </template>
            <template v-if="menu==22">
                <h1>Morosos</h1> 
            </template>

@endsection