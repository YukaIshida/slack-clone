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
            <div class="z-10 fixed top-0 left-0 h-full w-full flex items-center justify-center" 
                style="background-color:rgba(0, 0, 0, 0)"
                v-show="sideModal"
                @click="closeSideModal"
            >
                <div class="fixed w-36 h-24 rounded bg-white text-black top-40 left-36 py-2">
                    <div class="py-2 hover:bg-blue-700 hover:text-white text-center">チャンネル一覧</div>
                    <div class="py-2 hover:bg-blue-700 hover:text-white text-center" @click="showChannelModal">チャンネル作成</div>
                </div>
            </div>
            <AddChannelModal :channelModal="parentChannelModal" @closeModal="closeChannelModal" @parentGetchannels="getchannels" />
            <PlusCircle @click.native="showSideModal" />
        </div>
        <div
            class="opacity-50 mt-1"
            v-for="channel in channels"
            :key="channel.data.channel_id"
        >
            <span @click="channelMessage(channel)"># {{ channel.data.attributes.channel_name }}</span>
        </div>

        <div class="mt-5 flex justify-between items-center">
            <div class="font-bold opacity-50 text-lg">ダイレクトメッセージ</div>
            <PlusCircle />
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
        this.getUsers();
    },

    computed: {
        ...mapGetters({
            authUser: 'authUser',
        })
    },

    methods: {
        directMessage(user) {
            this.$emit("updateChannelInfoDm", user);
        },
        channelMessage(channel) {
            this.$emit("updateChannelInfo", channel);
        },
        showChannelModal() {
            this.parentChannelModal = true;
        },
        showSideModal() {
            this.sideModal = true;
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
        getUsers() {
            axios.get('/api/users')
                .then(response => {
                    this.users = response.data.data;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        },
        closeChannelModal() {
            this.parentChannelModal = false;
        },
        closeSideModal() {
            this.sideModal = false;
        }
    },

    data() {
        return {
            users: [],
            channels: [],
            errors: '',
            parentChannelModal: false,
            sideModal: false,
        }
    },
}
</script>