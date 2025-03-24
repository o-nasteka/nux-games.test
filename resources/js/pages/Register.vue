<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";

const form = ref({
    username: "",
    phone: "",
});

const errors = ref({}); // Додаємо обробку помилок
const loading = ref(false);
const accessUrl = ref(usePage().props.access_url || null);

const register = () => {
    loading.value = true;
    errors.value = {}; // Очистка помилок перед запитом

    router.post("/register", form.value, {
        onSuccess: (page) => {
            accessUrl.value = page.props.access_url;
            form.value.username = "";
            form.value.phone = "";
        },
        onError: (err) => {
            errors.value = err;
        },
        onFinish: () => {
            loading.value = false;
        },
    });
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-xl font-bold mb-4">Register</h2>
            <form @submit.prevent="register">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input v-model="form.username" type="text"
                           class="w-full px-3 py-2 border rounded-lg"
                           :class="{ 'border-red-500': errors.username }"
                           required />
                    <p v-if="errors.username" class="text-red-500 text-sm">{{ errors.username }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input v-model="form.phone" type="tel"
                           class="w-full px-3 py-2 border rounded-lg"
                           :class="{ 'border-red-500': errors.phone }"
                           required />
                    <p v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone }}</p>
                </div>
                <button type="submit"
                        class="w-full bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 disabled:opacity-50"
                        :disabled="loading">
                    {{ loading ? "Registering..." : "Register" }}
                </button>
            </form>
            <div v-if="accessUrl" class="mt-4 p-4 bg-green-100 border border-green-400 rounded">
                <p>Ваш унікальний лінк:</p>
                <a :href="accessUrl" class="text-blue-500 underline">{{ accessUrl }}</a>
            </div>
        </div>
    </div>
</template>
