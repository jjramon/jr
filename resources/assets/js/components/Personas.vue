<style>

   .modal-content{
        width: 100%;
        height: 550px;
        overflow-y: scroll;
        overflow-x: unset;
        position: absolute; 
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position:absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color:red !important;
        font-weight:bold;
    }

</style>
<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Personas
                        <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label class="col-md-1 form-control-label" for="text-input">Tipo:</label>
                                    <select class="form-control col-md-2" v-model="criterio">
                                            <option value="" >Seleccione</option>
                                            <option v-for="tipo_persona in arrayTipo_persona" :key="tipo_persona.id" :value="tipo_persona.id" v-text="tipo_persona.nombre"></option>
                                    </select>
                                
                                    <label class="col-md-2 form-control-label" for="text-input">Buscar:</label>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">              
                                    
                                    <button type="submit" @click="listarPersona(1, buscar, criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-responsive-lg">
                            <thead>
                               <tr class="table-primary">
                                    
                                        <th class="text-center ">Opciones</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Apellido</th>
                                        <th class="text-center" >DPI</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Visualizar</th>
                                        <th class="text-center">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.idPersona" class="text-center table-sm"> 
                                    <td class="text-center ">
                                        <div class="row">
                                            <div class="col-12 align-center">
                                                <button type="button" @click= "abrirModal('persona','actualizar',persona)" class="btn btn-info btn-sm " >
                                                    <i class="icon-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="col-12 align-center">
                                                <template v-if="persona.estadoPersona">
                                                    <button type="button" class="btn btn-warning btn-sm align-center row" @click="desactivar(persona.idPersona, persona.idUsuario)">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>
                                                    <button type="button" class="btn btn-success btn-sm align-center row" @click="activar(persona.idPersona, persona.idUsuario)">
                                                        <i class="icon-check"></i>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>
                                    
                                    </td>
                                    <td  v-text="persona.nombrePersona" class="align-middle"></td>
                                    <td  v-text="persona.apellido" class="align-middle"></td>
                                    <td  v-text="persona.identificacion" class=" align-middle"></td>
                                    <td  v-text="persona.direccion"></td>
                                    <td  v-text="persona.tel" class="align-middle"></td>
                                    <td  v-text="persona.correo" class="align-middle"></td>
                                    <td  v-text="persona.usuario" class="align-middle"></td>
                                    <td  v-text="persona.nombreRol" class="align-middle"></td>
                                    <td>
                                        
                                        <template>
                                            <button type="button" @click= "abrirModal('persona','visualizar',persona)" class="btn btn-primary btn-sm " >
                                                   
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td >
                                        
                                        <div v-if="persona.estadoPersona && persona.usuarioEstado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else >
                                            <span class="badge badge-dark">Inactivo</span>
                                        </div>
                                    </td>
                                    

                                </tr>   
                            </tbody>
                        </table>
                        
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)" >Ant</a>
                                </li>
                                <li class="page-item " v-for="page in pagesNumber" :key ="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>

                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            
                <!--Inicio del modal agregar/actualizar-->
                <div class="modal fullscreen-modal fade "  tabindex="-1" :class="{'mostrar':modal}"  role="dialog" aria-labelledby="myModalLabel" style="display: none;" >
                    <div class="modal-dialog modal-primary modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" v-text="tituloModal"></h4>
                                <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Tipo de persona</label>
                                        <div class="col-md-6">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="idTipoPersona">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="tipo_persona in arrayTipo_persona" :key="tipo_persona.id" :value="tipo_persona.id" v-text="tipo_persona.nombre"></option>
                                            </select>
                                            <select class="form-control bg-white" v-if ="tipoAccion==3" v-model="idTipoPersona" disabled>
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="tipo_persona in arrayTipo_persona" :key="tipo_persona.id" :value="tipo_persona.id" v-text="tipo_persona.nombre"></option>
                                            </select>
                                        </div>
                                        
                                    </div>
  
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="nombrePersona" class="form-control" placeholder="Ingrese nombre" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="nombrePersona" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Apellido:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="apellido" class="form-control" placeholder="Ingrese apellido" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="apellido" class="form-control bg-white" disabled>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">DPI:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="identificacion" class="form-control" placeholder="Ingrese DPI" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="identificacion" class="form-control bg-white" disabled>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Dirección:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="direccion" class="form-control" placeholder="Ingrese dirección" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="direccion" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Genero:</label>
                                        <div class="col-md-6">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="idGenero">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="genero in arrayGenero" :key="genero.id" :value="genero.id" v-text="genero.genero"></option>
                                            </select>
                                            <select class="form-control bg-white" v-if="tipoAccion == 3" v-model="idGenero" disabled>
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="genero in arrayGenero" :key="genero.id" :value="genero.id" v-text="genero.genero"></option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Telefono:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="tel" class="form-control" placeholder="Ingrese primer telefono" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="tel" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row" >
                                        <label class="col-md-3  form-control-label" for="text-input">Telefono 2:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="tel2" class="form-control" placeholder="Ingrese segundo telefono">
                                            <input type="text" v-if="tipoAccion == 3" v-model="tel2" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Correo electronico:</label>
                                        <div class="col-md-9">
                                            <input type="email" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="correo" class="form-control" placeholder="Ingrese el correo electronico">
                                            <input type="email" v-if="tipoAccion == 3" v-model="correo" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Tipo de Rol:</label>
                                        <div class="col-md-6">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="idRol">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="rols in arrayRol" :key="rols.id" :value="rols.id" v-text="rols.nombre"></option>
                                            </select>
                                            <select class="form-control bg-white" v-if="tipoAccion == 3" v-model="idRol" disabled>
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="rols in arrayRol" :key="rols.id" :value="rols.id" v-text="rols.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Usuario:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" maxlength="20" v-model="usuario" class="form-control" placeholder="Ingrese primer telefono" required>
                                            <input type="text" v-if="tipoAccion == 3" maxlength="20" v-model="usuario" class="form-control bg-white" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row" v-if="tipoAccion == 1 || tipoAccion == 2">
                                        <label class="col-md-3 form-control-label" for="text-input">Contraseña:</label>
                                        <div class="col-md-9">
                                            <input type="password"  pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" maxlength="20" v-model="password" class="form-control" placeholder="Ingrese una contraseña" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row" v-if="tipoAccion == 1 || tipoAccion == 2">
                                        <label class="col-md-3 form-control-label" for="text-input">Contraseña:</label>
                                        <div class="col-md-9">
                                            <input type="password"  pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" maxlength="20" v-model="confirPassword" class="form-control" placeholder="Ingrese una contraseña" required>
                                        </div>
                                    </div>
                                    
                                    <div v-show="errorPersona" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsPersona" :key="error" v-text="error"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            
                               
                            
                            <div class="modal-footer">
                                
                                <label for="text-input" v-if="tipoAccion == 3">Persona:</label>
                                <button v-if="tipoAccion == 3 && estadoPersona == 1" type="button" class="btn btn-warning btn-sm align-center row" @click="desactivarPersona(idPersona)">
                                    <i class="icon-trash"></i>
                                </button>
                                <button v-if="tipoAccion == 3 && estadoPersona == 0" type="button" class="btn btn-success btn-sm align-center row" @click="activarPersona(idPersona)">
                                    <i class="icon-check"></i>
                                </button>
                                
                                <label for="text-input" v-if="tipoAccion == 3">Usuairo:</label>
                                    
                                <button v-if="tipoAccion == 3 && usuarioEstado == 1" type="button" class="btn btn-warning btn-sm align-center row" @click="desactivarUsuario(idUsuario)">
                                    <i class="icon-trash"></i>
                                </button>
                                <button v-if="tipoAccion == 3 && usuarioEstado == 0" type="button" class="btn btn-success btn-sm align-center row" @click="activarUsuario(idUsuario)">
                                        <i class="icon-check"></i>
                                </button>
                                
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->
        </div>
            
    </main>
