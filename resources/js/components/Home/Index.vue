<script setup>
import { onMounted } from 'vue';
import Header from '../Header.vue';
import { RecycleScroller } from 'vue-virtual-scroller';

const items = [...Array(1_000_000).keys()].map((i) => {
    return {
        id: i + 1,
        checked: false
    }
});

onMounted(() => {
    console.log({ items });
});
</script>

<template>
    <Header/>
    <div class="bg-orange-300 p-2 h-10/12">
        <RecycleScroller
            class="scroller"
            :items="items"
            :item-size="30"
            key-field="id"
            v-slot="{ item }">
            <div class="single-checkbox-wrapper">
                {{ item }}
            </div>
        </RecycleScroller>
    </div>
</template>


<style scoped>
    .scroller {
      height: 100%;
    }
</style>
