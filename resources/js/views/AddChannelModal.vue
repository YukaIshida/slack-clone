<template>
    <div class="z-10 fixed top-0 left-0 h-full w-full flex items-center justify-center" 
        style="background-color:rgba(0, 0, 0, 0.5)"
        v-show="addChannelModal"
        @click="closeChannelModal"
    >
        <div class="z-20 bg-white text-gray-900 w-1/3 rounded-md" @click.stop>
            <div class="flex flex-col p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl font-black leading-loose">チャンネルを作成する</h2> 
                    <span class="text-4xl" @click="closeChannelModal">x</span>                    
                </div>
                <p>チャンネルはチームがコニュニケーションを取る場所です。特定のトピックに基づいてチャンネルを作ると良いでしょう。(例: #マーケティング)</p>
                <div class="mt-8 font-semibold">名前</div>
                <div class="my-3">
                    <input 
                        type="text" 
                        class="w-full rounded border-gray-900 border-solid border p-3"
                        v-model="channel"
                    >
                </div>
                <div class="flex justify-end">
                    <button 
                    class="px-8 py-2 rounded bg-green-900 font-bold text-white"
                    @click="addChannel"
                    >作成</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: "channelModal",

    computed: {
        ...mapGetters({
            addChannelModal: 'addChannelModal',
        })
    },

    methods: {
        closeChannelModal() {
            this.$store.dispatch('updateChannelModalAction', false);
        },
        addChannel() {
            let submitArray = {};
            submitArray['channel_name'] = this.channel;
            
            axios.post('/api/channels', submitArray)
                .then(response => {
                    this.$store.dispatch('updateChannelModalAction', false);
                    this.$emit("parentGetchannels");
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        },
    },

    data() {
        return {
            channel: '',
        }
    }

}
</script>