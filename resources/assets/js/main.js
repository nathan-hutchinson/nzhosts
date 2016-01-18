//browserify entrypoint

var Vue = require('vue');

import Alert from './components/alert.vue';


new Vue({
    el: "#app",

    components: {
        Alert
    },

    data: {
        'showAlert': false
    }


});