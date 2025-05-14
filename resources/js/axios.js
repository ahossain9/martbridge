import axios from "axios";
const ADMIN_APP_URL = import.meta.env.VITE_API_URL + '/admin/';
const axiosClient =  axios.create({
    baseURL: ADMIN_APP_URL,
});

export default axiosClient;
