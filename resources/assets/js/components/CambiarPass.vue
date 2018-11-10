
<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Asignar padres y alumnos
                        <button type="button" @click="desactivarListado()" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <template v-if='listado == 1'>
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
                                            <th class="text-center" width="500 px">Alumno</th>
                                            <th class="text-center" width="350 px">Codigo unico</th>
                                            <th class="text-center" width="500 px">Padre / encargado</th>
                                            <th class="text-center" width="350 px">DPI</th>
                                            <th class="text-center" width="100 px">Telefono</th>   
                                            <th class="text-center" >Estado</th>                          
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="alumnos in arrayAlumno" :key="alumnos.idasignacion" class="text-center table-sm"> 
                                        <td class="text-center ">
                                             <button type="button" @click= "editarAsignacion(alumnos.idAsignacion, alumnos.idPadre, alumnos.idAlumnoAsig, alumnos.nombrePadre + ' ' + alumnos.apellidoPadre, alumnos.nombreAlumno + ' ' + alumnos.apellidoAlumno)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                            </button>
                                            <template v-if="alumnos.estadoAsignacion">
                                            <button type="button" class="btn btn-warning btn-sm" @click="desactivar(alumnos.idAsignacion)">
                                                <i class="icon-trash"></i>
                                            </button>
                                            </template>
                                            <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activar(alumnos.idAsignacion)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                            
                                        </td>
                                        <td  v-text="alumnos.nombreAlumno + ' ' + alumnos.apellidoAlumno" class="align-middle" ></td>
                                        <td  v-text="alumnos.codigoAlumno" class="align-middle"></td>
                                        <td v-text="alumnos.nombrePadre + ' ' + alumnos.apellidoPadre" class="align-middle"></td>
                                        <td v-text="alumnos.dpiPadre" class="align-middle"></td>
                                        <td v-text="alumnos.telPadre" class="align-middle"></td>
                                        <td  class="align-middle" >
                                        <div v-if="alumnos.estadoAsignacion" >
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
                    </template>
                    <!-- Fin ejemplo de tabla Listado -->
                    <!-- asigancion -->
                    <template v-if='listado == 2'>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Padre de Familia:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro" @keyup.enter="buscarPadre()" placeholder="nombre del padre de familia" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model="nombrePadreF">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Alumno:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro2" @keyup.enter="buscarHijo()" placeholder="nombre del Alumno" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model='nombreHijo'>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label for="">Agregar</label> 
                                        <div class="input-group">
                                            <button class="btn btn-success" @click="registrarPersona()"><span class="icon-plus"> </span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" @click="activarListado()"><span class="fa fa-close" ></span></button>
                            </div>
                        </div>
                           
                    </template>
                    <!--Fin asigancion -->
                    <!--Actualizar asigancion -->
                    <template v-if='listado == 3'>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Padre de Familia:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro" @keyup.enter="buscarPadre()" placeholder="nombre del padre de familia" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model="nombrePadreF">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Alumno:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro2" @keyup.enter="buscarHijo()" placeholder="nombre del Alumno" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model='nombreHijo'>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label for="">Actualizar</label> 
                                        <div class="input-group">
                                            <button class="btn btn-success" @click="actualizarPersona()"><span class="fa fa-refresh"> </span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" @click="activarListado()"><span class="fa fa-close" ></span></button>
                            </div>
                        </div>
                           
                    </template>
                    
                </div>
                <!-- Fin  Actualizar asignacion -->
            
               
        </div>
            
    </main>
</template>

<script>
    export default {
        data (){
            return{
                idAsignacion: 0,
                idPadre: '',
                idAlumno: '',
                nombreAlumno:'',
                apellidoAlumno:'',
                codigoAlumno:'',
                arrayAlumno : [],
                arrayPadres:[],
                nombrePadre:'',
                apellidoPadre:'',
                dpiPadre:'',
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
                tipoBusqueda:'',
                listado:1,
                idPadreF:'',
                arrayPadreF:'',
                nombrePadreF:'',
                arrayHijo:'',
                idHijo:'',
                nombreHijo:'',
                filtro:'',
                filtro2:'',
                idAsig:'',
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
                
                let me = this;           
                var url = '/asignaralumno?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayAlumno = respuesta.alumnos.data;
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
            
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarPersona(page, buscar, criterio);
            },
            buscarPadre(){
                let me = this;
                var url='/asignaralumno/buscarpadre?filtro=' + me.filtro;

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayPadreF = respuesta.padre;
                    
                    if(me.arrayPadreF.length > 0){
                        me.nombrePadreF=me.arrayPadreF[0]['nombrePadreF']+' '+me.arrayPadreF[0]['apellidoPadreF'];
                        me.idPadreF=me.arrayPadreF[0]['idPadreF'];
                    }
                    else{
                        me.nombrePadreF='No existe un padre de familia con ese nombre';
                        me.idPadreF='0';
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            buscarHijo(){
                let me = this;
                var url='/asignaralumno/buscarhijo?filtro=' + me.filtro2;

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayHijo = respuesta.hijo;
                    
                    if(me.arrayHijo.length > 0){
                        me.nombreHijo=me.arrayHijo[0]['nombreHijo']+' '+me.arrayHijo[0]['apellidoHijo'];
                        me.idHijo = me.arrayHijo[0]['idHijo'];
                    }
                    else{
                        me.nombrePadreF='No existe un alumno con ese nombre';
                        me.idPadreF='0';
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            registrarPersona(){
                
                
                
                axios.post('/asignaralumno/registrar',{
                    'idPersona':this.idPadreF,
                    'idAlumno':this.idHijo,
                }).then(function(response){
                    me.listarPersona(1,'','');
                    me.activarListado();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            actualizarPersona(){
                let me = this;                
                axios.put('/asignaralumno/actualizar',{
                    'idAsignacion':this.idAsig,
                    'idPersona':this.idPadreF,
                    'idAlumno':this.idHijo
                }).then(function(response){
                    me.listarPersona(1,'','');
                    me.activarListado();
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            desactivar(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la asignación?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        console.log(id);
                        
                        axios.put('/asignaralumno/desacativar',{
                            'idAsig': id
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
            activar(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar la asignación?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/asignaralumno/acativar',{
                            'idAsig': id
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
            activarListado(){
                this.listado=1;
            },
            desactivarListado(){
                this.listado=2;
                this.idPadreF='';
                this.nombrePadreF='';
                this.idHijo='';
                this.nombreHijo='';
                this.filtro='';
                this.filtro2='';
                
            },
            editarAsignacion(id_asig,id_padre,id_alumno,nombre_padre,nombre_alumno){
                this.listado=3;
                this.idPadreF=id_padre;
                this.nombrePadreF='';
                this.idHijo=id_alumno;
                this.nombreHijo='';
                this.filtro=nombre_padre;
                this.filtro2=nombre_alumno;
                this.idAsig=id_asig;  
                                  
            }
            
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
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