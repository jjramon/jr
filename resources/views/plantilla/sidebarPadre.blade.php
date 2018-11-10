<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">

                <li class="nav-title">
                    Menú principal
                </li>
                <li @click="menu = 0" class="nav-item nav-dropdown">
                    <a class="nav-link " href="#"><i class="fa fa-institution"></i> Inicio</a>     
                </li>

                <!--menu personas -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i> Personal</a>
                    <ul class="nav-dropdown-items">
                        <li @click="menu = 16" class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i>Cambiar contraseña</a>
                        </li>
                    </ul>
                        
                </li> 

                <!--menu materias-->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-graduation-cap"></i> Materias</a>
                    <ul class="nav-dropdown-items">    
                      
                        <li @click="menu = 23"class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-bullseye"></i> Ver calificación</a>
                        </li>
                    </ul>
                </li>

               
                
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>