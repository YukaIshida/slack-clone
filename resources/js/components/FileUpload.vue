<template>
    <div class="content">
        <p><input type="file" v-on:change="fileSelected"></p>
        <button @click="fileUpload">アップロード</button>
        <p v-show="showUserImage"><img :src="file_path"></p>
    </div>
</template>

<script>

export default {
    name: "FileUpload",

    data() {
        return {
            showUserImage: false,
            file_path: ''
        }
    },

    methods:{
        fileSelected(event) {
            this.$emit('updateFileInfo', event.target.files[0]);
        },
        fileUpload() {
            // ToDo Message.vueに移動
            const formData = new FormData();
            formData.append('file', this.fileInfo);

            axios.post('/api/fileupload', formData)
                .then(response => {
                    this.showUserImage = true;
                    this.file_path = response.data.file_path;
                })
                .catch(error => {
                    console.log("Unable to upload file");
                });
        }
    },
};
</script>

<style>

</style>