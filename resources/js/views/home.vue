<template>
    <div>
         <button class="py-1 px-4 bg-gray-800 text-white rounded" @click="logOut">ログアウト</button>
    </div>
</template>

<script>

export default {
    name: "Home",
    methods: {
        logOut() {
            axios.post('/logout', {})
                .finally(err => {
                    window.location = '/login';
                })
        }
    }
}
</script>