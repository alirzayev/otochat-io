<template lang="html">

  <div class="users">
    <h5 @click="createConversation">{{ user.name }}</h5>
  </div>

</template>

<script>
export default {
    props: ['user'],
    methods : {
        createConversation(){
            // open or create new conversation
            axios.post('/conversations', this.user).then(response => {
                window.location.href = '/chat/'+response.data.conversation.id
            })
        }
    }
}
</script>

<style lang="css">
.users {
    padding: 2rem;
}
.chat-message > p {
    margin-bottom: .5rem;
}
</style>