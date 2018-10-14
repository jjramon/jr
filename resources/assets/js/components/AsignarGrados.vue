
<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Asignar materia a grado
                        <button type="button" @click="desactivarListado()" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <template v-if='listado == 1'>
                        <div class="card-body">

                            <table class="table table-bordered table-striped table-responsive-lg">
                                <thead>
                                <tr class="table-primary">
                                        
                                            <th class="text-center" width="100 px">Opciones</th>
                                            <th class="text-center" >Grado</th>
                                            <th class="text-center" >Nivel</th>
                                            <th class="text-center" >Materia</th>                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="asigMateria in arrayAsigMateria" :key="asigMateria.idAsignacion" class="text-center table-sm"> 
                                        <td class="text-center ">
                                             <button type="button" @click="editarAsignacion()" class="btn btn-info btn-sm" >
                                            <i class="icon-pencil"></i>
                                            </button>
                                            
                                        </td>
                                        <td  v-text="asigMateria.nombreGrado + ' / ' + asigMateria.nombreSeccion" class="align-middle" ></td>
                                        <td  v-text="asigMateria.nombreNivel + ' / ' + asigMateria.nombreCarrera" class="align-middle"></td>
                                        <td  v-text="asigMateria.nombreMateria" class="align-middle"></td>
                                                                                
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
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Nivel:</label> 
                                        <div class="input-group">
                                             <select class="form-control"   v-model="filtro" @keyup.enter="buscarPadre()">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.idNivel" :value="nivel.idNivel" v-text="nivel.nombreNivel" @click="buscarPadre()"></option>
                                            </select>
                                            <button class="input-group-text btn btn-primary btn-sm" @click="buscarPadre()"><span class="fa fa-navicon"></span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Grado:</label> 
                                        <div class="input-group">
                                            <select class="form-control"   v-model="idGrado" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="grado in arrayGrado" :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion+'/'+grado.nombreCarrera" ></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nivel:</label> 
                                        <div class="input-group">
                                             <select class="form-control"   v-model="filtro" @keyup.enter="buscarPadre()">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.idNivel" :value="nivel.idNivel" v-text="nivel.nombreNivel" @click="buscarPadre()"></option>
                                            </select>
                                            <button class="btn btn-success"  v-if="tipoAccion == 1 || tipoAccion == 2" @click="buscarPadre()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Grado:</label> 
                                        <div class="input-group">
                                            <select class="form-control"   v-model="idGrado" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="grado in arrayGrado" :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion+'/'+grado.nombreCarrera" ></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Materia:</label> 
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="filtro2" @keyup.enter="buscarHijo()" placeholder="nombre de la materia" required>
                                            <button class="input-group-text btn btn-primary btn-sm"><span class="fa fa-navicon"></span></button>
                                            <input type="text" readonly class="form-control" v-model='nombreMateria'>
                                        </div>
                                    </div>
                                </div>
                           
                            
                                <div class="col-md-6 ">
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
                idGrado:0,
                idNivel:0,
                idMateria:0,
                arrayAsigMateria:[],
                arrayMateria:[],
                arrayGrado:[],
                nombreGrado:'',
                nombreMateria:'',
                arrayNivel:[],
                nombreNivel:'',
                idGrado:0,
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
                this.selectNivel();
                let me = this;           
                var url = '/asignarmateria?page=' + page + '&buscar=' + buscar + '&criterio='+ criterio;
                
                axios.get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayAsigMateria = respuesta.asigMateria.data;
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
            selectNivel(){
                let me = this;
                var url = '/asignarmateria/selectNivel'
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayNivel = respuesta.nivel;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            buscarPadre(){
                let me = this;
                var url='/asignarmateria/selectGrado?filtro=' + me.filtro;

                axios.get(url)
                .then(function (response){
                    var respuesta=response.data;
                    me.arrayGrado= respuesta.grado;
                })
                
                .catch(function (error){
                    console.log(error);
                });
            },
            buscarHijo(){
                let me = this;
                var url='/asignarmateria/selectMateria?filtro=' + me.filtro2;

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayMateria = respuesta.materia;
                    
                    if(me.arrayMateria.length > 0){
                        me.nombreMateria=me.arrayMateria[0]['nombreMateria'];
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
                console.log(this.idMateria, this.idGrado);
                let me = this;  
                axios.post('/asignarmateria/registrar',{
                    'idGrado':this.idGrado,
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
            editarAsignacion(){
                this.listado=3;
                this.idGrado=data['idGrado'];
                this.idMateria=data['idMateria'];
                this.idAsignacion=data['idAsignacion'];
                                  
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