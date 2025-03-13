<script setup>
import {onMounted, ref} from 'vue';
import Header from '../Header.vue';
import { RecycleScroller } from 'vue-virtual-scroller';
import BitSte from 'bitset';
import { useElementBounding } from "@vueuse/core";

const props = defineProps({
    state: String,
    count: Number
});

const scroller = ref(null);
const bitset = new BitSte;
const gridItems = ref(32);
const itemSize = ref(1216.02 / gridItems.value);
const recycleKey = ref(Date.now());
const checkedCount = ref(props.count);
const goToCheckboxval = ref(null);

const stateLength = props.state.length || 0;
for (let i = 0; i < stateLength; i++) {
    bitset.set(i, Number(props.state.charAt(i)));
}

const items = [...Array(1_000_000).keys()].map((i) => {
    return {
        id: i + 1,
        checked: bitset.get(i + 1)
    }
});

const changeState = (attrObj) => {
    const {id, checked} = attrObj;
    items[id - 1].checked = checked;
    recycleKey.value = Date.now();

    checkedCount.value += checked ? 1 : -1;
}

onMounted(() => {
    console.log('props.state: ', JSON.stringify(props.state));
    console.log('props.count: ', JSON.stringify(props.count));
});

const channelCheckboxes = Echo.private('checkboxes');

channelCheckboxes.listenForWhisper('state', (e) => {
    changeState({"id": e.id, "checked": e.checked});
});

const toggleCheckbox = (id, checked) => {
    channelCheckboxes.whisper('state', {id, checked});
    changeState({id, checked});
}

const resizeRecycleScroller = () => {
    const {width} = useElementBounding(scroller);

    gridItems.value = Math.floor(width.value / itemSize.value);
    console.log(gridItems.value)
}
resizeRecycleScroller();

const navigateToCheckbox = () => {
    scroller.value.scrollToItem(goToCheckboxval.value || 1);
}

</script>

<template>
    <Header/>
    <div class="flex flex-1 justify-around md:justify-end items-center">
        <div class="mr-1 md:mr-4 py-1 px-1 bg-amber-200" style="line-height: 16px;">count: {{ checkedCount }}</div>
        <div class="flex gap-1 bg-amber-200 py-1 px-2">
            <div class="flex items-center">
                <span class="pr-1">Go to:</span>
                <form @submit.prevent="navigateToCheckbox">
                    <input type="number"
                           class="ring-1 ring-amber-700 rounded-xs"
                           min="0"
                           max="1000000"
                           maxlength="1000000" v-model="goToCheckboxval">
                    <button type="submit" class="px-2 py-0.5 bg-amber-400 hover:bg-amber-500 cursor-pointer rounded-xs">Go</button>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-orange-300 p-2 shadow">
        <RecycleScroller
            ref="scroller"
            class="scroller w-full flex-grow overflow-y-auto overflow-x-auto min-h-10/12 max-h-[680px]"
            :items="items"
            :item-size="itemSize"
            key-field="id"
            v-slot="{ item }"
            :grid-items="gridItems"
            @resize="resizeRecycleScroller">
            <div class="single-checkbox-wrapper" :key="recycleKey">
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
