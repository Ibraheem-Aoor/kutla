
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('babel-polyfill');

window.Vue = require('vue');
import ElementUI from 'element-ui'
import { Loading } from 'element-ui';
import moment from 'moment'

import locale from 'element-ui/lib/locale/lang/ar'

Vue.use(ElementUI, { locale })
Vue.use(Loading)
require('./components/categories/form');
require('./components/categories/index');
////////////////
require('./components/writers/form');
require('./components/writers/index');
////////////////
require('./components/hotels/form');
require('./components/hotels/index');
////////////////

require('./components/posts/form');
require('./components/posts/index');
require('./components/posts/posts_position');
require('./components/posts/people_news');

require('./components/users/index');
require('./components/users/form');


require('./components/alboms/index');
require('./components/alboms/show');
require('./components/alboms/form');

require('./components/videos/index');
require('./components/videos/form');

require('./components/tags/index');

require('./components/users/roles');
require('./components/users/action_role');

require('./components/cases/index');
require('./components/cases/form');

require('./components/votes/index');
require('./components/votes/form');

require('./components/pages/index');
require('./components/pages/form');

require('./components/urgents/index');
require('./components/urgents/form');

require('./components/advs/index');
require('./components/advs/form');
require('./components/advs/setting');

require('./components/setting/form');
require('./components/setting/user_log');
require('./components/setting/user_record');

require('./components/live_videos/index');
require('./components/live_videos/form');

require('./components/events/index');
require('./components/events/form');

require('./components/reports/index');
require('./components/reports/form');
require('./components/contactus/index');

require('./components/mail_list/index');
require('./components/mail_list/send');
require('./components/mail_list/mail_sent');

require('./components/relase/index');
require('./components/relase/form');

require('./components/link/index');
require('./components/link/form');
require('./components/banner/form');


require('./components/remember/index');
require('./components/remember/form');

const app = new Vue({
    el: '#app',
    mounted() {

        // localStorage.setItem('user', JSON.stringify(USER));
        //
        // if(!localStorage.getItem('lastMove')) {
        //     localStorage.setItem('lastMove', moment());
        // }
        // if(!localStorage.getItem('inIdle')) {
        //     localStorage.setItem('inIdle', false);
        // }
        //
        // this.checkIdle();
        //
        // window.addEventListener('mousemove', e => {
        //     localStorage.setItem('lastMove', moment());
        //     if(JSON.parse(localStorage.getItem('inIdle'))) {
        //         //axios.post('/user/idle/end');
        //     }
        //     localStorage.setItem('inIdle', false);
        // });
        //
        // setInterval(() => {
        //     this.checkIdle();
        //     axios.get(`${BASE_URL}/dashboard/user_logs/close_session`).then(response => {
        //     });
        // }, 30000);
    },

    methods: {
        checkIdle() {
            // moment.suppressDeprecationWarnings = true;
            // if(moment().diff(localStorage.getItem('lastMove'), 'seconds') > 1800) {
            //     if(!JSON.parse(localStorage.getItem('inIdle'))) {
            //          localStorage.setItem('inIdle', true);
            //         axios.post(`${BASE_URL}/logout`).then(response => {
            //             location.reload();
            //         });
            //     }
            // }

        }
    },
});


