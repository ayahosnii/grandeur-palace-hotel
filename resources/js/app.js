import './bootstrap';
import { createApp } from 'vue';
import { Modal } from '@kouts/vue-modal'
import '@kouts/vue-modal/dist/vue-modal.css'

import ExampleComponent from './components/ExampleComponent.vue';
import CalendarComponent from './components/CalendarComponent.vue';
import RoomComponent from './components/RoomComponent.vue';
import RoomDetailsComponent from "./components/RoomDetailsComponent.vue";
import RoomFilters from './components/RoomFilters.vue';
import FullCalendarComponent from './components/FullCalendarComponent.vue';
import SlidesComponent from "./components/SlidesComponent.vue";
import ReviewsComponent from "./components/ReviewsComponent.vue";
import ContactComponent from "./components/ContactComponent.vue";
import GalaryComponent from "./components/GalaryComponent.vue";
import VuePictureSwipe from 'vue3-picture-swipe';
import Main from './App.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

import VueNumberInput from '@chenfengyuan/vue-number-input';


import VueDatepickerUi from 'vue-datepicker-ui'
import 'vue-datepicker-ui/lib/vuedatepickerui.css';

import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';

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
app.component('home-component', HomeComponent);
app.component('main-component', Main);
app.component('room-component', RoomComponent);
app.component('room-details-component', RoomDetailsComponent);
app.component('room-filters', RoomFilters);
app.component('slides-component', SlidesComponent);
app.component('reviews-component', ReviewsComponent);
app.component('contact-component', ContactComponent);
app.component('galary-component', GalaryComponent);
app.component('calendar-component', CalendarComponent);
app.component('fullcalendar-component', FullCalendarComponent);
app.component('VueDatePicker', VueDatePicker);
app.component('Datepicker', VueDatepickerUi)
app.component('VCalendar', VCalendar)
app.component('vue-picture-swipe', VuePictureSwipe);

app.use(ToastPlugin);
//app.component('star-rating', VueStarRating.default);
app.component('Modal', Modal)
app.component(VueNumberInput.name, VueNumberInput);



app.use(LoadingPlugin);
app.use(VCalendar, {})

import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import HomeComponent from "./components/HomeComponent.vue";
const $toast = useToast();

let instance = $toast.success('You did it!');
instance.dismiss();
$toast.clear();


app.mount('#app');
