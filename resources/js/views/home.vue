<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar />

        <div class="flex flex-col flex-grow bg-gray-100">
            <Header />
            <main class="overflow-y-scroll flex-grow">
                <div class="flex flex-col ml-6 h-full">
                    <div class="flex-grow overflow-y-scroll">
                        <div class="mt-2 mb-4 flex">
                            <Avator :userEmail="authUser.data.attributes.email" />

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
import Avator from '../components/Avator';
import Sidebar from '../components/Sidebar';
import Header from '../components/Header';
import { mapGetters } from 'vuex';
export default {
    name: "Home",

    components: {
        Avator,
        Sidebar,
        Header
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

    }
}
</script>