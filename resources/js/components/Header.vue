<template>
    <header class="border-b">
        <div class="flex justify-between m-3">
            <div>
                <div class="font-bold text-lg" v-if="channelName">#{{ channelName }}</div>
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
</template>

<script>
import Search from '../components/icons/Search';
import Star from '../components/icons/Star';
import Cog from '../components/icons/Cog';
import Call from '../components/icons/Call';
import Information from '../components/icons/Information';
import AtSymbol from '../components/icons/AtSymbol';
import { mapGetters } from 'vuex';

export default {
    name: "Header",

    components: {
        Search,
        Star,
        Cog,
        Call,
        Information,
        AtSymbol,
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
            channelName: 'channelName',
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