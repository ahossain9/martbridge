<template>
    <div class="d-flex justify-content-center my-1">
        <div class="text-center" :class="class">
            <div class="spinner-grow" style="width: 2rem; height: 2rem" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>{{ text }}</p>
        </div>
    </div>
</template>

<script setup>

const {text, class:className } = defineProps({
    text: {
        type: String,
        default: 'Please Wait....'
    },
    class: {
        type: String,
        default: 'text-primary'
    }
});

</script>
