<template>
 <div>
   <h1>This is home components</h1>
 </div>
</template>

<script>
export default {
    name: "Dashboard",
    created() {
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }
    }
}
</script>

<style scoped>

</style>
