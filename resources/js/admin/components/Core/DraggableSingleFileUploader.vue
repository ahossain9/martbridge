<template>
    <div class="row d-flex justify-content-between mb-1">
        <label class="form-label"> {{ props.label }}</label>
        <div class="col-md-6 col-12">
            <label
                ref="dropzone"
                @dragenter.prevent="handleDragEnter"
                @dragover.prevent="handleDragOver"
                @dragleave.prevent="handleDragLeave"
                @drop.prevent="handleDrop"
                class="d-flex justify-content-center align-items-center drop-zone"
                :class="{ 'dragging': dragging }"
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
        <div class="col-md-6 col-12">
            <div v-if="file" class="">
                <template v-if="file.type.startsWith('image')">
                    <div class="">
                        <img class="" :src="file.preview" alt="Image" width="260" height="200">
                    </div>
                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{ file.name }}
                    </p>
                </template>
                <div v-else class="">
                    <button class="">
                        {{ file.name }}
                    </button>
                </div>

                <button type="button" @click="removeFile()" class="btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px;" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div v-else-if="props?.image" class="mb-2">
                <div class="form-image-container">
                    <img class="" :src="props?.image" width="300" height=200 alt="Featured Image">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">

    </div>

</template>

<script setup>
import {ref} from "vue";

const file = ref(null)
const image = ref(null)
const uploading = ref(false)
const dragging = ref(false)

const props = defineProps({
    label: {
        type: String,
        default: 'Upload Image'
    },
    image: {
        // type: Array,
        default: () => null
    },
});

// define emits
const emit = defineEmits(['upload-finished', 'file-deleted'])

const handleUpload = (event) => {
    let image = event.target.files[0]
    // check the input file is image or not and check the file size is not more than 2MB
    if (!image.type.startsWith('image')) {
        alert('Please select image files।')
    } else if (image.size > 1024 * 1024) {
        alert('Image size should not be more than 1 MB।')
    } else {
        file.value = image
        file.value.preview = URL.createObjectURL(file.value)

        emit('upload-finished', file.value)
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
    event.preventDefault();
    dragging.value = false;

    if (event.dataTransfer.files.length > 0) {
        let uploadedImage = event.dataTransfer.files[0];
        // Check if the file has a common image file extension (e.g., .jpg, .png, .gif, .jpeg, etc.).
        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp']; // Add more if needed

        const fileName = uploadedImage.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        if (imageExtensions.includes(fileExtension) && uploadedImage.size <= 700 * 1024) {
            // The file has a valid image extension and is not larger than 700KB.
            file.value = uploadedImage;
            file.value.preview = URL.createObjectURL(file.value);

            emit('upload-finished', file.value);
        } else {
            if (!imageExtensions.includes(fileExtension)) {
                alert('Please select a valid image file.');
            } else {
                alert('Image size should not be more than 700KB.');
            }
        }
    } else {
        alert('No files were dropped.');
    }
};



const removeFile = () => {
    file.value = null
    emit('file-deleted', file.value)
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
    max-width: 70%;
    max-height: 40%;
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
