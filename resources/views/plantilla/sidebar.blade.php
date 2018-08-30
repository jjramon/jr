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
                        <li @click="menu = 1" class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-plus"></i>Generos</a>
                        </li>
                        <li @click="menu = 2" class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-plus"></i> Roles</a>
                        </li>
                        <li @click="menu = 3"class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-plus"></i>Ciclos</a>
                        </li>
                        <li @click="menu = 4"class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-plus"></i>Días</a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-wallet"></i> Ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-notebook"></i> Proveedores</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>