
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
                                            <th class="text-center" width="500 px">Docente</th>
                                            <th class="text-center" width="350 px">DPI</th>
                                            <th class="text-center" width="500 px">Materia</th>
                                            <th class="text-center" width="350 px">Grado</th>                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="docente in arrayDocente" :key="docente.idAsignacion" class="text-center table-sm"> 
                                        <td class="text-center ">
                                             <button type="button" @click= "editarAsignacion(alumnos.idAsignacion, alumnos.idPadre, alumnos.idAlumnoAsig, alumnos.nombrePadre + ' ' + alumnos.apellidoPadre, alumnos.nombreAlumno + ' ' + alumnos.apellidoAlumno)" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                            </button>
                                            
                                        </td>
                                        <td  v-text="docente.nombreDocente + ' ' + docente.apellidoDocente" class="align-middle" ></td>
                                        <td  v-text="docente.DPIDocente" class="align-middle"></td>
                                        <td v-text="docente.nombreMateria" class="align-middle"></td>
                                        <td v-text="docente.nombreGrado + '/' + docente.nombreSeccion + '/' +docente.nombreCarrera" class="align-middle"></td>
                                        
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
                                        <label for="">Docente:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro" @keyup.enter="buscarPadre()" placeholder="nombre del docente" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model="nombreDocente">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Materia:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro2" @keyup.enter="buscarHijo()" placeholder="nombre de la materia" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model='nombreMateria'>
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
                                        <label for="">Docente:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro" @keyup.enter="buscarPadre()" placeholder="nombre del docente" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model="nombreDocente">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Materia:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro2" @keyup.enter="buscarHijo()" placeholder="nombre de la materia" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model='nombreMateria'>
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
                idDocente:0,
                idMateria:0,
                arrayMateria:[],
                arrayDocente:[],
                nombreDocente:'',
                apellidoDocente:'',
                DPIDocente:'',
                telDocente:'',
                arrayGrado:[],
                nombreMateria:'',
                idGrado:0,
                arrayTipo_persona : [],
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
                
                let me = this;           
                var url = '/asignarDocente?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayDocente = respuesta.docente.data;
                    me.pagination = respuesta.pagination;
                    
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
                var url='/asignarDocente/selectDocente?filtro=' + me.filtro;

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayDocente = respuesta.docente;
                    
                    if(me.arrayDocente.length > 0){
                        me.nombreDocente=me.arrayDocente[0]['nombreDocente']+' '+me.arrayDocente[0]['apellidoDocente'];
                        me.idDocente=me.arrayDocente[0]['idDocente'];
                    }
                    else{
                        me.nombreDocente='No existe docente con ese nombre';
                        me.idDocente='0';
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            buscarHijo(){
                let me = this;
                var url='/asignarDocente/selectMateria?filtro=' + me.filtro2;

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayMateria = respuesta.materia;
                    
                    if(me.arrayMateria.length > 0){
                        me.nombreMateria=me.arrayMateria[0]['nombreMateria']+'/'+me.arrayMateria[0]['nombreGrado']+'/'+me.arrayMateria[0]['nombreSeccion']+'/'+me.arrayMateria[0]['nombrecarrera']+'/'+me.arrayMateria[0]['nombreNivel'];
                        me.idMateria = me.arrayMateria[0]['idMateria'];
                    }
                    else{
                        me.nombreMateriaF='No existe una materia con ese nombre';
                        me.idMateria='0';
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            registrarPersona(){
                console.log(this.idDocente, this.idMateria)
                let me = this;  
                axios.post('/asignarDocente/registrar',{
                    'idDocente':this.idDocente,
                    'idMateria':this.idMateria
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
                axios.put('/asignarDocente/actualizar',{
                    'idAsignacion':this.idAsig,
                    'idDocente':this.idDocente,
                    'idMateria':this.idMateria
                }).then(function(response){
                    me.listarPersona(1,'','');
                    me.activarListado();
                })
                .catch(function (error){
                    console.log(error);
                });
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