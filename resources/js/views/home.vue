<template>
    <div class="flex h-screen" v-if="authUser">
        <Sidebar @updateChannelName="updateMyChannelInfo($event)" />

        <div class="flex flex-col flex-grow bg-gray-100">
            <Header />
            <main class="overflow-y-scroll flex-grow">
                <div class="flex flex-col ml-6 h-full">
                    <div class="flex-grow overflow-y-scroll">
                        <div class="mt-2 mb-4 flex" v-for="message in messages.data" :key="message.key">
                            <Avator :userEmail="message.data.attributes.user" />

                            <div class="ml-2">
                                <div class="font-bold">{{ message.data.attributes.user }}</div>
                                <div>{{ message.data.attributes.content }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-900 rounded mb-4">
                        <textarea 
                            class="w-full pt-4 pl-8 outline-none" 
                            :placeholder="placeholder" 
                            v-model="message">
                        </textarea>

                        <div class="bg-gray-100 p-2">
                            <button 
                                class="bg-green-900 text-sm text-white font-bold py-1 px-2 rounded"
                                @click="sendMessage"
                                >送信
                            </button>
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
            channel_name: '',
            message: '',
            messages: [],
            placeholder: '',
            channel_id: '',
            errors: '',
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
        updateMyChannelInfo: function($event) {
            var self = this;
            self.messages = [];
            this.authUser.data.user_id > $event.user_id
            ? (this.channel_id = this.authUser.data.user_id + "-" + $event.user_id)
            : (this.channel_id = $event.user_id + "-" + this.authUser.data.user_id);

            self.channel_name = $event.email;
            self.placeholder = $event.email + "へのメッセージ";
            this.getMessages(this.channel_id);
        },
        sendMessage() {
            let submitArray = {};
            submitArray['channel_id'] = this.channel_id;
            submitArray['user'] = this.authUser.data.attributes.email;
            submitArray['content'] = this.message;
            
            axios.post('/api/messages', submitArray)
                .then(response => {
                    alert("保存しました");
                    console.log(response.data);
                    // this.messages.data.unshift(response.data);
                    this.message = "";
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        },
        getMessages: function(channel_id) {
            axios.get('/api/messages?channel_id=' + channel_id)
                .then(response => {
                    this.messages = response.data;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    }
}
</script>