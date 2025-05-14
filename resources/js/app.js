import './bootstrap';
import { createApp } from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import CKEditor from '@ckeditor/ckeditor5-vue';

import Attribute from './admin/components/Attribute.vue';
import Product from './admin/components/Product.vue';
import EditProduct from './admin/components/EditProduct.vue';
import FileUploader from "./admin/components/Core/FileUploader.vue";
import BestSellingProductPie from "./admin/components/Charts/BestSellingProductPie.vue";

const app = createApp({
    components: {
        'attribute-values': Attribute,
        'product-component': Product,
        'edit-product': EditProduct,
        'file-uploader': FileUploader,
        'best-selling-product-pie': BestSellingProductPie
    }
});

app.use(VueSweetalert2);
app.use(CKEditor);
window.Swal =  app.config.globalProperties.$swal;

app.mount('#admin-app');
