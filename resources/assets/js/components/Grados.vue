<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Grados
                        <button type="button" @click="abrirModal('grado','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group" >
                                    
                                    <label class="col-md-1 form-control-label" for="text-input">Nivel:</label>
                                        <select class="form-control col-md-2" v-model="criterio">
                                        <option value="" >Seleccione</option>
                                        <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                    </select>  
                                    <div  class="col-md-6 form-control" v-if="criterio == 4">
                                    <label class="form-control-label col-md-5" for="text-input">Carrera:</label>
                                        <select class="form-control col-md-6" v-model="buscar">
                                        <option value="" >Seleccione</option>
                                        <option v-for="carrera in arrayCarrera" :key="carrera.id" :value="carrera.id" v-text="carrera.nombre"></option>
                                    </select>
                                    </div>
                                    <button type="submit" @click="listar('', buscar, criterio)" class="btn btn-primary"><i class="fa  fa-get-pocket"></i> Listar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-responsive-md">
                            <thead>
                               <tr class="table-primary">
                                    
                                        <th class="text-center" width="100 px">Opciones</th>
                                        <th class="text-center">Grado</th>
                                        <th class="text-center" width="100 px">Sección</th>                
                                        <th class="text-center">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="grado in arrayGrado" :key="grado.idGrado" class="text-center table-sm"> 
                                    <td class="align-midle ">
                                       
                                        <button type="button" @click= "abrirModal('grado','actualizar',grado)" class="btn btn-info btn-sm " >
                                            <i class="icon-pencil"></i>
                                        </button>
                                            
                                        <template v-if="grado.estadoGrado">
                                            <button type="button" class="btn btn-warning btn-sm align-center" @click="desactivar(grado.idGrado, buscar, criterio)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm align-center" @click="activar(grado.idGrado, buscar, criterio)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td  v-text="grado.nombreGrado" class="align-middle"></td>
                                    <td  v-text="grado.nombreSeccion" class="align-middle"></td>
                                    
                                    
                                    <td >
                                        
                                        <div v-if="grado.estadoGrado">
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
                                        <div class="col-md-6">
                                            <select class="form-control"  v-model="idNivel">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row" v-if="idNivel == 4">
                                        <label class="col-md-3 form-control-label" for="text-input" >Carrera</label>
                                        <div class="col-md-6">
                                            <select class="form-control"  v-model="idCarrera">
                                                <option value="1" >Seleccione una carrera</option>
                                                <option v-for="carrera in arrayCarrera" :key="carrera.id" :value="carrera.id" v-text="carrera.nombre"></option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre:</label>
                                        <div class="col-md-9">
                                            <input type="text"  v-model="nombreGrado" class="form-control" placeholder="Ingrese nombre" required>
                                        </div>
                                    </div>

                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Seccion</label>
                                        <div class="col-md-6">
                                            <select class="form-control"  v-model="idSeccion">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="seccion in arraySeccion" :key="seccion.id" :value="seccion.id" v-text="seccion.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                            </div>
                            
                               
                            
                            <div class="modal-footer">                              
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrar(buscar, criterio)">Guardar</button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizar(buscar, criterio)">Actualizar</button>
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
                idGrado:'',
                nombreGrado:'',
                estadoGrado:'',
                idCarrera:'',
                nombreCarrera:'',
                idNivel:0,
                nombreNivel:'',
                idSeccion:'',
                nombreSeccion:'',
                arrayGrado : [],
                arraySeccion: [],
                arrayNivel: [],
                arrayCarrera: [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorGrado : 0,
                errorMostrarMsGrado : [],
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
            listar(page, buscar, criterio){
                this.selectSeccion();
                this.selectNivel();
                this.selectCarrera();
                if(this.criterio != ''){
                    
                    let me = this;           
                    var url = '/grado?page=' + page +'&buscar='+ buscar +'&criterio='+ criterio;
                    
                    axios.get(url)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayGrado = respuesta.grado.data;
                        me.pagination = respuesta.pagination;
                      
                      if(me.arrayGrado.length <1)
                        {
                            me.sinRegistro();
                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
                else {
                    
                }
            },
            correcto(){
                swal({
                    position: 'top-center',
                    type: 'success',
                    title: 'Proceso finalizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            sinRegistro(){
                swal({
                    position: 'top-center',
                    type: 'success',
                    title: 'no se encuentran registros',
                    showConfirmButton: false,
                    timer: 1500
                })
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
            selectCarrera(){
                let me = this;
                var url = '/grado/selectCarrera'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayCarrera = respuesta.carrera;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectSeccion(){
                let me = this;
                var url = '/grado/selectSeccion'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arraySeccion = respuesta.seccion;
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
            registrar(buscar, criterio){
                if(this.validar()){
                    return;
                }
                if(this.idCarrera == 0)
                {
                    this.idCarrera = '';
                }
                let me = this;
                axios.post('/grado/registrar',{
                    'nombre':this.nombreGrado,
                    'idSeccion':this.idSeccion,
                    'idCarrera':this.idCarrera,
                    'idNivel':this.idNivel,
                }).then(function(response){
                    me.cerrarModal();
                    me.listar('1',buscar, criterio);
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
                axios.put('/grado/actualizar',{
                    'idGrado':this.idGrado,
                    'nombre':this.nombreGrado,
                    'idSeccion':this.idSeccion,
                    'idCarrera':this.idCarrera,
                    'idNivel':this.idNivel,       
                }).then(function(response){
                    me.cerrarModal();
                    me.listar(1,'','');
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivar(id, buscar, criterio){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-dark',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar el grado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/grado/desactivar',{
                            'id': id,
                        }).then(function(response){
                            me.listar('',buscar, criterio);
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
            activar(id, buscar, criterio){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar el grado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/grado/activar',{
                            'id': id,
                        }).then(function(response){
                            
                            me.listar('',buscar, criterio);
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
                this.errorGrado = 0;
                this.errorMostrarMsGrado=[];
                if(!this.nombreGrado) this.errorMostrarMsGrado.push("El nombre no puede estar vacio.");
                if(this.errorMostrarMsGrado.length)this.errorGrado = 1;
                return this.errorGrado;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idGrado=0;
                this.idCarrera=0;
                this.idNivel=0;
                this.idSeccion=0;
                this.nombreGrado='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "grado":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar grado';
                                this.tipoAccion = 1;
                                this.nombreGrado = "";
                                this.idCarrera = 0;
                                this.idNivel = 0;
                                this.idSeccion = 0;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar grado";
                                this.tipoAccion = 2;
                                this.nombreGrado = data['nombreGrado'];
                                this.idGrado = data['idGrado'];
                                this.idSeccion = data['idSeccion'];
                                this.idNivel = data['idNivel'];
                                this.idCarrera = data['idCarrera'];
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
        width: 100%;
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