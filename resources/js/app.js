/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue')

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

// App Components
Vue.component('tags', require('./components/Tags.vue').default)
Vue.component('categories', require('./components/Categories.vue').default)
Vue.component('photos', require('./components/Photos.vue').default)
Vue.component('links', require('./components/Links.vue').default)
Vue.component('videos', require('./components/Videos.vue').default)
Vue.component('loading', require('./components/basic/Loading.vue').default)
Vue.component('displayError', require('./components/basic/DisplayError.vue').default)
Vue.component('formError', require('./components/basic/FormError.vue').default)
Vue.component('displayImage', require('./components/Image.vue').default)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
