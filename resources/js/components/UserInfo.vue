<script setup>
import { defineProps } from "vue";

const props = defineProps(["username", "phone"]);
</script>

<template>
    <div class="text-center">
        <h2 class="text-xl font-bold">Welcome, {{ props.username }}</h2>
        <p class="text-gray-700">Phone: {{ props.phone }}</p>
    </div>
</template>
