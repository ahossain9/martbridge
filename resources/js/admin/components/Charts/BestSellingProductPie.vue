<template>
    <div>
        <h3 class="mt-2">Best Selling Products</h3>
        <Pie v-if="chartData" :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from 'chart.js'
import axiosClient from "../../../axios";
// Register Chart.js components
ChartJS.register(Title, Tooltip, Legend, ArcElement)

const chartData = ref(null)
const chartOptions = ref({
    responsive: true,
    plugins: {
        legend: {
            position: 'bottom',
            display: false,
        },
        title: {
            display: true,
            text: 'Top Sales'
        }
    },
})

onMounted(async () => {
    try {
        const response = await axiosClient.get('top-selling-items') // Your API endpoint
        const { labels, data } = response.data.data

        chartData.value = {
            labels: labels,
            datasets: [
                {
                    label: 'Total Sales',
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#C9CBCF', '#FF6384', '#36A2EB', '#FFCE56'
                    ],
                    data: data,
                },

            ],
        }
    } catch (error) {
        console.error('Failed to fetch top products:', error)
    }
})
</script>
