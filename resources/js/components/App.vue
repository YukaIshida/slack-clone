<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar />
        <router-view></router-view>
    </div>
</template>

<script>
import Sidebar from '../components/Sidebar';
import { mapGetters } from 'vuex';

export default {
    name: "App",

    components: {
        Sidebar,
    },

    mounted() {
        this.$store.dispatch('fetchAuthUser');
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },
}
</script>

<style scoped>
</style>