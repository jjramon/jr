<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Carrera
                        <button type="button" @click="abrirModal('carrera','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">
                                        <option value="nombre">Carrera</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarDia(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarDia(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped  table-responsive-md">
                            <thead>
                               <tr class="table-primary ">
                                    <th class="text-center">Opciones</th>
                                    <th class="text-center">Carrera</th>
                                    <th class="text-center">Estado</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="carrera in arrayCarrera" :key="carrera.id" class=" table-sm text-center"> 
                                    
                                    <td>
                                        <button type="button" @click= "abrirModal('carrera','actualizar',carrera)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="carrera.estado">
                                            <button type="button" class="btn btn-warning btn-sm" @click="desactivar(carrera.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activar(carrera.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td  v-text="carrera.nombre"></td>
                                    <td >
                                        <div v-if="carrera.estado" >
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese nueva carrera">
                                    </div>
                                </div>
                                <div v-show="errorDia" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsDia" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrar()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizar()">Actualizar</button>
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
                carrera_id: 0,
                nombre : '',
                arrayCarrera : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorDia : 0,
                errorMostrarMsDia : [],
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
            listar(page, buscar, criterio){
                let me = this;
                var url = '/carrera?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayCarrera = respuesta.carrera.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listar(page, buscar, criterio);
            },
            registrar(){
                if(this.validar()){
                    return;
                }

                let me = this;
                axios.post('/carrera/registrar',{
                    'nombre':this.nombre,
                }).then(function(response){
                    me.cerrarModal();
                    me.listar(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizar(){
                if(this.validar()){
                    return;
                }
                let me = this;
                axios.put('/carrera/actualizar',{
                    'id':this.dia_id,
                    'nombre':this.nombre                  
                }).then(function(response){
                    me.cerrarModal();
                    me.listar(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivar(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-dark',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la carrera?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/carrera/desactivar',{
                            'id': id
                        }).then(function(response){
                            me.listar('','','nombre');
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
            activar(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-dark',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el día?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/carrera/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listar('','','nombre');
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
            validar(){
                this.errorCarrera = 0;
                this.errorMostrarMsCarrera=[];
                if(!this.nombre) this.errorMostrarMsCarrera.push("El día no puede estar vacio.");
                if(this.errorMostrarMsCarrera.length)this.errorCarrera = 1;
                return this.errorCarrera;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "carrera":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar carrera';
                                this.nombre="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar carrera";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.dia_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listar('', this.buscar, this.criterio);
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
