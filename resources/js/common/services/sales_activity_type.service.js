import axios from 'axios';
import http from '@http';

class SalesActivityTypeService {
    constructor() {
        if (SalesActivityTypeService.instance) {
            return SalesActivityTypeService.instance;
        }

        SalesActivityTypeService.instance = this;
    }

    getSalesActivityTypes() {
        return http.get('/sales-activity-types').then(res => {
            return res.data;
        });
    }

    getSalesActivityType(id) {
        return http.get(`/sales-activity-type/${id}/show`).then(res => {
            return res.data;
        });
    }

    storeSalesActivityType(data) {
        return http.post('/sales-activity-type/store', data);
    }

    updateSalesActivityType(id, data) {
        return http.put(`/sales-activity-type/${id}/update`, data);
    }

    deleteSalesActivityType(id) {
        return http.delete(`/sales-activity-type/${id}/destroy`).then(res => {
            return res.data;
        });
    }

}

export default new SalesActivityTypeService();
