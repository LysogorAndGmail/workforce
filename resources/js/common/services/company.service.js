import axios from 'axios';
import http from '@http';

class CompanyService {
    constructor() {
        if (CompanyService.instance) {
            return CompanyService.instance;
        }

        CompanyService.instance = this;
    }

    getCompanies() {
        return http.get('/companies').then(res => {
            return res.data;
        });
    }

    getCompany(id) {
        return http.get(`/company/${id}/show`).then(res => {
            return res.data;
        });
    }

    storeCompany(data) {
        return http.post('/company/store', data);
    }

    updateCompany(companyId, data) {
        return http.put(`/company/${companyId}/update`, data);
    }

    searchCompanies(search) {
        return http.get(`/company/${search}/search`).then(res => {
            return res.data;
        });
    }

}

export default new CompanyService();
