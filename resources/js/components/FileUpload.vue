<template>
    <div class="content">
        <img v-show="uploadedImage" :src="uploadedImage" class="upload-image" />
        <p><input type="file" v-on:change="fileSelected"></p>
    </div>
</template>

<script>

export default {
    name: "FileUpload",

    data() {
        return {
            showUserImage: false,
            file_path: '',
            uploadedImage: '',
        }
    },

    methods:{
        fileSelected(event) {
            let files = event.target.files[0];
            this.$emit('updateFileInfo', files);
            this.createImage(files);
        },
        // アップロードした画像を表示
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.uploadedImage = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    },
};
</script>

<style scoped>
    .upload-image {
        max-width: 100px;
        max-height: 100px;
    }
</style>