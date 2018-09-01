<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">

                <li class="nav-title">
                    Menú principal
                </li>
                <li @click="menu = 0" class="nav-item nav-dropdown">
                        <a class="nav-link " href="#"><i class="icon-home"></i> Inicio</a>
                        
                    </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wrench"></i> Mantenimiento</a>
                    <ul class="nav-dropdown-items">
                        
                            <!--menu usuarios-->
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i> usuarios</a>
                            <ul class="nav-dropdown-items">
                                    <li @click="menu = 1" class="nav-item">
                                            <a class="nav-link" href="#"><i class="icon-plus"></i> Roll</a>
                                    </li>
                                    <li @click="menu = 2" class="nav-item">
                                            <a class="nav-link" href="#"><i class="icon-plus"></i> vistas</a>
                                    </li>
                                    <li @click="menu = 3" class="nav-item">
                                            <a class="nav-link" href="#"><i class="icon-plus"></i> Asignar vistas</a>
                                    </li>

                            </ul>
                        </li>
                        <!--menu personas -->
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-circle"></i> personas</a>
                            <ul class="nav-dropdown-items">
                                <li @click="menu = 4" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Generos</a>
                                </li>

                                <li @click="menu = 5" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Docente</a>
                                </li>

                                <li @click="menu = 6" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Padre de familia</a>
                                </li>

                                <li @click="menu = 7" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Alumno</a>
                                </li>

                            </ul>
                        </li>
                        <!--menu materias -->
                        <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-book"></i> Materias</a>
                                <ul class="nav-dropdown-items">
                                    <li @click="menu = 8"class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-plus"></i>Ciclos</a>
                                    </li>

                                    <li @click="menu = 9"class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-plus"></i>Días</a>
                                    </li>

                                    <li @click="menu = 10"class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-plus"></i>Horario</a>
                                    </li>

                                    <li @click="menu = 11"class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-plus"></i>Bimestre</a>
                                    </li>

                                    <li @click="menu = 12"class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-plus"></i>Materia</a>
                                    </li>

                                </ul>
                            </li>
                        <!--menu grados -->
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-bookmark"></i>Grados</a>
                            <ul class="nav-dropdown-items">
                                <li @click="menu = 13"class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Seccion</a>
                                </li>

                                <li @click="menu = 14"class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Nivel</a>
                                </li> 

                                <li @click="menu = 15"class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-plus"></i>Grado</a>
                                </li>

                        </ul>
                    </ul>
                </li> 
                
                
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>