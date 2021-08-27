<template>
    <div class="content">
        <p><input type="file" v-on:change="fileSelected"></p>
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
        }
    },
};
</script>

<style>

</style>