<template>
    <div class=" mb-4">
        <div class="card" style="background-color: #edf8f6">
            <div class="card-header">
                <div class="card-title">
                    Variants
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-2" v-if="variantOptions.length === 0">
                    <a @click="addOption" class="text-primary"> + Add options like size or color</a>
                </div>
                <div>
                    <div class="card mb-2" v-for="(option, index) in variantOptions" :key="index">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Name -->
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" v-model="option.name">
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <!-- Value -->
                                        <div class="col-md-12">
                                            <VueMultiselect
                                                v-model="option.values"
                                                :options="option.values"
                                                :multiple="true"
                                                :close-on-select="false"
                                                :clear-on-select="false"
                                                :preserve-search="true"
                                                track-by="name"
                                                label="name"
                                                placeholder="Create value"
                                                tag-placeholder="Press enter to create a value"
                                                :taggable="true"
                                                @tag="addValue($event, option)"
                                                @keyup.enter="handleCombination"
                                                @remove="handleRemoveOption"
                                                :show-labels="false">
                                            </VueMultiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <a @click="removeOption(index)" class="text-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" v-if="variantOptions.length > 0">
                        <div class="col-md-12">
                            <a @click="addOption" class="text-primary"> + Add another Option</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <button type="button" class="btn btn-info" @click="handleCombination">Combine Again</button>
            </div>

            <div class="container mt-2" v-if="variantsCombinations.length > 0">
                <h2>Variation Combinations - {{ variantsCombinations.length }}</h2>
                <div class="scrollable-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="fixed-column">Variant Name</th>
                            <th>Price</th>
                            <th>Available</th>
                            <th>SKU</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(combination, index) in variantsCombinations" :key="index">
                            <td class="fixed-column">{{ combination.name }}</td>
                            <td>
                                <input
                                    type="number"
                                    placeholder="0.0"
                                    class="form-control"
                                    v-model="combination.price"
                                    @input="() => updateField(index, 'price', combination.price)"
                                >
                            </td>
                            <td>
                                <input
                                    type="number"
                                    placeholder="0"
                                    class="form-control"
                                    v-model="combination.stock_quantity"
                                    @input="() => updateField(index, 'stock_quantity', combination.stock_quantity)"
                                >
                            </td>
                            <td>
                                <input
                                    type="text"
                                    placeholder="xxx"
                                    class="form-control"
                                    v-model="combination.sku"
                                    @input="() => updateField(index, 'sku', combination.sku)"
                                >
                            </td>
                            <td>
                                <a class="text-danger" @click="removeCombination(index)">Remove</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>

import VueMultiselect from "vue-multiselect";
import axiosClient from "../../../../axios";

const {variantOptions, variantsCombinations, salePrice} = defineProps({
    variantOptions: {
        type: Array,
        default: () => []
    },
    variantsCombinations: {
        type: Array,
        default: () => []
    },
    salePrice: {
        type: Number,
        default: 0
    },
});

const emits = defineEmits(["update:variantOptions", "update:variantsCombinations"]);

const handleRemoveOption = (value) => {
    const items = variantsCombinations.value.filter((combination) => {
        return combination.name.includes(value.name);
    });

    for (const item of items) {
        variantsCombinations.value.splice(variantsCombinations.value.indexOf(item), 1);
    }

    handleCombination();

    emits("update:variantsCombinations", variantsCombinations.value);
};


const handleCombination = () => {
    const result = [];
    const removeInvalidCombinations = () => {
        variantsCombinations.value = variantsCombinations.filter((combination) => {
            for (const option of variantOptions) {
                if (!combination.name.includes(option.name)) {
                    return false;
                }
            }
            return true;
        });
    };

    const generate = (index, currentCombination) => {
        if (index === variantOptions.length) {
            const formattedCombination = currentCombination.map((item) => {
                return item.hasOwnProperty('id') ? item.name : item;
            });

            result.push({
                id: null,
                product_id: null,
                name: formattedCombination.join('/'),
                price: salePrice,
                stock_quantity: 0,
                sku: '',
            });
            return;
        }

        for (const value of variantOptions[index].values) {
            generate(index + 1, [...currentCombination, value]);
        }
    };

    removeInvalidCombinations();

    generate(0, []);
    variantsCombinations.value = result;
    emits("update:variantsCombinations", variantsCombinations.value);
};


const removeCombination = (index) => {
    variantsCombinations.value.splice(index, 1);
    emits("update:variantsCombinations", variantsCombinations.value);
};

const updateField = (index, field, value) => {
    if (variantsCombinations.value[index]) {
        variantsCombinations.value[index][field] = value;
        emits("update:variantsCombinations", variantsCombinations.value);
    }
};


const addOption = () => {
    let option = {
        name: '',
        values: []
    }
    variantOptions.push(option);
    emits("update:variantOptions", variantOptions);
}

const removeOption = (index) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this option?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            axiosClient.delete('/mixin/delete-variant-option/' + variantOptions[index].id)
                .then(() => {
                Swal.fire(
                    'Deleted!',
                    'Variation option has deleted.',
                    'success'
                )
            }).catch(() => {
                Swal.fire(
                    'Error!',
                    'Something went wrong.',
                    'error'
                )
            });

            variantOptions.splice(index, 1);
            emits("update:variantOptions", variantOptions);
            handleCombination();
        }
    });
}

const addValue = (val, option) => {
    let value = {
        id: null,
        name: val,
        product_variation_id: null,
    }
    option.values.push(value);
    emits("update:variantOptions", variantOptions);
};

</script>

<style scoped>
.fixed-column {
    position: absolute;
    background-color: #fff;
    left: 0;
    width: 200px;
    z-index: 1;
}

.scrollable-content {
    margin-left: 200px;
    overflow-x: auto;
}
</style>
