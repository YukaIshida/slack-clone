<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar />
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

    }
}
</script>