import Vue from 'vue';
import VueMeta from 'vue-meta';
import PortalVue from 'portal-vue'
import {InertiaApp} from '@inertiajs/inertia-vue'
import BootstrapVue from 'bootstrap-vue'
import ElementUi from 'element-ui'
import Vue2Filters from 'vue2-filters'
import Notifications from 'vue-notification'
import VuejsDialog from 'vuejs-dialog';
import CKEditor from '@ckeditor/ckeditor5-vue'
Vue.config.productionTip = false;
Vue.mixin({ methods: { route: window.route } });
Vue.use(InertiaApp);
Vue.use(PortalVue);
Vue.use(VueMeta);
Vue.use(BootstrapVue);
Vue.use(ElementUi);
Vue.use(Vue2Filters);
Vue.use(Notifications);
Vue.use(VuejsDialog);
Vue.use(CKEditor);

let app = document.getElementById('app');

new Vue({
    metaInfo: {
        title: 'Loading…',
        titleTemplate: '%s | SOCIDA',
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app);

