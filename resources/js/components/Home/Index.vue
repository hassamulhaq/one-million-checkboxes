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

const changeState = (attrObj) => {
    const {id, checked} = attrObj;
    items[id - 1].checked = checked;
    recycleKey.value = Date.now();
}

onMounted(() => {
    console.log({ items });
});

const channelCheckboxes = Echo.private('checkboxes');

channelCheckboxes.listenForWhisper('state', (e) => {
    changeState({"id": e.id, "checked": e.checked});
});

const toggleCheckbox = (id, checked) => {
    channelCheckboxes.whisper('state', {id, checked});
    changeState({id, checked});
}

</script>

<template>
    <Header/>
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
               <input type="checkbox" :checked="item.checked" :data-id="item.id" class="size-6" @change="toggleCheckbox(item.id, $event.target.checked)">
            </div>
        </RecycleScroller>
    </div>
</template>


<style scoped>
    .scroller {
      height: 100%;
    }
</style>
