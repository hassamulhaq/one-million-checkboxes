<script setup>
import {onMounted, ref} from 'vue';
import Header from '../Header.vue';
import { RecycleScroller } from 'vue-virtual-scroller';

const items = [...Array(1_000_000).keys()].map((i) => {
    return {
        id: i + 1,
        checked: false
    }
});

const gridItems = ref(32);
const itemSize = ref(1216.02 / gridItems.value);
const recycleKey = ref(Date.now());

const changeState = (id, isChecked) => {
    items[id - 1].checked = isChecked;
    recycleKey.value = Date.now();
}

onMounted(() => {
    console.log({ items });
});
</script>

<template>
    <Header/>
    <button type="button" class="bg-amber-600 hover:bg-amber-700 p-0.5 w-[90px]" @click="changeState(1, true)">click 1st checked</button>
    <div class="bg-orange-300 p-2 shadow">
        <RecycleScroller
            class="scroller w-full flex-grow overflow-y-auto overflow-x-auto min-h-10/12 max-h-[680px]"
            :items="items"
            :item-size="itemSize"
            key-field="id"
            v-slot="{ item }"
            :grid-items="gridItems"
            :key="recycleKey"
        >
            <div class="single-checkbox-wrapper">
               <input type="checkbox" :checked="item.checked" :data-id="item.id" class="size-6">
            </div>
        </RecycleScroller>
    </div>
</template>


<style scoped>
    .scroller {
      height: 100%;
    }
</style>
