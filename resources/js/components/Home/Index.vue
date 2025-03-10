<script setup>
import { onMounted } from 'vue';
import Header from '../Header.vue';
import { RecycleScroller } from 'vue-virtual-scroller';

const items = [...Array(1000000).keys()].map((i) => {
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
    <div>
        <Header />
        <RecycleScroller 
            class="scroller" 
            :items="items" 
            :item-size="30" 
            key-field="id" 
            :renderers="1000" 
            v-slot="{ item }">
            <div class="single-checkbox-wrapper">
                {{ item.id }} - {{ item.checked }}
            </div>
        </RecycleScroller>
    </div>
</template>


<style scoped>
.scroller {
  height: 100%;
}
</style>
