<template>
    <div class="z-10 fixed top-0 left-0 h-full w-full flex items-center justify-center" 
        style="background-color:rgba(0, 0, 0, 0)"
        v-show="sideModal"
        @click="closeSideModal"
    >
        <div class="fixed w-36 h-24 rounded bg-white text-black top-40 left-36 py-2" @click.stop>
            <router-link to="/channel-search" class="block py-2 hover:bg-blue-700 hover:text-white text-center">チャンネル一覧</router-link>
            <div class="py-2 hover:bg-blue-700 hover:text-white text-center" @click="showChannelModal">チャンネル作成</div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "sideModal",

    computed: {
        ...mapGetters({
            sideModal: 'sideModal'
        })
    },

    methods: {
        closeSideModal() {
            this.$store.dispatch('updateSideModalAction', false);
        },
        showChannelModal() {
            this.$store.dispatch('updateChannelModalAction', true);
            this.$store.dispatch('updateSideModalAction', false);
        },
    },

}
</script>