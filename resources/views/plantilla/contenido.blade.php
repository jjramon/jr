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
        <usuario></usuario> 
    </template>
    <template v-if="menu==3">
        <h1>asignar vistas</h1>      
    </template>

    <!--menu personas -->
    <template v-if="menu==4">
        <genero></genero>
    </template>
    <template v-if="menu==5">
        <tipopersona></tipopersona>       
    </template>
    <template v-if="menu==6">
        <persona></persona>      
    </template>
    <template v-if="menu==7">
        <h1>padre de familia</h1>          
    </template>
    <template v-if="menu==8">
        <alumno></alumno>          
    </template>

    <!--menu materias -->
    <template v-if="menu==9">
        <ciclo></ciclo>
    </template>
    <template v-if="menu==10">
        <dia></dia>
    </template>
    <template v-if="menu==11">
        <horario></horario>
    </template>
    <template v-if="menu==12">
        <bimestre></bimestre>
    </template>
    <template v-if="menu==13">
        <h1>Materia</h1>      
    </template>

    <!--menu grados -->
    <template v-if="menu==14">
        <seccion></seccion>
    </template>
    <template v-if="menu==15">
        <nivel></nivel>
    </template>
    <template v-if="menu==16">
        <h1>grado</h1>      
    </template>
    

@endsection