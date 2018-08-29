<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Roll
                        <button type="button" @click="abrirModal('rol','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">


                        <table class="table table-bordered table-striped ">
                            <thead>
                               <tr class="text-center ">
                                    <div class="row">
                                        <th class="col-lg-2  col-sm-3 col-md-3 col-xs-12">Opciones</th>
                                        <th class ="col-lg-3 col-md-3 col-sm-3 col-xs-12">Nombre</th>
                                        <th class ="col-lg-5 col-md-4 col-sm-4 col-xs-12">Descripción</th>
                                        <th class ="col-lg-2 col-md-2 col-sm-2 col-xs-12">Estado</th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol in arrayRol" :key="rol.id" class="row text-center table-sm"> 
                                    <td class="col-lg-2  col-sm-3 col-md-3 col-xs-12">
                                        <button type="button" @click= "abrirModal('rol','actualizar',rol)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="rol.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarRol(rol.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarRol(rol.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                        
                                    </td>
                                    <td class ="col-lg-3 col-md-3 col-sm-3 col-xs-12" v-text="rol.nombre"></td>
                                    <td class ="col-lg-5 col-md-4 col-sm-4 col-xs-12" v-text="rol.descripcion"></td>
                                    
                                    <td >
                                        <div v-if="rol.estado" class ="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else class ="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <span class="badge badge-dark">Inactivo</span>
                                        </div>
                                    </td>

                                </tr>   
                            </tbody>
                        </table>
                        
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">

                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese nuevo roll">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese nueva descripción">
                                    </div>
                                </div>
                                <div v-show="errorRol" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsRol" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarRol()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarRol()">Actualizar</button>
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
                rol_id: 0,
                nombre : '',
                descripcion : '',
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorRol : 0,
                errorMostrarMsRol : [],
                 pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,   
                },
                offset : 3
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
            listarRol(page){
                let me = this;
                var url = '/rol?page=' + page;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.rols.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            registrarRol(){
                if(this.validarRol()){
                    return;
                }

                let me = this;
                axios.post('/rol/registrar',{
                    'nombre':this.nombre,
                    'descripcion':this.descripcion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarRol();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarRol(){
                if(this.validarRol()){
                    return;
                }
                let me = this;
                axios.put('/rol/actualizar',{
                    'id':this.rol_id,
                    'nombre':this.nombre,
                    'descripcion': this.descripcion
                    
                }).then(function(response){
                    me.cerrarModal();
                    me.listarRol();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            desactivarRol(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar el roll?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/rol/desactivar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarRol();
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
            activarRol(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el roll?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/rol/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarRol();
                            swalWithBootstrapButtons(
                                'Descativado!',
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
            validarRol(){
                this.errorRol = 0;
                this.errorMostrarMsRol=[];
                if(!this.nombre) this.errorMostrarMsRol.push("El roll no puede estar vacio.");
                if(!this.descripcion) this.errorMostrarMsRol.push("La descripción no puede estar vacia.");
                if(this.errorMostrarMsRol.length)this.errorRol = 1;
                return this.errorRol;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "rol":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar roll';
                                this.nombre="";
                                this.descripcion="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar roll";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.rol_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarRol();
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
