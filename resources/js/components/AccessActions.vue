<template>
    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Access Controls</h2>

        <div class="flex space-x-2">
            <!-- Generate New Link -->
            <button
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg"
                @click="generateNewLink"
            >
                Generate New Link
            </button>

            <!-- Deactivate Link -->
            <button
                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg"
                @click="deactivateLink"
            >
                Deactivate Link
            </button>
        </div>

        <!-- Display current access link -->
        <div v-if="accessUrl" class="mt-4 p-3 bg-green-100 border border-green-400 rounded-lg">
            <p class="text-green-700 font-semibold">Your Access Link:</p>
            <a :href="accessUrl" target="_blank" class="text-blue-600 hover:underline break-all">
                {{ accessUrl }}
            </a>
        </div>
    </div>
</template>

<script setup>
import { defineProps, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { getTokenFromUrl } from "@/utils/token";

const props = defineProps(["access_url"]);
const accessUrl = computed(() => props.access_url);

const generateNewLink = () => {
    const token = getTokenFromUrl(accessUrl.value);
    if (!token) return;

    router.patch(`/access/${token}`, {}, {
        onSuccess: (page) => {
            console.log("New link generated:", page.props.access_url);
        },
    });
};

const deactivateLink = () => {
    const token = getTokenFromUrl(accessUrl.value);
    if (!token) return;

    router.delete(`/access/${token}`, {}, {
        onSuccess: () => {
            console.log("Access link deactivated");
            router.visit("/");
        },
    });
};
</script>
