window.Vue = require('vue');

// window.$ = require('jquery');
// window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.scrollMonitor = require('scrollmonitor');