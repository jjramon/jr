<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">

                <li class="nav-title">
                    Menú principal
                </li>
                <li @click="menu = 0" class="nav-item nav-dropdown">
                    <a class="nav-link " href="#"><i class="fa fa-institution"></i> Inicio</a>     
                </li>
                <!--Mantenimiento menu usuario -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-wrench"></i> Mantenimiento</a>
                    <ul class="nav-dropdown-items">
                            
                        <!--Mantenimiento menu personas -->
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-circle"></i> Personas</a>
                                <ul class="nav-dropdown-items">
                                    <li @click="menu = 1" class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Generos</a>
                                    </li>
                                    <li @click="menu = 2" class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Tipo de persona</a>
                                    </li>
                                </ul>
                            </li>

                        <!--Mantenimiento menu usuario -->
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-circle"></i> Usuarios</a>
                                <ul class="nav-dropdown-items">
                                    <li @click="menu = 3" class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Roll</a>
                                    </li>
                                </ul>
                            </li>

                        <!--Mantenimiento menu materias -->
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-book"></i> Materias</a>
                                <ul class="nav-dropdown-items">
                                    <li @click="menu = 5"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Ciclos</a>
                                    </li>
                                    <li @click="menu = 6"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Días</a>
                                    </li>
                                    <li @click="menu = 7"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Horario</a>
                                    </li>
                                    <li @click="menu = 8"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Bimestre</a>
                                    </li>
                                    <li @click="menu = 9"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Materia</a>
                                    </li>
                                </ul>
                            </li>

                        <!-- Mantenimiento menu grados -->
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-bookmark"></i>Grados</a>
                                <ul class="nav-dropdown-items">
                                    <li @click="menu = 10"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Seccion</a>
                                    </li>
                                    <li @click="menu = 11"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Nivel</a>
                                    </li> 
                                    <li @click="menu = 23"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Carrera</a>
                                    </li>
                                    <li @click="menu = 12"class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Grado</a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </li>

                <!--menu personas -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i> Registrar personal</a>
                    <ul class="nav-dropdown-items">
                        <li @click="menu = 13" class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Personas</a>
                        </li>
                        <li @click="menu = 14" class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Inscripción</a>
                        </li>
                        <li @click="menu = 15" class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Asignar padres</a>
                        </li>
                    </ul>
                        
                </li> 

                <!--menu materias-->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-graduation-cap"></i> Materias</a>
                    <ul class="nav-dropdown-items">    
                        <li @click="menu = 18"class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Asignar docente</a>
                        </li>
                        <li @click="menu = 19"class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Asignar grado</a>
                        </li>
                        <li @click="menu = 20"class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Ingresar calificación</a>
                            </li>
                    </ul>
                </li>

                <!--menu pagos-->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-money"></i> Solvencias</a>
                    <ul class="nav-dropdown-items">
                        <li @click="menu = 21"class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Solventes</a>
                        </li>
                        <li @click="menu = 22"class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Morosos</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>