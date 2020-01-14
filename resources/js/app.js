require('./bootstrap');

import Vue from 'vue';
window.Vue = Vue;

import ExampleComponent from './components/ExampleComponent';

Vue.component('ExampleComponent', ExampleComponent);

const app = new Vue({
    el: '#app',
});
