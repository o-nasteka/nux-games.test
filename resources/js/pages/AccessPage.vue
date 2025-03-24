<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <main class="flex-1 p-6">
            <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
                <!-- User Info -->
                <UserInfo :username="username" :phone="phone" />

                <!-- Access Controls (Generate / Deactivate link) -->
                <AccessActions :access_url="access_url" />

                <!-- Lucky Game -->
                <LuckyGame :access_url="access_url" />

                <!-- History -->
                <History :access_url="access_url" />
            </div>
        </main>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import UserInfo from "@/components/UserInfo.vue";
import AccessActions from "@/components/AccessActions.vue";
import LuckyGame from "@/components/LuckyGame.vue";
import History from "@/components/History.vue";

const props = defineProps(["username", "phone", "access_url"]);
</script>
