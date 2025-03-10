<script setup>
import { onMounted } from 'vue';
import Header from '../Header.vue';

onMounted(() => {
    console.log('loaded.');
});
</script>

<template>
    <Header />
    
    <div class="my-2">
        ...
    </div>
</template>