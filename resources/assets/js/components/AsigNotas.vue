
<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Calificaciones
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                              <div class="input-group" >

                                  <label class="col-md-2 form-control-label" for="text-input" v-text="'ciclo:'"></label>
                                    <select class="form-control"   v-model="idCiclo" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-for="ciclo in arrayCiclo " :key="ciclo.id" :value="ciclo.id" v-text="ciclo.nombre"></option>
                                    </select>   
                                    
                                    <label class="col-md-1 form-control-label" for="text-input" v-text="'Nivel:'"  ></label>
                                    <select class="form-control"  v-model="idNivel" v-on:click="selectGrado(idNivel)" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre" ></option>
                                    </select>

                                    <label class="col-md-2 form-control-label" for="text-input">Grado:</label>
                                    <select class="form-control"  v-model="idGrado" v-on:click="selectData(idNivel,idCiclo)" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-if="idNivel  == 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion +' '+grado.nombreCarrera"></option>
                                        <option  v-if="idNivel != 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion"></option>
                                    </select>
                                    <br><br><br>
                                </div>
                                <div class="input-group" >
                                    
                                    <label class="col-md-2 form-control-label" for="text-input">Materia:</label>
                                    <select class="form-control"   v-model="idMateria" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-if="idNivel != 4" v-for="grado in arrayMatr" :key="grado.id" :value="grado.id" v-text="grado.nombre "></option>
                                        <option  v-else v-for="grado in arrayMatr" :key="grado.id" :value="grado.id" v-text="grado.nombre"></option>
                                    </select>

                                    <label  class="col-md-2 form-control-label" for="text-input" v-text="'Bimestre:'"></label>
                                    <select  class="form-control"   v-model="idBimestre" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-for="bimestre in arrayBimestre" :key="bimestre.id" :value="bimestre.id" v-text="bimestre.nombre "></option>
                                    </select>  
                                        
                                                                            
                                    <button type="submit" @click="listarPersona(1,   idMateria, idNivel, idCiclo, idBimestre, idGrado)"  class="btn btn-primary"><i class="fa  fa-get-pocket"></i> Listar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-responsive-lg">
                            <thead>
                                
                               <tr class="table-primary">
                                    
                                        <th class="text-center" width="100 px">Opciones</th>
                                        <th class="text-center" width="350 px">Nombre</th>
                                        <th class="text-center" width="150 px">Calificación</th>
                                        <th class="text-center" width="450 px">Observaciones</th>
                                        <th class="text-center" width="100 px">Guardar</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="calificacion in arrayCalificacion" :key="calificacion.id" class="text-center table-sm"> 
                                    <td class="align-midle ">
                                            
                                        <button type="button" @click= "abrirModal('AsignarMateria','actualizar',asigMateria)" class="btn btn-info btn-sm " >
                                            <i class="icon-pencil"></i>
                                        </button>
                                                    
                                        <button type="button" @click="abrirModal('AsignarMateria','registrar')" class="btn btn-success" >
                                            <i class="icon-plus"></i>
                                        </button>
                                    </td>
                                    
                                    <td v-text="calificacion.nombre"></td>
                                    <td v-text="calificacion.calificacion"></td>
                                    <td v-text="calificacion.observacion"></td>
                                    <td class="align-midle ">  
                                        <button type="button" @click= "'prueba'" class="btn btn-success btn-lg " >
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,  criterio, buscar, idCiclo, idBimestre)" >Ant</a>
                                </li>
                                <li class="page-item " v-for="page in pagesNumber" :key ="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, criterio, buscar, idCiclo, idBimestre)" v-text="page"></a>
                                </li>

                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, criterio, buscar, idCiclo, idBimestre)">Sig</a>
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
                                        
                                    <label class="col-md-3 form-control-label" for="text-input" v-text="'ciclo:'"></label>
                                    <div class="col-md-6 input-group">
                                    <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="ciclo" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-for="ciclo in arrayCiclo " :key="ciclo.id" :value="ciclo.id" v-text="ciclo.nombre"></option>
                                        
                                    </select> 
                                    </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Nivel:</label>
                                        <div class="col-md-6 input-group">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2" v-model="idNivel" v-on:click="selectGrado(idNivel)">
                                                <option value="0" disabled>Seleccione</option>
                                                <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Grado:</label>
                                        <div class="col-md-6">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="idGrado" v-on:click="selectData(idNivel,ciclo)">
                                                <option value="0" disabled>Seleccione</option>
                                                <option  v-if="idNivel == 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion +' '+grado.nombreCarrera"></option>
                                                <option  v-if="idNivel != 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion"></option>
                                                
                                            </select>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Materia:</label>
                                            
                                        <div class="col-md-6 input-group">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="idMateria" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option  v-if="idNivel != 4" v-for="grado in arrayMatr" :key="grado.id" :value="grado.id" v-text="grado.nombre "></option>
                                                <option  v-else v-for="grado in arrayMatr" :key="grado.id" :value="grado.id" v-text="grado.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Bimestre:</label>

                                        <div class="col-md-6 input-group">
                                            <select class="form-control" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="bimestre" v-on:click="selectAlumno(idData, idGrado, ciclo)" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option  v-for="bimestre in arrayBimestre" :key="bimestre.id" :value="bimestre.id" v-text="bimestre.nombre "></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno:</label>

                                        <div class="col-md-6 input-group">
                                            <v-select v-if="tipoAccion == 1" 
                                            label="nombre"
                                            :options="arrayAlumno"
                                            :selected="idAlumno + arrayAlumno['id']"
                                            v-model="idAlumno"
                                            id="v-select"
                                            >
                                            </v-select>
                                            <input type="text" v-if="tipoAccion == 2" v-model="nombreAlumno" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Conducta:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="8" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="conducta" class="form-control" placeholder="Ingrese el punteo por conducta" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Colaboracion:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="4" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="colaboracion" class="form-control" placeholder="Ingrese el punteo por colaboración" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Asistencia:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="4" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="asistencia" class="form-control" placeholder="Ingrese el punteo por asistencia" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Uniforme:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="4" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="uniforme" class="form-control" placeholder="Ingrese el punteo por uniforme" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Actividades:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="30" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="actividades" class="form-control" placeholder="Ingrese el punteo de las actividades " required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Examen:</label>
                                        <div class="col-md-3">
                                            <input type="number" min="0" max="50" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="examen" class="form-control" placeholder="Ingrese el punteo de examen" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Calificacion:</label>
                                        <div class="col-md-3">
                                            <span>{{total=calcluarCalificacion}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Observaciones:</label>
                                        <div class="col-md-9">
                                            <input type="text" max="150" v-if="tipoAccion == 1 || tipoAccion == 2"  v-model="observacion" class="form-control bg-white"  placeholder="Ingrese las observaciones sobre el alumno" required>
                                        </div>
                                    </div>
                                    <div v-show="errorPersona" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsPersona" :key="error" v-text="error"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            
                               
                            
                            <div class="modal-footer">
                                
                                                                
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="docent(criterio, buscar, idCiclo, idBimestre)">Guardar</button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona(buscar, criterio,std)">Actualizar</button>
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
import vSelect from 'vue-select';
    export default {
        data (){

            return{
                idAsignacion: 0,
                idBimestre:0,
                bimestre:0,
                idData: 0,
                idCiclo:0,
                ciclo:0,
                idGrado:0,
                idNivel:0,
                idMateria:0,
                idAlumno:0,
                nombreAlumno:'',
                arrayAsigMateria:[],
                arrayAlumno:[],
                arrayGrado:[],
                arrayCiclo:[],
                arrayCalificacion:[],
                arrayMateria:[],
                arrayBimestre:[],
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
                criterio :0,
                buscar : 0,
                std : 0,
                tipoBusqueda:'',
                listado:1,
                idAsig:'',
                arrayGrd:[],
                arrayMatr:[],
                conducta: 0.0,
                colaboracion: 0.0,
                asistencia: 0.0,
                uniforme: 0.0,
                actividades: 0.0,
                examen: 0.0,
                promedio: 0.0,
                calificacion: 0.0,
                observacion:'',
                idAlum:0,
                idMtr:0,
                conduct:0,
                colab:0,
                asist:0,
                unif:0,
                activ:0,
                exam:0

            }
        },
        components:{
            vSelect
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
            calcluarCalificacion: function(){
            var resultado = 0.0;
            resultado = parseInt(this.conducta)+parseInt(this.colaboracion)+parseInt(this.asistencia)+parseInt(this.uniforme)+parseInt(this.actividades)+parseInt(this.examen);
            this.calificacion=resultado;
            if(resultado>100){
                swal('La calificación no puede ser mayor a 100 puntos');
            }
            return resultado;
        }       

        },
        methods : {
            listarPersona(page, criterio, buscar, idCiclo, idBimestre){
                this.selectNivel();
                this.selectCiclo();
                this.selectBimestre();
                
                console.log(criterio, buscar, idCiclo, idBimestre)
                
                    
                if(criterio!=0 && criterio!='' || buscar != 0 && buscar != ''){
                    let me = this;           
                    var url = '/regCalificaciones?page=' + page + '&criterio='+ criterio + '&buscar=' + buscar + '&idCiclo='+ idCiclo + '&idBimestre='+idBimestre;
                    
                    axios.get(url)
                    .then(function (response) {
                        console.log(url);
                        var respuesta = response.data;
                        me.arrayCalificacion= respuesta.calificacion.data;
                        me.pagination = respuesta.pagination;
                        console.log(url);
                        if(me.arrayCalificacion.length<1)
                        {
                            me.sinRegistro();

                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
            },
            

            cambiarPagina(page, criterio, buscar, idCiclo, idBimestre){
                let me = this;
                me.pagination.current_page = page;
                me.listarPersona(page, criterio, buscar, idCiclo, idBimestre);
            },
            selectAlumno(idDocente, idGrado, idCiclo){
               let me=this;
                var url = '/regCal/alumnos?idDocente='+idDocente+'&idGrado='+ idGrado+'&idCiclo='+ idCiclo
                axios.get(url)
                .then(function (response) {
                    
                    let respuesta = response.data;
                    me.arrayAlumno = respuesta.alumno;
                    
                })
                .catch(function (error){
                console.log(error);
                }); 
            },
            selectNivel(){
                let me=this;
                var url = '/grado/selectNivel'
                axios.get(url)
                .then(function (response) {
                    
                    let respuesta = response.data;
                    me.arrayNivel = respuesta.nivel;
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },
            selectCiclo(){
                let me = this;   
                var url = '/alumno/selectCiclo';
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayCiclo = respuesta.ciclo;
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },
            selectBimestre(){
                let me = this;   
                var url = '/regCalificaciones/selectBimestre';
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayBimestre = respuesta.bimestre;
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },
            selectData(criterio, idCiclo){
                let me=this;
                var url = '/regCalificaciones/data'
                axios.get(url)
                .then(function (response) {
                    
                    me.idData = response.data;
                    
                    me.selectMat(me.idData, criterio, idCiclo);
                    
                })
                .catch(function (error){
                console.log(error);
                });

            },
            selectMat(id, criterio, idCiclo){
                if(idCiclo != 0)
                {
                let me = this;   
                var url = '/regCal/materias?id='+id+'&criterio='+criterio+'&idCiclo='+idCiclo;
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayMatr = respuesta.materia;
                    
                })
                .catch(function (error){
                console.log(error);
                });
                }
            },
            
            selectCiclo(){
                let me = this;   
                var url = '/alumno/selectCiclo';
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayCiclo = respuesta.ciclo;
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },
            selectGrado(id){
                let me = this;   
                var url = '/alumno/selectGrado?filtro='+id;
                axios.get(url)
                .then(function (response) {
                    
                    var respuesta = response.data;
                    me.arrayGrado = respuesta.grado;
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },

            docent(criterio, buscar, idCiclo, idBimestre,){
                let me=this;
                var url = '/regCalificaciones/data'
                axios.get(url)
                .then(function (response) {
                    
                    me.idData = response.data;
                    me.registrarPersona(criterio, buscar, idCiclo, idBimestre, me.idData);
                    
                })
                .catch(function (error){
                console.log(error);
                });
            },
            registrarPersona(criterio, buscar, idCiclo, idBimestre, dcnt){
                
                let me = this;  
                              
                    this.idAlum=this.idAlumno['id'];
                    
                    axios.post('/regCal/registrar',{
                    'idMateria':this.idMateria,
                    'idDocente':dcnt,
                    'idBimestre':this.bimestre,
                    'idAlumno':this.idAlum,
                    'idCiclo':this.ciclo,
                    'calificacion':this.calificacion,
                    'conducta':this.conducta,
                    'colaboracion':this.colaboracion,
                    'asistencia':this.asistencia,
                    'uniforme':this.uniforme,
                    'actividades':this.actividades,
                    'examen':this.examen,
                    'observaciones':this.observacion
                    }).then(function(response){
                            me.listarPersona('1', criterio, buscar, idCiclo, idBimestre);
                            me.cerrarModal();

                    })
                    .catch(function (error){
                        console.log(error);
                    });
                
               
            },

            correcto(){
                swal({
                    type: 'success',
                    title: 'Proceso finalizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            },

            sinRegistro(){
                swal({
                    
                    type: 'success',
                    title: 'no se encuentran registros',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            actualizarPersona(buscar, criterio,std){
                this.ideMtr = this.idMateria['id'];
                let me = this;  
                axios.put('/asignarmateria/actualizar',{
                    'id':this.idAsignacion,
                    'idGrado':this.idGrado,
                    'idMateria':this.ideMtr,
  
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPersona('1', buscar, criterio, std);
                    me.correcto();
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            desactivar(id, criterio, buscar, std){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere desactivar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'desactivar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/asignarmateria/desactivar',{
                            'idAsig': id
                        }).then(function(response){
                            me.listarPersona(1,  criterio, buscar, std);
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
            activar(id, criterio, buscar, std){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿está seguro de que quiere activar la persona?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'activar',
                cancelButtonText: 'cancelar',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/asignarmateria/activar',{
                            'idAsig': id
                        }).then(function(response){
                            me.listarPersona(1,  criterio, buscar, std);
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

            validarPersona(){
                this.errorPersona = 0;
                
                
                if(this.errorMostrarMsPersona.length)this.errorPersona = 1;
                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.ciclo=0;
                this.bimestre=0;
                this.idMateria=0;
                this.idAlumno='';
                this.idNivel=0;
                this.idGrado =0; 
                this.conducta= 0.0,
                this.colaboracion= 0.0,
                this.asistencia= 0.0,
                this.uniforme= 0.0,
                this.actividades= 0.0,
                this.examen= 0.0,
                this.promedio= 0.0,
                this.calificacion= 0.0,
                this.idMateria=[];
                this.idMart=[];
                this.observacion='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "AsignarMateria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar calificación';
                                this.ciclo=0;
                                this.bimestre=0;
                                this.idMateria=0;
                                this.idAlumno='';
                                this.idNivel=0;
                                this.idGrado =0; 
                                this.conducta= 0.0,
                                this.colaboracion= 0.0,
                                this.asistencia= 0.0,
                                this.uniforme= 0.0,
                                this.actividades= 0.0,
                                this.examen= 0.0,
                                this.promedio= 0.0,
                                this.calificacion= 0.0,
                                this.idMateria=[];
                                this.idMart=[];
                                this.observacion='';
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = "Actualizar asignación";
                                this.tipoAccion = 2;
                                this.idAsignacion=data['id'];
                                this.idNivel=data['idNivel'];
                                this.idGrado = data['idGrado'];
                                this.idMateria = data['nombreMateria'];
                                
                                break;
                            }
                                                         
                        }
                    }
                }
                
            }
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio,this.std);
        }
    }
</script>
<style>
    #v-select{
        width:100%;

    }
    #selectt{
        width:100%;

    }
   .modal-content{
        width: 100%;
        height: 550px;
        overflow-y: scroll;
        overflow-x: unset;
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
    #selectPadre{
        width: 100%;
        margin: 1em auto;
    }

</style>