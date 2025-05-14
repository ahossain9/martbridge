<template>
    <div class="row">
        <div class="col-xl-12 col-md-12 col-12 mb-1">
            <label class="form-label" for="sub_category_id">{{ props.label }}</label>
            <ckeditor :editor="editor" v-model="editor_text" :config="editorConfig" @input="handleEditorChange"></ckeditor>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
    label: {
        type: String,
        required: true
    },
    itemIndex: {
        type: Number,
        required: false
    },
    editor_value: {
        type: String,
        required: false
    }
});
const editor = ClassicEditor;
const editorConfig = {
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            'blockQuote',
            'insertTable',
            'mediaEmbed',
            'undo',
            'redo'
        ]
    },
};

const editor_text = ref(props?.editor_value);

const emit = defineEmits(['update_editor_text'])

onMounted(() => {
    editor_text.value = props.editor_value;
});

// update editor text when props.editor_value is loaded
watch(() => props.editor_value, (val) => {
    editor_text.value = val;
});

const handleEditorChange = (val) => {
    emit('update_editor_text', val, props.itemIndex)
}


</script>
