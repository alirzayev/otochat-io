<template lang="html">
  <div class="chat-log">
      <chat-message v-for="message in filteredMessages" :key="message.id" :message="message"></chat-message>
      <div class="empty" v-show="messages.length === 0">
          Nothing here yet!
      </div>
  </div>
</template>

<script>
export default {
    props: ['conv_id', 'messages'],
    computed : {
        filteredMessages() {
            return this.messages.slice(-6)
        }
    },
    created(){
        this.$bus.$emit('getconvmessages', this.conv_id)
    }
}
</script>

<style lang="css">
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}
.empty {
    padding: 1rem;
    text-align: center;
}
</style>