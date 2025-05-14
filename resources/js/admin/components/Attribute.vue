<template>
    <div>
        <div class="row d-flex align-items-end"
             v-for="(attribute, index) in attribute_values.attribute_values"
             :key="index"
        >
            <div class="col-md-4 col-12">
                <div class="mb-1">
                    <label class="form-label" for="option_value">
                        <strong>
                            Attribute value ({{ index+1 }})
                        </strong>
                    </label>
                    <input type="text" class="form-control" id="option_value" aria-describedby="option_value" name="attribute_values[]"
                           v-model="attribute.value" placeholder="ex: red" />
                </div>
            </div>

            <div class="col-md-1 me-1 col-12">
                <div class="mb-1">
                    <button class="btn btn-outline-info text-nowrap px-1" type="button"
                            @click="addAttributeValue">
                        <span>Add</span>
                    </button>
                </div>
            </div>

            <div class="col-md-1 col-12">
                <div class="mb-1">
                    <button class="btn btn-outline-danger text-nowrap px-1" type="button"
                            @click="removeAttributeValue(index)"
                    >
                        <span>Delete</span>
                    </button>
                </div>
            </div>
        </div>
        <hr />
        <!--        <div class="row">-->
        <!--            <div class="col-12">-->
        <!--                <button class="btn btn-icon btn-primary" type="button" data-repeater-create @click="saveAttribute">-->
        <!--                    <i data-feather="plus" class="me-25"></i>-->
        <!--                    <span>Save</span>-->
        <!--                </button>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>

<script setup>

import {onMounted, reactive} from 'vue';
import axios from "axios";

// receive props from parent component
const props = defineProps({
    attribute_id: {
        type: Number,
    },
    create_mode: {
        type: Boolean,
    },
});

const api_url = import.meta.env.VITE_API_URL + '/admin/'
const attribute_values = reactive({
    attribute_id: props.attribute_id,
    attribute_values: [{
        id: null,
        value: ''
    }]
});

onMounted(() => {
    attributes(props?.attribute_id);
});

const attributes = (attribute_id) => {
    if (attribute_id) {
        axios.get(api_url + 'manage-products/attribute-values/' + attribute_id)
            .then((response) => {
                let data = response.data.data;
                attribute_values.attribute_values = [];
                data.forEach((attribute) => {
                    attribute_values.attribute_values.push({
                        id: attribute.id,
                        value: attribute.name
                    });
                });
            })
            .catch((error) => {
                console.log(error)
            })
    }
}

const addAttributeValue = () => {
    attribute_values.attribute_values.push({
        value: '',
    });
}

const removeAttributeValue = (index) => {
    if (attribute_values.attribute_values.length > 1) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let attribute_id = attribute_values.attribute_values[index]?.id;
                if (!props.create_mode && attribute_id) {
                    axios.delete(api_url + 'manage-products/attribute-values/' + attribute_id)
                        .then((response) => {
                            Swal.fire(
                                'Deleted!',
                                'Value has deleted successfully.',
                                'success'
                            );
                        })
                        .catch((error) => {
                            // show error message sweetalert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        })
                }
                attribute_values.attribute_values.splice(index, 1);
            }
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You must have at least one value!',
        })
    }
}

const saveAttribute = () => {
    axios.post(api_url + 'manage-products/attribute-values', attribute_values)
        .then((response) => {
            attribute_values.attribute_values = [{
                value: ''
            }];
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.data.message,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });

            // reload the page after 2 seconds
            setTimeout(() => {
                location.reload();
            }, 2000);
        })
        .catch((error) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.response.data.errors.attribute_values[0],
            })
        });
}

</script>
