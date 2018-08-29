<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container">
                <!-- Ejemplo de tabla Listado -->
                <div class="card container-fluid">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Genero
                        <button type="button" @click="abrirModal('genero','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                        <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                    <table class="table  table-bordered table-striped">
                        <thead>
                            <tr class=" text-center ">
                               <div class="row table-primary">
                                    <th class="col-lg-4  col-sm-4 col-md-4 col-xs-12">Opciones</th>
                                    <th class ="col-lg-4 col-md-4 col-sm-4 col-xs-12">Generos</th>
                                    <th class =" col-lg-4 col-md-4 col-sm-4 col-xs-12">Estado</th>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="genero in arrayGenero" :key="genero.id" class="row text-center"> 
                                <td class="col-lg-4  col-sm-4 col-md-4 col-xs-12">
                                    <button type="button" @click= "abrirModal('genero','actualizar',genero)" class="btn btn-info btn-sm" >
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="genero.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarGenero(genero.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarGenero(genero.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                </td>
                                <td class ="col-lg-4  col-sm-4 col-md-4 col-xs-12" v-text="genero.genero"></td>
                                <td class ="col-lg-4  col-sm-4 col-md-4 col-xs-12" >
                                        <div v-if="genero.estado" >
                                            <span class="badge badge-success ">Activo</span>
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
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)" >Ant</a>
                            </li>
                            <li class="page-item " v-for="page in pagesNumber" :key ="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>

                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page)">Sig</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Genero:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="genero" class="form-control" placeholder="Ingrese nuevo genero">
                                    </div>
                                </div>
                                <div v-show="errorGenero" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsGenero" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarGenero()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarGenero()">Actualizar</button>
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
                genero_id: 0,
                genero : '',
                estado : '',
                arrayGenero : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorGenero : 0,
                errorMostrarMsGenero : [],
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
        computed:{
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
            listarGenero(page){
                let me = this;
                var url='/genero?page=' + page;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayGenero = respuesta.generos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.listarGenero(page);
            },
            registrarGenero(){
                if(this.validarGenero()){
                    return;
                }
                let me = this;
                axios.post('/genero/registrar',{
                    'genero':this.genero,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarGenero();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarGenero(){
                if(this.validarGenero()){
                    return;
                }
                let me = this;
                axios.put('/genero/actualizar',{
                    'id':this.genero_id,
                    'genero':this.genero,
                    
                }).then(function(response){
                    me.cerrarModal();
                    me.listarGenero();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            desactivarGenero(id){
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
                        axios.put('/genero/desactivar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarGenero();
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
            activarGenero(id){
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
                        axios.put('/genero/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarGenero();
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
            validarGenero(){
                this.errorGenero = 0;
                this.errorMostrarMsGenero=[];
                if(!this.genero) this.errorMostrarMsGenero.push("El genero no puede estar vacio.");
                if(this.errorMostrarMsGenero.length)this.errorGenero = 1;
                return this.errorGenero;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.genero="";
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "genero":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Genero';
                                this.genero="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar genero";
                                this.tipoAccion = 2;
                                this.genero = data['genero'];
                                this.genero_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarGenero();
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
