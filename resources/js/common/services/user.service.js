import axios from 'axios';
import http from '@http';

class UserService {
    constructor() {
        if (UserService.instance) {
            return UserService.instance;
        }

        UserService.instance = this;
    }

    getUsers() {
        return http.get('/users').then(res => {
            return res.data;
        });
    }

    getUser(id) {
        return http.get(`/user/${id}/show`).then(res => {
            return res.data;
        });
    }

    getAuthUser(id) {
        return http.get(`/auth-user`).then(res => {
            return res.data;
        });
    }

    storeUser(data) {
        return http.post('/user/store', data);
    }

    updateUser(id, data) {
        return http.put(`/user/${id}/update`, data);
    }

    deleteUser(id) {
        return http.delete(`/user/${id}/destroy`).then(res => {
            return res.data;
        });
    }

}

export default new UserService();
