<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Tipo de persona
                        <button type="button" @click="abrirModal('tipo_persona','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">
                                        <option value="nombre">Tipo de Persona:</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listartipo_persona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarTipo_persona(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped  table-responsive-md">
                            <thead>
                               <tr class="table-primary ">
                                    <th class="text-center">Opciones</th>
                                    <th class="text-center">Tipo de persona</th>
                                    <th class="text-center">Estado</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="tipo_persona in arrayTipo_persona" :key="tipo_persona.id" class=" table-sm text-center"> 
                                    
                                    <td>
                                        <button type="button" @click= "abrirModal('tipo_persona','actualizar',tipo_persona)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="tipo_persona.estado">
                                            <button type="button" class="btn btn-warning btn-sm" @click="desactivarTipo_persona(tipo_persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarTipo_persona(tipo_persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td  v-text="tipo_persona.nombre"></td>
                                    <td >
                                        <div v-if="tipo_persona.estado" >
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
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese nuevo tipo de persona">
                                    </div>
                                </div>
                                <div v-show="errorTipo_persona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsTipo_persona" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTipo_persona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTipo_persona()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </main>
</template>

<script>
    export default {
        data (){
            return{
                tipo_persona_id: 0,
                nombre : '',
                arrayTipo_persona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTipo_persona : 0,
                errorMostrarMsTipo_persona : [],
                 pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,   
                },
                offset : 3,
                criterio : 'nombre',
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
            listarTipo_persona(page, buscar, criterio){
                let me = this;
                var url = '/tipo_persona?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipo_persona = respuesta.tipo_personas.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarTipo_persona(page, buscar, criterio);
            },
            registrarTipo_persona(){
                if(this.validarTipo_persona()){
                    return;
                }

                let me = this;
                axios.post('/tipo_persona/registrar',{
                    'nombre':this.nombre,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarTipo_persona(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarTipo_persona(){
                if(this.validarTipo_persona()){
                    return;
                }
                let me = this;
                axios.put('/tipo_persona/actualizar',{
                    'id':this.tipo_persona_id,
                    'nombre':this.nombre                  
                }).then(function(response){
                    me.cerrarModal();
                    me.listarTipo_persona(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivarTipo_persona(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-dark',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar el tipo de persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/tipo_persona/desactivar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarTipo_persona(1,'','nombre');
                            swalWithBootstrapButtons(
                                'Desativado!',
                                'el registro se desactivado.'
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
            activarTipo_persona(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el tipo de persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/tipo_persona/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarTipo_persona(1,'','nombre');
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
            validarTipo_persona(){
                this.errorTipo_persona = 0;
                this.errorMostrarMsTipo_persona=[];
                if(!this.nombre) this.errorMostrarMsTipo_persona.push("El tipo de persona no puede estar vacio.");
                if(this.errorMostrarMsTipo_persona.length)this.errorTipo_persona = 1;
                return this.errorTipo_persona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "tipo_persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar tipo de persona';
                                this.nombre="";
                                this.descripcion="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar tipo de persona";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.tipo_persona_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarTipo_persona(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
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
