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
    
    <!--menu usuarios-->
    <template v-if="menu==1">
        <rol></rol>
    </template>
    <template v-if="menu==2">
        <h1>vistas</h1> 
    </template>
    <template v-if="menu==3">
        <h1>asignar vistas</h1>      
    </template>

    <!--menu personas -->
    <template v-if="menu==4">
        <genero></genero>
    </template>
    <template v-if="menu==5">
        <h1>docente</h1>        
    </template>
    <template v-if="menu==6">
        <h1>padre de familia</h1>          
    </template>
    <template v-if="menu==7">
        <h1>alumno</h1>          
    </template>

    <!--menu materias -->
    <template v-if="menu==8">
        <ciclo></ciclo>
    </template>
    <template v-if="menu==9">
        <dia></dia>
    </template>
    <template v-if="menu==10">
        <horario></horario>
    </template>
    <template v-if="menu==11">
        <bimestre></bimestre>
    </template>
    <template v-if="menu==12">
        <h1>Materia</h1>      
    </template>

    <!--menu grados -->
    <template v-if="menu==13">
        <seccion></seccion>
    </template>
    <template v-if="menu==14">
        <nivel></nivel>
    </template>
    <template v-if="menu==15">
        <h1>grado</h1>      
    </template>
    

@endsection