require('./echo-server.js');

// import VueChatScroll from 'vue-chat-scroll'
import adapter from 'webrtc-adapter';
// import VueTimeago from 'vue-timeago';
// import Router from 'vue-router';

// import jPlayer from 'jplayer';
window.Vue = require('vue');

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/
// Vue.use(VueChatScroll);
// Vue.use(Router);


// import jPlayer from 'jplayer';

// Vue.component('chats' , require('./components/laravel-video-chat/Chats.vue').default);
Vue.component('chat-room' , require('./components/laravel-video-chat/ChatRoom.vue').default);
Vue.component('group-chat-room', require('./components/laravel-video-chat/GroupChatRoom.vue').default);
Vue.component('video-section' , require('./components/laravel-video-chat/VideoSection.vue').default);
// Vue.use(VueTimeago, {
//    name: 'timeago',
//    locale: 'ru-RU',
//    locales: {
//       'ru-RU': require('vue-timeago/locales/ru-RU.json')
//    }
// });

// import Ratings from './components/Rating.vue';
// import Telephone from './components/Telephone.vue';


if(document.getElementById('app')){
   const app = new Vue({
      el: '#app',
   });
}
