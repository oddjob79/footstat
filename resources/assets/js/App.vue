<template>
    <div id="app">
        <cmp-navbar></cmp-navbar>
        <div class="container">
            <router-view />
        </div>
    </div>
</template>

<script>
    import Navbar from './components/partials/Navbar'
    export default {
        name: "app",
        components: {
            'cmp-navbar':Navbar
        }
    }
</script>

<style scoped>

</style>
