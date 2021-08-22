<template>
    <div class="flex flex-col flex-grow bg-gray-100 overflow-y-scroll">
        <header class="border-b w-full">
            <div class="flex justify-between m-3">
                <div>
                    <div class="font-bold text-lg">DM検索</div>
                </div>
            </div>
        </header>
        <main class="overflow-y-scroll flex-grow">
            <div class="relative z-1">
                <div class="absolute">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 mt-6 ml-2">
                        <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    @keypress.prevent.enter.exact="enable_search"
                    @keyup.prevent.enter.exact="search"
                    class="w-full mt-4 bg-gray-200 border border-gray-400 pl-8 pr-3 py-1 rounded text-sm focus:outline-none focus:border-blue-500 focus:shadow focus:bg-gray-100" 
                    :placeholder="placeholder" 
                    id="searchTerm"
                    v-model="searchKeyword"
                >
            </div>
            <div class="px-4">
                <div class="w-full border-b py-2 text-base font-bold" v-for="user in users" :key="'user' + user.data.user_id">
                    <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
                    <span @click="directMessage(user)"># {{ user.data.attributes.name }}</span>
                    <span v-if="user.data.user_id == authUser.data.user_id">(自分)</span>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "ChannelSearch",

    data() {
        return {
            searchKeyword: "",
            can_search: false,
            placeholder: "ユーザー名で検索",
            users: [],

        };
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },

    methods: {
        enable_search() {
            this.can_search = true;
            this.placeholder="Enterキーを押して検索";
        },
        search() {
            if (this.can_search) {
                axios.get('/api/users?searchKey=' + this.searchKeyword)
                    .then(response => {
                        this.users = response.data.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
                this.can_search = false;
            }
        },
        directMessage(user) {
            this.$store.dispatch('setMessagesAction', []);

            if (this.authUser.data.user_id > user.data.user_id) {
                this.$store.dispatch('getChannelId', 
                    {dm_channel_name: this.authUser.data.user_id + "-" + user.data.user_id,
                    dm_user_1: this.authUser.data.user_id,
                    dm_user_2: user.data.user_id});
            } else {
                this.$store.dispatch('getChannelId', 
                    {dm_channel_name: user.data.user_id + "-" + this.authUser.data.user_id,
                    dm_user_1: user.data.user_id,
                    dm_user_2: this.authUser.data.user_id});
            }

            this.$store.dispatch('setChannelNameAction', user.data.attributes.email);
            this.$store.dispatch('setPlaceholderAction', user.data.attributes.email + "へのメッセージ");
            if (this.$route.path != '/home') {
                this.$router.push('/home');
            }
        },
    }

}
</script>

<style scoped>

</style>