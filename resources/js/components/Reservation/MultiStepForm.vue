<template>
    <div class="w-6/12">
        <ul class="steps min-w-full">
            <li v-for="(stepText,index) in props.steps" class="step" :class="index<=step ? 'step-primary' : ''">
                {{stepText}}
            </li>
        </ul>
    </div>
</template>
<script lang="ts" setup>
import {ref} from "vue"

let step = ref(0);
const props = defineProps<{
    steps:string[],
}>()
</script>
