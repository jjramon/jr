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
                                <div class="input-group" >
                                    
                                        <label class="col-md-2 form-control-label" for="text-input">Tipo:</label>
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
                                    
                                        <th class="text-center" width="100 px">Opciones</th>
                                        <th class="text-center" width="350 px">Nombre</th>
                                        <th class="text-center">Codigo Unico</th>
                                        <th class="texte-center">Nivel</th>
                                        <th class="text-center">Grado</th>
                                        <th class="texte-center">Visualizar</th>
                                        <th class="text-center">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.idAlumno" class="text-center table-sm"> 
                                    <td class="align-midle ">
                                       
                                        <button type="button" @click= "abrirModal('persona','actualizar',persona)" class="btn btn-info btn-sm " >
                                            <i class="icon-pencil"></i>
                                        </button>
                                            
                                        <template v-if="persona.estado">
                                            <button type="button" class="btn btn-warning btn-sm align-center" @click="desactivar(persona.idPersona, persona.idAlumno)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm align-center" @click="activar(persona.idPersona, persona.idAlumno)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td  v-text="persona.nombre + ' ' + persona.apellido" class="align-middle"></td>
                                    <td  v-text="persona.identificacion" class="align-middle"></td>
                                    <td  v-text="persona.nombreNivel" class="align-middle"></td>
                                    <td  v-text="persona.nombreGrado + ' ' + persona.nombreSeccion" class="align-middle"></td>
                                    <td>
                                        
                                        <template>
                                            <button type="button" @click= "abrirModal('persona','visualizar',persona)" class="btn btn-primary btn-sm " >
                                                   
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td >
                                        
                                        <div v-if="persona.estado">
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
                                        <label class="col-md-3 form-control-label" for="text-input">Nivel</label>
                                        <div class="col-md-6 input-group">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="idNivel">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                            </select>
                                            <button class="btn btn-success"  v-if="tipoAccion == 1 || tipoAccion == 2" @click="selectGrado(idNivel)"><i class="fa fa-search"></i></button>
                                            <select class="form-control bg-white" v-if="tipoAccion == 3"   v-model="idNivel" disabled>
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Grado</label>
                                        <div class="col-md-6">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="idGrado" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="grado in arrayGrado" :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion +' '+grado.nombreCarrera"></option>
                                            </select>
                                            <select class="form-control bg-white" v-if="tipoAccion == 3"   v-model="idNivel" disabled>
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
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
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="nombre" class="form-control" placeholder="Ingrese nombre" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="nombre" class="form-control bg-white" disabled>
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
                                        <label class="col-md-3 form-control-label" for="text-input">Codigo Unico:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="identificacion" class="form-control" placeholder="Ingrese DPI" required>
                                            <input type="text" v-if="tipoAccion == 3" v-model="identificacion" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                   <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento:</label>
                                        <div class="col-md-9">
                                            <input type="date" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="fechaNac" class="form-control" placeholder="Ingrese DPI" required>
                                            <input type="date" v-if="tipoAccion == 3" v-model="fechaNac" class="form-control bg-white" disabled>
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
                                    
                                    
                                    <div v-show="errorPersona" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsPersona" :key="error" v-text="error"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            
                               
                            
                            <div class="modal-footer">
                                
                                                                
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
                idAlumno: 0,
                idPersona:0,
                idGenero: 0,
                idTipoPersona: 0,
                idGrado:0,
                idNivel:0,
                idNvl:0,
                idSeccion:0,
                nombre: '',
                apellido:'',
                identificacion:'',
                fechaNac:'',
                nombreTPersona:'',
                nombreGenero:'',
                arrayPersona : [],
                arrayGrado:[],
                nombreGrado:'',
                nombreNivel:'',
                nombreSeccion:'',
                nombreCarrera:'',
                arrayNivel:[],
                arrayTipo_persona : [],
                arrayGenero : [],
                arrayGrado:[],
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
                tipoBusqueda:'',
                
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
                this.selectNivel();

                let me = this;           
                var url = '/alumno?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.alumno.data;
                    me.pagination = respuesta.pagination;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectTypoPersona(){
                let me = this;
                var url = '/alumno/selectTipoPersona'
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
                var url = '/alumno/selectGenero';
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayGenero = respuesta.genero;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
           selectNivel(){
                let me = this;
                var url = '/grado/selectNivel'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayNivel = respuesta.nivel;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectGrado(filtro){
                let me = this;
                var url = '/alumno/selectGrado?filtro='+filtro;
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayGrado = respuesta.grado;
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
                axios.post('/alumno/registrar',{
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'identificacion':this.identificacion,
                    'fechaNac':this.fechaNac,
                    'idTipoPersona':this.idTipoPersona,
                    'idGenero':this.idGenero,
                    'idGrado' :this.idGrado
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
                axios.put('/alumno/actualizar',{
                    'idPersona':this.idPersona,

                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'identificacion':this.identificacion,

                    'idTipoPersona':this.idTipoPersona,
                    'idGenero':this.idGenero,
     
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
                        axios.put('/alumno/desactivarUsuario',{
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
                if(this.idtipoPersona=='') this.errorMostrarMsPersona.push("Seleccione un tipo de persona");
                if(this.idGenero=='') this.errorMostrarMsPersona.push("Seleccione un genero");
                if(!this.nombre) this.errorMostrarMsPersona.push("El nombre no puede estar vacio.");
                if(!this.apellido) this.errorMostrarMsPersona.push("El apellido no puede estar vacio.");
                
                if(this.errorMostrarMsPersona.length)this.errorPersona = 1;
                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre;
                this.apellido;
                this.identificacion;
                this.idPersona;
                this.idAlumno;
                this.idNivel;
                this.idSeccion;
                this.idGrado;   
                this.idCarrera;
                this.estado;
                this.fechaNac;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar alumno';
                                this.nombre = "";
                                this.apellido = "";
                                this.identificacion = "";
                                this.fechaNac = "";
                                this.idGenero = "";
                                this.idTipoPersona = "";
                                this.idGrado="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar alumno";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.apellido = data['apellido'];
                                this.identificacion = data['identificacion'];
                                this.idGrado = data['idGrado'];
                                this.idSeccion = data['idSeccion'];
                                this.idCarrera = data['idCarrera'];
                                this.idNivel = data['idNivel'];
                                this.idTipoPersona = data['idTipoPersona'];
                                this.idGenero = data['idGenero'];
                                this.idPersona = data['idPersona'];
                                this.idAlumno = data['idAlumno'];
                                this.fechaNac = data['fechaNac'];
                                
                                break;
                            }
                            case 'visualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Visualizar datos";
                                this.tipoAccion = 3;
                                this.nombre = data['nombre'];
                                this.apellido = data['apellido'];
                                this.identificacion = data['identificacion'];
                                this.idGrado = data['idGrado'];
                                this.idSeccion = data['idSeccion'];
                                this.idCarrera = data['idCarrera'];
                                this.idNivel = data['idNivel'];
                                this.idTipoPersona = data['idTipoPersona'];
                                this.idGenero = data['idGenero'];
                                this.idPersona = data['idPersona'];
                                this.idAlumno = data['idAlumno'];
                                this.fechaNac = data['fechaNac'];

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