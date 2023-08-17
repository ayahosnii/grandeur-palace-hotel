import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import RoomComponent from './components/RoomComponent.vue';
import RoomFilters from './components/RoomFilters.vue';

const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('room-component', RoomComponent);
app.component('room-filters', RoomFilters);




app.mount('#app');