</template>

<script>
    export default {
        data (){
            return{
                idPersona: 0,
                idGenero: 0,
                idTipoPersona: 0,
                idRol:0,
                nombreRol:'',
                idUsuario:0,
                usuario:'',
                password:'',
                confirPassword:'',
                nombrePersona: '',
                apellido:'',
                direccion:'',
                identificacion:'',
                tel:'',
                tel2:'',
                correo:'',
                nombreTPersona:'',
                nombreGenero:'',
                arrayPersona : [],
                arrayRol:[],
                arrayTipo_persona : [],
                arrayGenero : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsPersona : [],
                 pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,   
                },
                offset : 3,
                criterio :'',
                buscar : '',
                
            }
        },

        computed : {
                isActived: function(){
                    return this.pagination.current_page;
                },
                pagesNumber: function(){
                if(!this.pagination.to){
                    return [];                
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset *2);
                if(to >= this.pagination.last_page){
                    to= this.pagination.last_page;
                }
                var pagesArray = [];
                while(from<= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },       
        },
        methods : {
            listarPersona(page, buscar, criterio){
                this.selectTypoPersona();
                this.selectGenero();
                this.selectRol();
                let me = this;           
                var url = '/persona?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.persona.data;
                    me.pagination = respuesta.pagination;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectTypoPersona(){
                let me = this;
                var url = '/persona/selectTipoPersona'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayTipo_persona = respuesta.tipo_persona;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectGenero(){
                let me = this;
                var url = '/persona/selectGenero'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayGenero = respuesta.genero;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectRol(){
                let me = this;
                var url = '/persona/selectRol'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayRol = respuesta.rols;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarPersona(page, buscar, criterio);
            },
            registrarPersona(){
                if(this.validarPersona()){
                    return;
                }
                
                let me = this;
                axios.post('/persona/registrar',{
                    'nombrePersona':this.nombrePersona,
                    'apellido':this.apellido,
                    'identificacion':this.identificacion,
                    'direccion':this.direccion,
                    'tel':this.tel,
                    'tel2':this.tel2,
                    'correo':this.correo,
                    'idTipoPersona':this.idTipoPersona,
                    'idGenero':this.idGenero,
                    'idRol':this.idRol,
                    'usuario':this.usuario,
                    'password':this.password,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPersona(1,'','');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarPersona(){
                if(this.validarPersona()){
                    return;
                }                 
                
                let me = this;
                axios.put('/persona/actualizar',{
                    'idPersona':this.idPersona,
                    'idUsuario':this.idUsuario,
                    'idRol':this.idRol,
                    'nombrePersona':this.nombrePersona,
                    'apellido':this.apellido,
                    'identificacion':this.identificacion,
                    'direccion':this.direccion,
                    'tel':this.tel,
                    'tel2':this.tel2,
                    'correo':this.correo,
                    'nombreTPersona':this.Persona,
                    'idGenero':this.idGenero,
                    'idRol':this.idRol,
                    'usuario':this.usuario,
                    'password':this.password,        
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPersona(1,'','');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivar(id, idd){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/persona/desactivar',{
                            'idPersona': id,
                            'idUsuario': idd
                        }).then(function(response){
                            me.listarPersona(1,'','');
                            swalWithBootstrapButtons(
                                'Descativado!',
                                'el registro se a desactivado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            activar(id , idd){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/persona/activar',{
                            'idPersona': id,
                            'idUsuario': idd
                        }).then(function(response){
                            
                            me.listarPersona(1,'','');
                            swalWithBootstrapButtons(
                                'Ativado!',
                                'el registro se activado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            desactivarPersona(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        
                        let me = this;
                        axios.put('/persona/desactivarPersona',{
                            'idPersona': id
                        }).then(function(response){
                            me.cerrarModal();
                            me.listarPersona(1,'','');
                            swalWithBootstrapButtons(
                                'Descativado!',
                                'el registro se a desactivado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            activarPersona(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        
                        let me = this;
                        axios.put('/persona/activarPersona',{
                            'idPersona': id
                        }).then(function(response){
                            
                            me.listarPersona(1,'','');
                            me.cerrarModal();
                            swalWithBootstrapButtons(
                                'Ativado!',
                                'el registro se activado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            desactivarUsuario(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar el usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        
                        let me = this;
                        axios.put('/persona/desactivarUsuario',{
                            'idUsuario': id
                        }).then(function(response){
                            me.listarPersona(1,'','');
                            me.cerrarModal();
                            swalWithBootstrapButtons(
                                'Descativado!',
                                'el registro se a desactivado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            activarUsuario(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el usuairo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    
                    if (result.value) {
                        let me = this;
                        axios.put('/persona/activarUsuario',{
                            'idUsuario': id
                        }).then(function(response){
                            me.cerrarModal();
                            me.listarPersona(1,'','');
                            swalWithBootstrapButtons(
                                'Ativado!',
                                'el registro se activado.'
                            )                     
                                  
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalWithBootstrapButtons(
                                'Cancelar',
                                'el registro no sufrira ningun cambio :)',
                                'error'
                            )
                        }
                })
            },
            validarPersona(){
                this.errorPersona = 0;
                this.errorMostrarMsPersona=[];
                if(this.password != this.confirPassword)this.errorMostrarMsPersona.push("las contraseñas no coinciden");
                if(this.idtipoPersona=='') this.errorMostrarMsPersona.push("Seleccione un tipo de persona");
                if(this.idGenero=='') this.errorMostrarMsPersona.push("Seleccione un genero");
                if(!this.nombrePersona) this.errorMostrarMsPersona.push("El nombre no puede estar vacio.");
                if(!this.apellido) this.errorMostrarMsPersona.push("El apellido no puede estar vacio.");
                if(!this.direccion) this.errorMostrarMsPersona.push("El dirección no puede estar vacio.");
                if(!this.tel) this.errorMostrarMsPersona.push("El tel no puede estar vacio.");
                if(!this.correo) this.errorMostrarMsPersona.push("El correo no puede estar vacio.");
                if(this.errorMostrarMsPersona.length)this.errorPersona = 1;
                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombrePersona;
                this.apellido;
                this.identificacion;
                this.direccion;
                this.tel;
                this.tel2;
                this.correo;
                this.idTipoPersona;   
                this.idGenero;
                this.usuario;
                this.password;
                this.idRol;
                this.idUsuairo;
                this.idPersona;
                this.usuarioEstado;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar horario';
                                this.nombrePersona = "";
                                this.apellido = "";
                                this.identificacion = "";
                                this.direccion = "";
                                this.tel = "";
                                this.tel2 = "";
                                this.correo = "";
                                this.idTipoPersona = "";   
                                this.idGnero = "";
                                this.usuario = "";
                                this.password = "";
                                this.idRol = "";
                                this.idUsuairo = "";
                                this.idPersona = "";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar horario";
                                this.tipoAccion = 2;
                                this.nombrePersona = data['nombrePersona'];
                                this.apellido = data['apellido'];
                                this.identificacion = data['identificacion'];
                                this.direccion = data['direccion'];
                                this.tel = data['tel'];
                                this.tel2 = data['tel2'];
                                this.correo = data['correo'];
                                this.idTipoPersona = data['idTipoPersona'];
                                this.idGenero = data['idGenero'];
                                this.idPersona = data['idPersona'];
                                this.idRol = data['idRol'];
                                this.idUsuario = data['idUsuario'];
                                this.usuario = data['usuario'];
                                this.password = data['password'];  

                                break;
                            }
                            case 'visualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Visualizar datos";
                                this.tipoAccion = 3;
                                this.nombrePersona = data['nombrePersona'];
                                this.apellido = data['apellido'];
                                this.identificacion = data['identificacion'];
                                this.direccion = data['direccion'];
                                this.tel = data['tel'];
                                this.tel2 = data['tel2'];
                                this.correo = data['correo'];
                                this.idTipoPersona = data['idTipoPersona'];
                                this.idGenero = data['idGenero'];
                                this.idPersona = data['idPersona'];
                                this.idRol = data['idRol'];
                                this.idUsuario = data['idUsuario'];
                                this.usuario = data['usuario'];
                                this.password = data['password'];  
                                this.usuarioEstado = data['usuarioEstado'];  
                                this.estadoPersona = data['estadoPersona']; 

                                break;
                            }                                                          
                        }
                    }
                }
                
            }
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
        }
    }
</script>
