'use strict';

var _vue = require('vue');

var _vue2 = _interopRequireDefault(_vue);

var _App = require('./App');

var _App2 = _interopRequireDefault(_App);

var _axios = require('axios');

var _axios2 = _interopRequireDefault(_axios);

var _router = require('./router');

var _router2 = _interopRequireDefault(_router);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

_vue2.default.config.productionTip = false;
_vue2.default.component('example', require('./components/Example.vue'));
_vue2.default.prototype.$http = _axios2.default;
var app = new _vue2.default({
  el: '#app',
  router: _router2.default,
  template: '<App/>',
  components: { App: _App2.default }
});

//# sourceMappingURL=main-compiled.js.map