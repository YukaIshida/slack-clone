<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar @updateChannelInfoDm="updateMyChannelInfoDm($event)" @updateChannelInfo="updateMyChannelInfo($event)" />
        <Message />
    </div>
</template>

<script>
import Sidebar from '../components/Sidebar';
import Message from '../views/Message';
import { mapGetters } from 'vuex';
export default {
    name: "Home",

    components: {
        Sidebar,
        Message
    },

    data() {
        return {
            errors: '',
        }
    },

    mounted() {
        this.$store.dispatch('fetchAuthUser');
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },

    methods: {
        updateMyChannelInfoDm: function($event) {
            this.$store.dispatch('setMessagesAction', []);

            if (this.authUser.data.user_id > $event.data.user_id) {
                this.$store.dispatch('setChannelIdAction', this.authUser.data.user_id + "-" + $event.data.user_id);
            } else {
                this.$store.dispatch('setChannelIdAction', $event.data.user_id + "-" + this.authUser.data.user_id);
            }

            this.$store.dispatch('setChannelNameAction', $event.data.attributes.email);
            this.$store.dispatch('setPlaceholderAction', $event.data.attributes.email + "へのメッセージ");
            this.$store.dispatch('fetchMessages');
        },
        updateMyChannelInfo: function($event) {
            this.$store.dispatch('setMessagesAction', []);

            this.$store.dispatch('setChannelNameAction', $event.data.attributes.channel_name);
            this.$store.dispatch('setPlaceholderAction', $event.data.attributes.channel_name + "へのメッセージ");
            this.$store.dispatch('setChannelIdAction', $event.data.channel_id);
            this.$store.dispatch('fetchMessages');
        },
    }
}
</script>