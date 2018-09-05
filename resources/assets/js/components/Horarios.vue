<template>
           <main class="main">
            <!-- Breadcrumb -->

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Horarios
                        <button type="button" @click="abrirModal('horario','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label class="col-md-1 form-control-label" for="text-input">Día:</label>
                                    <select class="form-control col-md-8" v-model="buscar">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="dia in arrayDia" :key="dia.id" :value="dia.id" v-text="dia.nombre"></option>
                                    </select>
                                    
                                    <button type="submit" @click="listarHorario(1,buscar,criterio)"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-responsive-md">
                            <thead>
                               <tr class="table-primary">
                                    
                                        <th class="text-center">Opciones</th>
                                        <th class="text-center">Horario Inicial</th>
                                        <th class="text-center">Horario Salida</th>
                                        <th class="text-center">Dia</th>
                                        <th class="text-center">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="horario in arrayHorario" :key="horario.id" class="text-center table-sm"> 
                                    <td >
                                        <button type="button" @click= "abrirModal('horario','actualizar',horario)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="horario.estado">
                                            <button type="button" class="btn btn-warning btn-sm" @click="desactivarHorario(horario.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarHorario(horario.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                        
                                    </td>
                                    <td  v-text="horario.horario"></td>
                                    <td  v-text="horario.horario_salida"></td>
                                    <td  v-text="horario.nombre_dia"></td>
                                    <td >
                                        <div v-if="horario.estado" >
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
                                    <label class="col-md-6 form-control-label" for="text-input">Horario de entrada:</label>
                                    <div class="col-md-6">
                                        <input type="time" v-model="horario" class="form-control" placeholder="Ingrese horario de entrada" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-6 form-control-label" for="text-input">Horario de salida:</label>
                                    <div class="col-md-6">
                                        <input type="time" v-model="horario_salida" class="form-control" placeholder="Ingrese horario de salida" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Día:</label>
                                    <div class="col-md-6">
                                        <select class="form-control" v-model="idDia">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="dia in arrayDia" :key="dia.id" :value="dia.id" v-text="dia.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div v-show="errorHorario" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsHorario" :key="error" v-text="error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarHorario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarHorario()">Actualizar</button>
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
                horario_id: 0,
                idDia: 0,
                horario: '',
                horario_salida:'',
                nombre_dia:'',
                arrayHorario : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorHorario : 0,
                errorMostrarMsHorario : [],
                 pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,   
                },
                offset : 3,
                criterio :'horario',
                buscar : '',
                arrayDia : [],
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
            listarHorario(page, buscar, criterio){
                this.selectDia();
                let me = this;
                var url = '/horario?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayHorario = respuesta.horarios.data;
                    me.pagination = respuesta.pagination;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectDia(){
                let me = this;
                var url = '/horario/selectDia'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayDia = respuesta.dias;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarHorario(page, buscar, criterio);
            },
            registrarHorario(){
                if(this.validarHorario()){
                    return;
                }

                let me = this;
                axios.post('/horario/registrar',{
                    'horario':this.horario,
                    'horario_salida':this.horario_salida,
                    'idDia':this.idDia,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarHorario(1,'','horario');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarHorario(){
                if(this.validarHorario()){
                    return;
                }
                let me = this;
                axios.put('/horario/actualizar',{
                    'id':this.horario_id,
                    'horario':this.horario,
                    'horario_salida':this.horario_salida,
                    'idDia':this.idDia,              
                }).then(function(response){
                    me.cerrarModal();
                    me.listarHorario(1,'','horario');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivarHorario(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar el horario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/horario/desactivar',{
                            'id': id
                        }).then(function(response){
                            me.listarHorario(1,'','horario');
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
            activarHorario(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el horario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/horario/activar',{
                            'id': id
                        }).then(function(response){
                            
                            me.listarHorario(1,'','horario');
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
            validarHorario(){
                this.errorHorario = 0;
                this.errorMostrarMsHorario=[];
                if(this.idDia==0) this.errorMostrarMsHorario.push("Seleccione un dia");
                if(!this.horario) this.errorMostrarMsHorario.push("El horario de entrada no puede estar vacio.");
                if(!this.horario_salida) this.errorMostrarMsHorario.push("El horario de salida no puede estar vacio.");
                if(this.errorMostrarMsHorario.length)this.errorHorario = 1;
                return this.errorHorario;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.horario='';
                this.horario_salida='';
                this.idDia='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "horario":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                
                                this.modal=1;
                                this.tituloModal='Registrar horario';
                                this.horario="";
                                this.horario_salida="";
                                this.nombre_dia="";
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar horario";
                                this.tipoAccion = 2;
                                this.horario = data['horario'];
                                this.idDia = data['idDia']
                                this.horario_salida = data['horario_salida'];
                                this.horario_id = data['id'];
                                break;
                            }
                        }
                    }
                }
                
            }
        },
        mounted() {
            this.listarHorario(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 50% !important;
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
