import './bootstrap';
import { createApp } from 'vue';
import "../css/app.css";

const app = createApp({});

// Import and register the Dashboard component
import Dashboard from './Components/Dashboard.vue';
app.component('dashboard', Dashboard);
app.mount('#app');
