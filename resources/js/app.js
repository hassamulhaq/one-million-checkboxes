import './bootstrap';

import { createApp, h } from 'vue';
import HomeIndex from './components/Home/Index.vue';
import VueVirtualScroller from 'vue-virtual-scroller';
import 'vue-virtual-scroller/dist/vue-virtual-scroller.css';

const appElement = document.getElementById("app");
const props = JSON.parse(appElement.dataset.props);


const app = createApp(HomeIndex, { ...props });

app.use(VueVirtualScroller);
// app.component('HomeIndex', HomeIndex);
app.mount("#app");
