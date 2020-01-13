<template>
    <div>
        <h1>ກໍາລັງອອກຈາກລະບົບ...</h1>
    </div>
</template>
<script>
export default {
    created() {
        this.logout();
    },
    methods: {
        logout() {
            localStorage.setItem('admin', '');
            setTimeout(() => {
                this.$router.push({ name: 'home' });
            }, 1000);
        }
    }
}
</script>
