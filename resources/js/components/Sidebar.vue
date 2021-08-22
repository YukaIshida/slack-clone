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
            <SideModal />
            <AddChannelModal @parentGetchannels="getchannels" />
            <PlusCircle @click.native="showSideModal" />
        </div>
        <div
            class="opacity-50 mt-1"
            v-for="channel in channels"
            :key="channel.data.channel_id"
        >
            <span @click="channelMessage(channel)"># {{ channel.data.attributes.channel_name }}</span>
        </div>

        <div class="mt-5 flex justify-between items-center relative">
            <div class="font-bold opacity-50 text-lg">ダイレクトメッセージ</div>
            <PlusCircle @click.native="openDmSearch" />
            <div class="absolute w-36 rounded bg-white text-black -top-10 left-16 py-2" @click.stop>
                <div class="text-sm hover:bg-blue-700 hover:text-white text-center">ダイレクトメッセージを開く</div>
            </div>
        </div>
        <div class="mt-2 flex items-center" v-for="user in users" :key="'user' + user.data.user_id">
            <span class="bg-yellow-400 rounded-full w-3 h-3 mr-2"></span>
            <span class="opacity-50" @click="directMessage(user)">{{ user.data.attributes.name }}</span>
            <span class="opacity-50" v-if="user.data.user_id == authUser.data.user_id">(自分)</span>
        </div>
    </div>
</template>

<script>
import Notification from '../components/icons/Notification';
import PlusCircle from '../components/icons/PlusCircle';
import AddChannelModal from '../views/AddChannelModal';
import SideModal from '../views/SideModal';
import { mapGetters } from 'vuex';

export default {
    name: "Sidebar",

    components: {
        Notification,
        PlusCircle,
        AddChannelModal,
        SideModal
    },

    mounted() {
        this.getchannels();
        this.getDms();
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
            addChannelModal: 'addChannelModal',
            sideModal: 'sideModal'
        })
    },

    methods: {
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
        channelMessage(channel) {
            this.$store.dispatch('setMessagesAction', []);

            this.$store.dispatch('setChannelNameAction', channel.data.attributes.channel_name);
            this.$store.dispatch('setPlaceholderAction', channel.data.attributes.channel_name + "へのメッセージ");
            this.$store.dispatch('setChannelIdAction', channel.data.channel_id);
            this.$store.dispatch('fetchMessages');
            if (this.$route.path != '/home') {
                this.$router.push('/home');
            }
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
        getDms() {
            axios.get('/api/dm-channels')
                .then(response => {
                    this.users = response.data;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        },
        showSideModal() {
            this.$store.dispatch('updateSideModalAction', true);
        },
        openDmSearch() {
            if (this.$route.path != '/dm-search') {
                this.$router.push('/dm-search');
            }
        }
    },

    data() {
        return {
            users: [],
            channels: [],
            errors: '',
        }
    },
}
</script>