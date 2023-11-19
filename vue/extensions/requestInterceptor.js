import Cookies from 'js-cookie';
import axios from "axios";

// Create axios instance with base url and credentials support
export const axiosInstance = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true,
});

// Request interceptor. Runs before your request reaches the server
const onRequest = (config) => {
    // If http method is `post | put | delete` and XSRF-TOKEN cookie is
    // not present, call '/sanctum/csrf-cookie' to set CSRF token, then
    // proceed with the initial response
    if ((
            config.method === 'post' ||
            config.method === 'put' ||
            config.method === 'delete'
        ) &&
        !Cookies.get('XSRF-TOKEN')) {
        return setCSRFToken()
            .then(response => config);
    }
    return config;
}

const setCSRFToken = () => {
    return axiosInstance.get('/sanctum/csrf-cookie'); // resolves to '/api/csrf-cookie'.
}

// attach your interceptor
axiosInstance.interceptors.request.use(onRequest, null);

export default axiosInstance;
