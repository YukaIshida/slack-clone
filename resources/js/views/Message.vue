<template>
    <div class="flex flex-col flex-grow bg-gray-100 overflow-y-scroll">
        <Header />
        <main class="overflow-y-scroll flex-grow">
            <div class="flex flex-col ml-6 h-full">
                <div class="flex-grow overflow-y-scroll">
                    <div class="mt-2 mb-4 flex" v-for="message in messages.data" :key="message.key">
                        <Avator :userEmail="message.data.attributes.user" />

                        <div class="ml-2">
                            <div><span class="font-bold">{{ message.data.attributes.user }}</span>&ensp;<span class="opacity-50 text-sm">{{ message.data.attributes.updated_at }}</span></div>
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

                    <div class="bg-gray-100 p-2 flex justify-between">
                        <button 
                            class="bg-green-900 text-sm text-white font-bold py-1 px-2 rounded"
                            @click="sendMessage"
                            >送信
                        </button>
                        <FileUpload @updateFileInfo="getFileInfo($event)" />
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import Avator from '../components/Avator';
import Header from '../components/Header';
import FileUpload from '../components/FileUpload';
import { mapGetters } from 'vuex';

export default {
    name: "Message",

    components: {
        Avator,
        Header,
        FileUpload
    },

    mounted() {
        Echo.channel('chat')
            .listen('MessageCreated', (e) => {
                if (e.message.channel_id == this.channel_id) {
                    this.$store.dispatch('fetchMessages');
                }
            });
    },

    computed: {
        ...mapGetters({
            messages: 'messages',
            placeholder: 'placeholder',
            channel_id: 'channel_id',
            authUser: 'authUser',
        })
    },

    data() {
        return {
            // ToDo messageとerrorsだけここに残して残りはVuexに移動
            message: '',
            errors: '',
            fileInfo: ''
        }
    },

    methods: {
        sendMessage() {
            let formData = new FormData();
            formData.append('channel_id', this.channel_id);
            formData.append('user', this.authUser.data.attributes.email);
            formData.append('content', this.message);
            formData.append('file', this.fileInfo);
            
            axios.post('/api/messages', formData)
                .then(response => {
                    // pusherでデータベースの更新を検知して、Message.vueがメッセージを更新するためここでの処理は不要
                })
                .catch(errors => {
                });
                this.message = "";
        },
        getFileInfo: function($event)  {
            this.fileInfo = $event;
        },
    },

}
</script>