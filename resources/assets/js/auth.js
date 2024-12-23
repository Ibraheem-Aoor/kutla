
require('./bootstrap');

window.Vue = require('vue');


require('./components/auth/login');

const app = new Vue({
    el: '#login-form'
});
