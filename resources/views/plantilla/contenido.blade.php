@extends('principal')
@section('contenido')
        @if(Auth::check())
                @if(Auth::user()->idRol == 1)
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
                                <carrera></carrera>      
                            </template>
                            <template v-if="menu==13">
                                <grado></grado>      
                            </template>
                
                        <!---Maenu personas -->
                            <template v-if="menu==14">
                                <persona></persona>      
                            </template>
                            <template v-if="menu==15">
                                <alumno></alumno> 
                            </template>
                            <template v-if="menu==16">
                                <campass></campass>       
                            </template>
                
                        <!---Maenu materias -->
                            <template v-if="menu==17">
                                <asignardocente></asignardocente>     
                            </template>
                            <template v-if="menu==18">
                                <asignargrado></asignargrado>      
                            </template>
                            <template v-if="menu==19">
                                <asignotas></asignotas>     
                            </template>
                            <template v-if="menu==23">
                                    <h1>VerNotas</h1> 
                                </template>
                
                        <!---Maenu pagos -->
                            <template v-if="menu==20">
                                <h1>Pagos</h1> 
                            </template>
                            <template v-if="menu==21">
                                <h1>Pagos</h1>     
                            </template>
                            <template v-if="menu==22">
                                <h1>Morosos</h1> 
                            </template>
                
                @elseif(Auth::user()->idRol == 2)
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
                    <template v-if="menu==16">
                        <campass></campass>       
                    </template>

                    <template v-if="menu==24">
                        <vercalif></vercalif> 
                    </template>
                @elseif(Auth::user()->idRol == 3)
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
                    <template v-if="menu==16">
                        <campass></campass>       
                    </template>
                    <template v-if="menu==19">
                        <asignotas></asignotas>     
                    </template>
                @elseif(Auth::user()->idRol == 4)
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

                            <!--Mantenimiento menu materias -->
                                <template v-if="menu==5">
                                    <ciclo></ciclo>
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
                                    <carrera></carrera>      
                                </template>
                                <template v-if="menu==13">
                                    <grado></grado>      
                                </template>
                    
                            <!---Maenu personas -->
                                <template v-if="menu==14">
                                    <persona></persona>      
                                </template>
                                <template v-if="menu==15">
                                    <alumno></alumno> 
                                </template>
                                <template v-if="menu==16">
                                    <campass></campass>       
                                </template>
                    
                            <!---Maenu materias -->
                                <template v-if="menu==17">
                                    <asignardocente></asignardocente>     
                                </template>
                                <template v-if="menu==18">
                                    <asignargrado></asignargrado>      
                                </template>
                    
                            <!---Maenu pagos -->
                                <template v-if="menu==20">
                                    <h1>Pagos</h1> 
                                </template>
                                <template v-if="menu==21">
                                    <h1>Pagos</h1>     
                                </template>
                                <template v-if="menu==22">
                                    <h1>Morosos</h1> 
                                </template>
                @elseif(Auth::user()->idRol == 5)
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
                            
                                <!--Mantenimiento menu materias -->
                                    <template v-if="menu==5">
                                        <ciclo></ciclo>
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
                                        <carrera></carrera>      
                                    </template>
                                    <template v-if="menu==13">
                                        <grado></grado>      
                                    </template>
                        
                                <!---Maenu personas -->
                                    <template v-if="menu==14">
                                        <persona></persona>      
                                    </template>
                                    <template v-if="menu==15">
                                        <alumno></alumno> 
                                    </template>
                                    <template v-if="menu==16">
                                        <campass></campass>       
                                    </template>
                        
                                <!---Maenu materias -->
                                    <template v-if="menu==17">
                                        <asignardocente></asignardocente>     
                                    </template>
                                    <template v-if="menu==18">
                                        <asignargrado></asignargrado>      
                                    </template>
                        
                                <!---Maenu pagos -->
                                    <template v-if="menu==20">
                                        <h1>Pagos</h1> 
                                    </template>
                                    <template v-if="menu==21">
                                        <h1>Pagos</h1>     
                                    </template>
                                    <template v-if="menu==22">
                                        <h1>Morosos</h1> 
                                    </template>
                @else
            @endif
        @endif
    
@endsection