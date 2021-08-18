<template>
    <div class="w-1/5 bg-gray-800 text-white pt-3 px-4">
        <div class="flex justify-between items-center">
            <h1 class="font-semibold text-xl leading-tight">Slack Clone</h1>
            <Notification />
        </div>

        <div class="flex items-center">
            <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
            {{ authUser.data.attributes.email }}
        </div>

        <div class="mt-5 flex justify-between items-center">
            <div class="font-bold opacity-50 text-lg">チャンネル</div>
            <PlusCircle />
        </div>
        <div
            class="opacity-50 mt-1"
            v-for="channel in channels"
            :key="channel.id"
        ># {{ channel.channel_name }}</div>

        <div class="mt-5 flex justify-between items-center">
            <div class="font-bold opacity-50 text-lg">ダイレクトメッセージ</div>
            <PlusCircle />
        </div>
        <div class="mt-2 flex items-center" v-for="user in users" :key="user.user_id">
            <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
            <span class="opacity-50">{{ user.email }}</span>
        </div>
    </div>
</template>

<script>
import Notification from '../components/icons/Notification';
import PlusCircle from '../components/icons/PlusCircle';
import { mapGetters } from 'vuex';

export default {
    name: "Sidebar",

    components: {
        Notification,
        PlusCircle,
    },


    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },

    data() {
        return {
            users: [
                {
                    user_id: 11,
                    email: "john@example.com"
                },
                {
                    user_id: 12,
                    email: "kevin@test.com"
                },
                {
                    user_id: 13,
                    email: "susan@test.com"
                },
            ],
            channels: [
                {
                    id: 1,
                    channel_name: '営業'
                },
                {
                    id: 2,
                    channel_name: 'マーケティング'
                },
                {
                    id: 3,
                    channel_name: '情シス'
                },
            ]
        }
    },
}
</script>