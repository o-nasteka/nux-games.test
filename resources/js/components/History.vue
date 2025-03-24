<script setup>
import { defineProps, ref } from "vue";
import axios from "axios";
import { getTokenFromUrl } from "@/utils/token";

const props = defineProps(["access_url"]);
const localHistory = ref([]);

const loadHistory = async () => {

    const token = getTokenFromUrl(props.access_url);
    if (!token) {
        return;
    }

    try {
        const response = await axios.get(`/lucky-game/history/${token}`);
        localHistory.value = (response.data.history ?? []).map(item => ({
            number: item.number,
            isWin: Boolean(item.is_win),
            winAmount: item.win_amount
        }));
    } catch (error) {
        console.error("Failed to load history:", error);
    }
};
</script>

<template>
    <div class="mt-4">
        <h3 class="text-lg font-semibold">History</h3>

        <button
            class="bg-gray-300 px-4 py-2 rounded mt-2"
            @click="loadHistory"
        >
            Load History
        </button>

        <ul v-if="localHistory.length > 0" class="list-disc pl-4 mt-2">
            <li v-for="(item, index) in localHistory" :key="index">
                Number: <strong>{{ item.number }}</strong> -
                <span :class="item.isWin ? 'text-green-600' : 'text-red-600'">
                    {{ item.isWin ? "Win 🎉" : "Lose ❌" }}
                </span>
                <span v-if="item.isWin"> - Winnings: <strong>{{ Number(item.winAmount).toFixed(2) }}</strong></span>
            </li>

        </ul>
        <p v-else class="text-gray-500">No history yet.</p>
    </div>
</template>
