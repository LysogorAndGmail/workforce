import axios from 'axios';
import http from '@http';

class RoleService {
    constructor() {
        if (RoleService.instance) {
            return RoleService.instance;
        }

        RoleService.instance = this;
    }

    getRoles() {
        return http.get('/roles').then(res => {
            return res.data;
        });
    }

    getRole(id) {
        return http.get(`/role/${id}/show`).then(res => {
            return res.data;
        });
    }

    storeRole(data) {
        return http.post('/role/store', data);
    }

    updateRole(id, data) {
        return http.put(`/role/${id}/update`, data);
    }

    deleteRole(id) {
        return http.delete(`/role/${id}/destroy`).then(res => {
            return res.data;
        });
    }

}

export default new RoleService();
