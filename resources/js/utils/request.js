import axios from "axios";
import { getToken } from '@/utils/auth'

const service = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
    timeout: 60000
})

service.interceptors.request.use(
    config => {
        const token = getToken() || false;
        if (token) {
         config.headers['Authorization'] = 'Bearer ' + token; // Set JWT token
        }
        return config;
    },
    error => {
        return Promise.reject(error);
      }
)
service.interceptors.response.use(
    response => {
      return response;
    },
    error => {
             return Promise.reject(error);
  }
);
export default service;
