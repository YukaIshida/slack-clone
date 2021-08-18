<template>
    <div class="flex h-screen">
        <div class="w-1/5 bg-gray-800 text-white pt-3 px-4">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl leading-tight">Slack Clone</h1>
                <Notification />
            </div>
            <div v-if="authUser">{{ authUser.data.attributes.email }}</div>
        </div>

        <div class="flex-grow bg-gray-100">
            <p>ログイン中</p>
            <div>
                <button class="py-1 px-4 bg-gray-800 text-white rounded" @click="logOut">ログアウト</button>
            </div>
        </div>
    </div>
</template>

<script>
import Notification from '../components/icons/Notification';
import { mapGetters } from 'vuex';

export default {
    name: "Home",

    components: {
        Notification
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
        logOut() {
            axios.post('/logout', {})
                .finally(err => {
                    window.location = '/login';
                })
        }
    }
}
</script>