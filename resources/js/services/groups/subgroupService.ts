import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Subgroup } from "@/types/models/groups";

export const useSubgroupService = () => {
    const getSubgroups = (yearId: number): Promise<Subgroup[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.SUBGROUPS}/${yearId}`)
                .then((response) => resolve(response.data))
                .catch((error) => {
                    if (error.response?.data?.error) {
                        reject(error.response.data.error);
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
                })
        );
    };

    const getSubgroup = (subgroupId: number): Promise<Subgroup> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.SUBGROUP}/${subgroupId}`)
                .then((response) => resolve(response.data))
                .catch((error) => {
                    if (error.response?.data?.error) {
                        reject(error.response.data.error);
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
                })
        );
    };

    const addSubgroup = (
        yearId: number,
        subgroup: Subgroup
    ): Promise<Subgroup> => {
        return new Promise((resolve, reject) =>
            axios
                .post(`${API_ENDPOINTS.SUBGROUP}/${yearId}`, subgroup)
                .then((response) => resolve(response.data))
                .catch((error) => {
                    if (error.response?.data?.error) {
                        reject(error.response.data.error);
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
                })
        );
    };

    const updateSubgroup = (subgroup: Subgroup): Promise<Subgroup> => {
        return new Promise((resolve, reject) =>
            axios
                .put(`${API_ENDPOINTS.SUBGROUP}/${subgroup.id}`, subgroup)
                .then((response) => resolve(response.data))
                .catch((error) => {
                    if (error.response?.data?.error) {
                        reject(error.response.data.error);
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
                })
        );
    };

    const deleteSubgroup = (subgroupId: number): Promise<Subgroup> => {
        return new Promise((resolve, reject) =>
            axios
                .delete(`${API_ENDPOINTS.SUBGROUP}/${subgroupId}`)
                .then((response) => resolve(response.data))
                .catch((error) => {
                    if (error.response?.data?.error) {
                        reject(error.response.data.error);
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
                })
        );
    };

    return {
        getSubgroups,
        getSubgroup,
        addSubgroup,
        updateSubgroup,
        deleteSubgroup,
    };
};
