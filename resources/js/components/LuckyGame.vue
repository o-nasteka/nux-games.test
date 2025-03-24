<script setup>
import { defineProps, ref } from "vue";
import axios from "axios";
import { getTokenFromUrl } from "@/utils/token";

const props = defineProps(["access_url"]);
const result = ref(null);
const loading = ref(false);

const playGame = async () => {
    const token = getTokenFromUrl(props.access_url);
    if (!token) return;

    loading.value = true;

    try {
        const response = await axios.post("/lucky-game", { token });
        result.value = response.data.result;
    } catch (error) {
        console.error("Game error:", error.response?.data || error);
    } finally {
        loading.value = false;
    }
};
</script>


<template>
    <div class="text-center">
        <button
            :disabled="loading"
            @click="playGame"
            class="w-full bg-purple-500 text-white px-3 py-2 rounded-lg hover:bg-purple-600 disabled:opacity-50"
        >
            {{ loading ? "Loading..." : "ImFeelingLucky" }}
        </button>

        <div v-if="result" class="mt-2 p-3 bg-gray-100 rounded-lg border">
            <p>Random Number: <strong>{{ result.number }}</strong></p>
            <p class="text-lg" :class="result.isWin ? 'text-green-600' : 'text-red-600'">
                {{ result.isWin ? "Win 🎉" : "Lose ❌" }}
            </p>
            <p v-if="result.isWin">Winnings: <strong>{{ Number(result.winAmount).toFixed(2) }}</strong></p>
        </div>
    </div>
</template>
