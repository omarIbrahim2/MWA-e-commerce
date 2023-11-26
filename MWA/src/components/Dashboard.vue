<script setup>
import {ref} from 'vue'
</script>

<template>
 <div>
     <h2> Vue 3 setup with laravel 10 and vite - WebJourney {{count}} </h2>
 </div>
</template>

<script>
const count = ref(0)
export default {
    name: "Dashboard.vue"
}
</script>

<style scoped>

</style>