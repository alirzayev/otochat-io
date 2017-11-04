/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example', require('./components/Example.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const EventBus = new Vue()

Object.defineProperties(Vue.prototype, {
    $bus: {
        get: function () {
            return EventBus
        }
    }
})

const app = new Vue({
    el: '#app',
    data: {
        users: [],
        messages: [],
        usersInRoom: []
    },
    methods: {
        getUsers() {
            axios.get('/users').then(response => {
                console.log('users are', response.data.users)
                this.users = response.data.users;
            });
        },
        getConersationMessages(conv_id) {
            axios.get('/conversations/' + conv_id).then(response => {
                this.messages = response.data;
            });

            return this.messages;
        },
        addMessage(message) {
            // Add to existing messages
            this.messages.push(message);

            // Persist to the database etc
            axios.post('/messages', message).then(response => {
                // Do whatever;
            })
        }
    },
    created() {
        // create bus events for updating message array
        this.$bus.$on('messagesent', this.addMessage)
        this.$bus.$on('getconvmessages', this.getConersationMessages)


        // get users
        this.getUsers()

        window.Echo.join('my-chat')
            .here((users) => {
                this.usersInRoom = users;
                console.log('users object')
            })
            .joining((user) => {
                console.log('user object', user)
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })
            .listen('MessagePosted', (e) => {
                console.log('event object')
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    }
});