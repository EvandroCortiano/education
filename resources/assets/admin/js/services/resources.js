import 'vue-resource';
import ADMIN_CONFIG from './adminConfig';
import Vue from 'vue';

// pega e guarda o Token para utilizar o laravel
Vue.http.headers.common['X-CSRF-Token'] = $('meta[name=csrf-token]').attr('content');

// cria variavel para usar as rotas para a class student (resurce)
// ex: 'DELETE' /admin/class_information/1/students/10
let ClassStudent = Vue.resource(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/{class_information}/students/{student}`)
let ClassTeaching = Vue.resource(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/{class_information}/teachings/{teaching}`)

export {
    ClassStudent, ClassTeaching
}
