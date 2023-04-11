import './bootstrap';
import Vue from 'vue';
import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();

const app = new Vue({
    el: '#app',
    data: {
        message: 'Hello from Vue!'
    }
});
