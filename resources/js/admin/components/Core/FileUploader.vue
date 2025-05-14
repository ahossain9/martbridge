<template>
    <div class="row d-flex justify-content-between">
        <label class="form-label"> {{ props.label }}</label>
        <div class="col-md-12 col-12 mb-1">
            <input
                type="file"
                name="image"
                accept="image/*"
                @change="handleUpload"
                ref="input"
                multiple />
        </div>
        <div v-for="(image, index) in files" :key="index" class="">
            <div class="d-flex justify-content-between mb-1">
                <img :src="image.preview" class="" alt="Image" width="100">
                <div class="card-body">
                    <!--                <h5 class="card-title">{{ image.name }}</h5>-->
                    <span @click="removeFile(index)" class="btn-sm btn-danger cursor-pointer">
                        X
                    </span>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import {ref} from "vue";

const files = ref(null)
const uploading = ref(false)
const file = ref(null)

const props = defineProps({
    images: {
        type: Array,
        default: () => []
    },
    label: {
        type: String,
        default: 'Upload Image'
    },
    itemIndex: {
        type: Number,
        required: false
    },
});

// define emits
const emit = defineEmits(['upload-finished'])

const handleUpload = (event) => {
    let image = event.target.files[0]
    // check the input file is image or not and check the file size is not more than 2MB
    if (!image.type.startsWith('image')) {
        alert('Please select image files।')
    } else if (image.size > 1024 * 1024) {
        alert('Image size should not be more than 1 MB।')
    } else {
        files.value = Array.from(event.target.files)
        for (let file of files.value) {
            file.preview = URL.createObjectURL(file)
        }
        file.value = event.target.files[0]

        emit('upload-finished', file.value, props.itemIndex)
    }
}

const removeFile = (index) => {
    files.value.splice(index, 1)
    emit('upload-finished', file.value, props.itemIndex)
}
</script>

<style>

.card-image-container {
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-image {
    max-width: 100%;
    max-height: 100%;
}

.drop-zone {
    width: 100%;
    height: 200px;
    border: 2px dashed #ccc;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.drop-zone:hover {
    border-color: #5cb85c;
    background-color: #f3f3fc;
}

.dragging {
    border-color: #5cb85c;
    background-color: #e3e2f4;
}

.prev-image-container {
    width: 300px;
    height: 130px;
    overflow: hidden;
}

.prev-image-container >img {
    width: 45%;
    height: 100%;
    object-fit: cover;
}

.form-image-container {
    width: 600px;
    height: 200px;
    overflow: hidden;
}

.form-image-container > img {
    width: 34%;
    object-fit: cover;
}

</style>
