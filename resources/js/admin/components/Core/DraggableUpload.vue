<template>
    <div class="row d-flex justify-content-between">
        <label class="form-label"> {{ props.label }}</label>
        <div class="col-md-12 col-12 mb-1">
            <label
                ref="dropzone"
                @dragenter.prevent="handleDragEnter"
                @dragover.prevent="handleDragOver"
                @dragleave.prevent="handleDragLeave"
                @drop.prevent="handleDrop"
                class="d-flex justify-content-center align-items-center drop-zone"
                :class="{ 'dragging': dragging }"
                multiple=""
            >
                  <span class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 50px;" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <span class="font-medium text-gray-600">
                      Drop new logo to attach or
                      <span class="text-blue-600 text-decoration-underline">browse</span>
                    </span>
                  </span>
                <input type="file" name="file_upload" accept="image/*" class="visually-hidden" @change="handleUpload" ref="input" multiple>
            </label>
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

    <div class="d-flex justify-content-between">

    </div>

</template>

<script setup>
import {ref} from "vue";

const files = ref(null)
const images = ref(null)
const uploading = ref(false)
const dragging = ref(false)

const props = defineProps({
    images: {
        // type: Array,
        default: () => []
    },
    label: {
        type: String,
        default: 'Upload Image'
    }
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
        images.value = event.target.files

        // console.log(images.value)

        emit('upload-finished', images.value)
    }
}

const handleDragEnter = (event) => {
    dragging.value = true
}

const handleDragOver = (event) => {
    event.preventDefault()
    event.dataTransfer.dropEffect = 'copy'
}

const handleDragLeave = (event) => {
    dragging.value = false
}

const handleDrop = (event) => {
    event.preventDefault()
    dragging.value = false
    // let image = event.dataTransfer.files[0]
    // debugger
    // // check the input file is image or not and check the file size is not more than 2MB
    // if (!image.type.startsWith('image')) {
    //     alert('দয়া করে ইমেজ ফাইল আপলোড করুন। ইমেজ ব্যতীত ফাইল গ্রহণযোগ্য নয়।')
    // } else if (image.size > 1024 * 1024) {
    //     alert('ইমেজ এর সাইজ ১ মেগাবাইট এর বেশি গ্রহণযোগ্য নয়।')
    // } else {
    //
    // }
    files.value = Array.from(event.dataTransfer.files)
    for (let file of files.value) {
        file.preview = URL.createObjectURL(file)
    }
    images.value = event.dataTransfer.files
    emit('upload-finished', files.value)
}

const removeFile = (index) => {
    files.value.splice(index, 1)
    images.value = files.value
    emit('upload-finished', files.value)
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
