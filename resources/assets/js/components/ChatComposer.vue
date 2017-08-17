<template lang="html">
  <div class="chat-composer">
      <input type="text" placeholder="Start typing your message..." v-model="messageText" @keyup.enter="sendMessage">
      <button class="btn btn-primary" @click="sendMessage">Send</button>
  </div>
</template>

<script>
export default {
    data() {
        return {
            messageText : ''
        }
    },
    props:['conv_id'],
    methods: {
        sendMessage() {
            var data = {
                conversation_id:this.conv_id,
                message: this.messageText,
                user: {
                    name: $('.navbar-right .dropdown-toggle').text()
                }
            };

            // send message
            this.$bus.$emit('messagesent', data);
            this.messageText = '';
        }
    }
}
</script>

<style lang="css">
.chat-composer {
    display: flex;
}
.chat-composer input {
    flex: 1 auto;
    padding: .5rem 1rem;
}
.chat-composer button {
    border-radius: 0;
}
</style>