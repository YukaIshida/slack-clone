<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar />

        <div class="flex flex-col flex-grow bg-gray-100">
            <header class="border-b">
                <div class="flex justify-between m-3">
                    <div>
                        <div class="font-bold text-lg">{{ authUser.data.attributes.email }}</div>
                        <Star />
                    </div>
                    <div class="flex items-center">
                        <Call class="mx-2" />
                        <Information />
                        <Cog class="mx-2" />
                        <div class="border w-64 rounded p-1 ml-2 mr-2 flex">
                            <Search />
                            <span class="ml-2 text-gray-700">検索</span>
                        </div>
                        <AtSymbol class="mx-2" />
                        <Star class="mx-2" />
                        <button class="py-1 px-4 bg-gray-800 text-white rounded" @click="logOut">ログアウト</button>
                    </div>
                </div>
            </header>

            <main class="overflow-y-scroll flex-grow">
                <div class="flex flex-col ml-6 h-full">
                    <div class="flex-grow overflow-y-scroll">
                        <div class="mt-2 mb-4 flex">
                            <Avator :user="authUser.data.attributes.email" />

                            <div class="ml-2">
                                <div class="font-bold">{{ authUser.data.attributes.email }}</div>
                                <div>初めてのメッセージ</div>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-900 rounded mb-4">
                        <textarea class="w-full pt-4 pl-8 outline-none" placeholder="XXXXへのメッセージ"></textarea>
                        <div class="bg-gray-100 p-2">
                            <button class="bg-green-900 text-sm text-white font-bold py-1 px-2 rounded">送信</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import Search from '../components/icons/Search';
import Star from '../components/icons/Star';
import Cog from '../components/icons/Cog';
import Call from '../components/icons/Call';
import Information from '../components/icons/Information';
import AtSymbol from '../components/icons/AtSymbol';
import Avator from '../components/Avator';
import Sidebar from '../components/Sidebar';
import { mapGetters } from 'vuex';

export default {
    name: "Home",

    components: {
        Search,
        Star,
        Cog,
        Call,
        Information,
        AtSymbol,
        Avator,
        Sidebar
    },

    data() {
        return {
            user: '',
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
        logOut() {
            axios.post('/logout', {})
                .finally(err => {
                    window.location = '/login';
                })
        }
    }
}
</script>