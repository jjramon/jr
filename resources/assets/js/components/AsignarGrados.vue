
<template>
    <main class="main">
            <!-- Breadcrumb -->

        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Asignar Materias a Grados
                        <button type="button" @click="abrirModal('AsignarMateria','registrar')" class="btn btn-success" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                              <div class="input-group" >
                                    
                                    <label class="col-md-1 form-control-label" for="text-input" v-text="'Nivel:'"></label>
                                    <select class="form-control"  v-model="criterio" v-on:click="selectGrado(criterio)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="nivel in arrayNivel" :key="nivel.id" :value="nivel.id" v-text="nivel.nombre"  ></option>
                                    </select>
                                    <label class="col-md-1 form-control-label" for="text-input" v-text="'Grado:'"></label>
                                    <select class="form-control"   v-model="buscar" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option  v-if="criterio != 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion"></option>
                                        <option  v-else v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion +' '+grado.nombreCarrera"></option>
                                    </select>       
                                    
                                    <label class="col-md-1 form-control-label" for="text-input" v-text="'Estado:'"></label>
                                    <select class="form-control"   v-model="std" >
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="1" v-text="'Activo'"></option>
                                        <option value="2" v-text="'Inactivo'"></option>
                                    </select>  

                                    <button type="submit" @click="listarPersona(1, buscar, criterio,std)"  class="btn btn-primary"><i class="fa  fa-get-pocket"></i> Listar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-responsive-lg">
                            <thead>
                                
                               <tr class="table-primary">
                                    
                                        <th class="text-center" width="100 px">Opciones</th>
                                        <th class="text-center" width="350 px">Materias</th>
                                        <th class="text-center" >Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="asigMateria in arrayAsigMateria" :key="asigMateria.id" class="text-center table-sm"> 
                                    <td class="align-midle ">
                                            
                                        <button type="button" @click= "abrirModal('AsignarMateria','actualizar',asigMateria)" class="btn btn-info btn-sm " >
                                            <i class="icon-pencil"></i>
                                        </button>
                                                    
                                        <template v-if="asigMateria.estado == 1 ">
                                            <button type="button" class="btn btn-warning btn-sm align-center" @click="desactivar(asigMateria.id, buscar, criterio,std)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm align-center" @click="activar(asigMateria.id, buscar, criterio,std)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                     <td v-text="asigMateria.nombreMateria"></td>
                                     
                                    <td >
                                        <div v-if="asigMateria.estado == 1 ">
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
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,  criterio, buscar, std)" >Ant</a>
                                </li>
                                <li class="page-item " v-for="page in pagesNumber" :key ="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, criterio, buscar, std)" v-text="page"></a>
                                </li>

                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, criterio, buscar, std)">Sig</a>
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
                                            <select class="form-control" v-if="idNivel !=0 && tipoAccion == 1 || tipoAccion == 2"  v-model="idGrado" >
                                                <option value="0" disabled>Seleccione</option>
                                                <option  v-if="idNivel == 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion +' '+grado.nombreCarrera"></option>
                                                <option  v-if="idNivel != 4" v-for="grado in arrayGrado " :key="grado.idGrado" :value="grado.idGrado" v-text="grado.nombreGrado + '/' + grado.nombreSeccion"></option>
                                            </select>
                                          <input type="text" v-if="tipoAccion == 3" v-model="nombreGrado" class="form-control bg-white" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-3 form-control-label" for="text-input">Materia:</label>

                                        <div class="col-md-6 input-group">
                                            <v-select v-if="tipoAccion == 1" 
                                            label="nombre"
                                            :options="arrayMateria"
                                            
                                            :selected="idMateria + arrayMateria['id']"
                                            multiple
                                            v-model="idMateria"
                                            id="v-select"
                                            >
                                            </v-select>
                                            <v-select v-if="tipoAccion == 2" 
                                            label="nombre"
                                            :options="arrayMateria"
                                            :selected="arrayMateria"
                                            v-model="idMateria"
                                            id="selectt"
                                            >
                                            </v-select>
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
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona(buscar, criterio,std)">Guardar</button>
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
                criterio :0,
                buscar : 0,
                std : 0,
                tipoBusqueda:'',
                listado:1,
                filtro:'',
                filtro2:'',
                std:0,
                idAsig:'',
                arrayGrd:[],
                arrayMtr:"",
                ideMtr:'',
                cnd:0,
                filtro:'',
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
        },
        methods : {
            listarPersona(page, criterio, buscar, std){
                this.selectNivel();
                this.selectMateria();

                
                    
                if(criterio!=0 && criterio!='' || buscar != 0 && buscar != ''){
                    let me = this;           
                    var url = '/asignarmateria?page=' + page + '&criterio='+ criterio + '&buscar=' + buscar + '&std='+ std;
                    
                    axios.get(url)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayAsigMateria = respuesta.asigMateria.data;
                        me.arrayGrd = respuesta.grados;
                        me.pagination = respuesta.pagination;
                        if(me.arrayAsigMateria.length<1)
                        {
                            me.sinRegistro();

                        }
                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
            },
            

            cambiarPagina(page, criterio, buscar, std){
                let me = this;
                me.pagination.current_page = page;
                me.listarPersona(page, criterio, buscar, std);
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
            selectMateria(){
                let me = this;
                var url='/asignarmateria/selectMateria';

                axios.get(url).then(function (response){
                    var respuesta=response.data;
                    me.arrayMateria = respuesta.materia;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            getDatosMateria(materia){
                this.idMateria = materia.idMateria;
                    
            },
            registrarPersona(buscar, criterio,std){

                for (var i = 0; i < this.idMateria.length; i++){
                    this.idMtr=this.idMateria[i]['id'];
                
                    let me = this;  
                    axios.post('/asignarmateria/registrar',{
                        'idGrado':this.idGrado,
                        'idMateria':this.idMtr
                    }).then(function(response){
                            me.listarPersona('1', buscar, criterio, std);
                            me.cerrarModal();

                    })
                    .catch(function (error){
                        console.log(error);
                    });
                }
               
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
                this.errorMostrarMsPersona=[];
                if(this.idtipoPersona=='') this.errorMostrarMsPersona.push("Seleccione un tipo de persona");
                if(this.idGenero=='') this.errorMostrarMsPersona.push("Seleccione un genero");
                if(!this.nombre) this.errorMostrarMsPersona.push("El nombre no puede estar vacio.");
                if(!this.apellido) this.errorMostrarMsPersona.push("El apellido no puede estar vacio.");
                
                if(this.errorMostrarMsPersona.length)this.errorPersona = 1;
                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idGrado =0; 
                this.idPersona =0; 
                this.idNivel=0;
                this.filtro="";
                this.idMateria=[];
                this.idMtr=[];
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "AsignarMateria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar asignación';
                                this.idGrado=0;
                                this.idNivel=0;
                                this.idMateria = '';
                                this.tipoAccion=1;
                                this.filtro="";
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