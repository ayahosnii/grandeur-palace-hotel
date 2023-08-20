import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import RoomComponent from './components/RoomComponent.vue';
import RoomFilters from './components/RoomFilters.vue';
import Main from './App.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

import VueDatepickerUi from 'vue-datepicker-ui'
import 'vue-datepicker-ui/lib/vuedatepickerui.css';

import VCalendar from 'v-calendar';
import 'v-calendar/style.css';



import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';


import { plugin as formKitPlugin, defaultConfig } from '@formkit/vue'
import { createMultiStepPlugin } from '@formkit/addons'
import '@formkit/themes/genesis'
import '@formkit/addons/css/multistep'

createApp(Main)
    .use(formKitPlugin, defaultConfig({
        plugins: [createMultiStepPlugin()]
    }))

const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('main-component', Main);
app.component('room-component', RoomComponent);
app.component('room-filters', RoomFilters);
app.component('VueDatePicker', VueDatePicker);
app.component('Datepicker', VueDatepickerUi)
app.component('VCalendar', VCalendar)

app.use(LoadingPlugin);
app.use(VCalendar, {})




app.mount('#app');
