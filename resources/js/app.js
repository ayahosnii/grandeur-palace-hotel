import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import RoomComponent from './components/RoomComponent.vue';
import RoomFilters from './components/RoomFilters.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('room-component', RoomComponent);
app.component('room-filters', RoomFilters);
app.component('VueDatePicker', VueDatePicker);




app.mount('#app');
