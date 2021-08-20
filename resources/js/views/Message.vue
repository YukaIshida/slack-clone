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
</template>

<script>
import Avator from '../components/Avator';
import Header from '../components/Header';
import { mapGetters } from 'vuex';

export default {
    name: "Message",

    components: {
        Avator,
        Header
    },

    computed: {
        ...mapGetters({
            messages: 'messages',
            placeholder: 'placeholder',
        })
    },

    data() {
        return {
            // ToDo messageとerrorsだけここに残して残りはVuexに移動
            message: '',
            errors: '',
        }
    },


    methods: {
        sendMessage() {
            this.$store.dispatch('sendMessage', this.message);
            this.message = "";
        },
    },

}
</script>