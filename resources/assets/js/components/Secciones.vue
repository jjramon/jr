<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Sección
                        <button type="button" @click="abrirModal('dia','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select class="form-control col-md-4" v-model="criterio">
                                        <option value="nombre">Sección:</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarDia(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarDia(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped ">
                            <thead>
                               <tr class="text-center ">
                                    <div class="row table-primary">
                                        <th class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Opciones</th>
                                        <th class ="col-lg-4 col-md-4 col-sm-4 col-xs-12">Sección</th>
                                        <th class ="col-lg-4 col-md-4 col-sm-4 col-xs-12">Estado</th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="dia in arrayDia" :key="dia.id" class="row text-center table-sm"> 
                                    <td class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <button type="button" @click= "abrirModal('dia','actualizar',dia)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="dia.estado">
                                            <button type="button" class="btn btn-warning btn-sm" @click="desactivarDia(dia.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarDia(dia.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                        
                                    </td>
                                    <td class ="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-text="dia.nombre"></td>
                                    <td class = "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div v-if="dia.estado" >
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
                                    <label class="col-md-3 form-control-label" for="text-input">Sección:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese nueva sección">
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
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarDia()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDia()">Actualizar</button>
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
                dia_id: 0,
                nombre : '',
                arrayDia : [],
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
            listarDia(page, buscar, criterio){
                let me = this;
                var url = '/seccion?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayDia = respuesta.dias.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarDia(page, buscar, criterio);
            },
            registrarDia(){
                if(this.validarDia()){
                    return;
                }

                let me = this;
                axios.post('/seccion/registrar',{
                    'nombre':this.nombre,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDia(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarDia(){
                if(this.validarDia()){
                    return;
                }
                let me = this;
                axios.put('/seccion/actualizar',{
                    'id':this.dia_id,
                    'nombre':this.nombre                  
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDia(1,'','nombre');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivarDia(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la sección?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/seccion/desactivar',{
                            'id': id
                        }).then(function(response){
                            me.listarDia(1,'','nombre');
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
            activarDia(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar la sección?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/seccion/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarDia(1,'','nombre');
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
            validarDia(){
                this.errorDia = 0;
                this.errorMostrarMsDia=[];
                if(!this.nombre) this.errorMostrarMsDia.push("La sección no puede estar vacio.");
                if(this.errorMostrarMsDia.length)this.errorDia = 1;
                return this.errorDia;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "dia":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar sección';
                                this.nombre="";
                                this.descripcion="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar sección";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.dia_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarDia(1, this.buscar, this.criterio);
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
