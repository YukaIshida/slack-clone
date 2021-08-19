<template>
    <div class="w-1/5 bg-gray-800 text-white pt-3 px-4 overflow-hidden">
        <div class="flex justify-between items-start">
            <h1 class="font-semibold text-xl leading-tight">Slack Clone</h1>
            <Notification />
        </div>

        <div class="flex items-center">
            <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
            {{ authUser.data.attributes.email }}
        </div>

        <div class="mt-5 flex justify-between items-center">
            <div class="font-bold opacity-50 text-lg">チャンネル</div>
            <!-- modal -->
            <AddChannelModal :channelModal="parentChannelModal" @closeModal="closeChannelModal" />
            <PlusCircle @click.native="showChannelModal" />
        </div>
        <div
            class="opacity-50 mt-1"
            v-for="channel in channels"
            :key="channel.data.channel_id"
        ># {{ channel.data.attributes.channel_name }}</div>

        <div class="mt-5 flex justify-between items-center">
            <div class="font-bold opacity-50 text-lg">ダイレクトメッセージ</div>
            <PlusCircle />
        </div>
        <div class="mt-2 flex items-center" v-for="user in users" :key="user.user_id">
            <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
            <span class="opacity-50" @click="directMessage(user)">{{ user.email }}</span>
        </div>
    </div>
</template>

<script>
import Notification from '../components/icons/Notification';
import PlusCircle from '../components/icons/PlusCircle';
import AddChannelModal from '../views/AddChannelModal';
import { mapGetters } from 'vuex';

export default {
    name: "Sidebar",

    components: {
        Notification,
        PlusCircle,
        AddChannelModal
    },

    mounted() {
        this.getchannels();
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },

    methods: {
        directMessage(user) {
            this.$emit("updateChannelName", user);
        },
        showChannelModal() {
            this.parentChannelModal = true;
        },
        getchannels() {
            axios.get('/api/channels')
                .then(response => {
                    this.channels = response.data.data;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        },
        closeChannelModal() {
            this.parentChannelModal = false;
        }
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
            channels: [],
            errors: '',
            parentChannelModal: false,
        }
    },
}
</script>