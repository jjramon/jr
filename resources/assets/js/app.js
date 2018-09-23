
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('genero', require('./components/Generos.vue'));
Vue.component('rol', require('./components/Roles.vue'));
Vue.component('ciclo', require('./components/Ciclos.vue'));
Vue.component('dia', require('./components/Dias.vue'));
Vue.component('seccion', require('./components/Secciones.vue'));
Vue.component('bimestre', require('./components/Bimestres.vue'));
Vue.component('nivel', require('./components/Niveles.vue'));
Vue.component('horario', require('./components/Horarios.vue'));
Vue.component('tipopersona', require('./components/Tipo_personas.vue'));
Vue.component('persona', require('./components/Personas.vue'));
Vue.component('alumno', require('./components/Alumnos.vue'));
Vue.component('usuario', require('./components/Users.vue'));
Vue.component('padrealumno', require('./components/Asig_pad_alum.vue'));

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
