import { createApp } from 'vue';
import CategoryManager from './components/CategoryManager.vue';

const app = createApp({});
app.component('category-manager', CategoryManager);
app.mount('#category-manager-app');
