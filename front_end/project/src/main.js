// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'

// 引入elementUI
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
// 引入echarts
import ECharts from 'vue-echarts/components/ECharts.vue';


import App from './App'
import router from './router'

import global_ from './components/Global' //引用文件

Vue.prototype.GLOBAL = global_ //挂载到Vue实例上面



Vue.config.productionTip = false

Vue.use(ElementUI);
Vue.component('chart', ECharts)


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
