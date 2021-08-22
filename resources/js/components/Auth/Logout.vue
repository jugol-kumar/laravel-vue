<template>
</template>

<script>
export default {
    name: "Logout",
    created() {
        let _token = localStorage.getItem('_token');
        axios.post('api/auth/logout?token='+_token).then(res =>{
            localStorage.removeItem('_token')
            localStorage.removeItem('_user')
            Toast.fire({
                icon:'success',
                title: res.data.message
            })
            this.$router.push({name:'Login'})
        }).catch(e => {
            Toast.fire({
                icon:'warning',
                title: e.response.statusText
            })
        })
    }
}
</script>

<style scoped>

</style>
