import './bootstrap';

import { createApp, h } from 'vue';
import HomeIndex from './components/Home/Index.vue';

const app = createApp({
    render: () => h(HomeIndex)
});
app.mount("#app");
