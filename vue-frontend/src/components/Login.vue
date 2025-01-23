<template>
    <div>
        <h1>Login</h1>
        <button @click="loginWith('twitter')">Login com Twitter</button>
    </div>
</template>

<script>
export default {
    methods: {
        loginWith(provider) {
            this.$store.dispatch('loginWithProvider', provider);
        },
    },
};
</script>
