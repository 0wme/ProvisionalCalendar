import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Group } from "@/types/models/groups";

export const useGroupService = () => {
    const getGroups = (promotionId: number): Promise<Group[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.GROUPS}/${promotionId}`)
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

    const getGroup = (groupId: number): Promise<Group> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.GROUP}/${groupId}`)
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

    const addGroup = (promotionId: number, group: Group): Promise<Group> => {
        return new Promise((resolve, reject) =>
            axios
                .post(`${API_ENDPOINTS.GROUP}/${promotionId}`, group)
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

    const updateGroup = (group: Group): Promise<Group> => {
        return new Promise((resolve, reject) =>
            axios
                .put(`${API_ENDPOINTS.GROUP}/${group.id}`, group)
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

    const deleteGroup = (groupId: number): Promise<Group> => {
        return new Promise((resolve, reject) =>
            axios
                .delete(`${API_ENDPOINTS.GROUP}/${groupId}`)
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
        getGroups,
        getGroup,
        addGroup,
        updateGroup,
        deleteGroup,
    };
};
