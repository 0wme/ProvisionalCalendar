import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Teacher } from "@/types/models/teachers";

export const useTeacherService = () => {
    const getTeachers = (yearId: number): Promise<Teacher[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHERS}/${yearId}`)
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

    const getTeacher = (teacherId: number): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHER}/${teacherId}`)
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

    const addTeacher = (
        promotionId: number,
        teacher: Teacher
    ): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .post(`${API_ENDPOINTS.TEACHER}/${promotionId}`, teacher)
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

    const updateTeacher = (teacher: Teacher): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .put(`${API_ENDPOINTS.TEACHER}/${teacher.id}`, teacher)
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

    const deleteTeacher = (teacherId: number): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .delete(`${API_ENDPOINTS.TEACHER}/${teacherId}`)
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
        getTeachers,
        getTeacher,
        addTeacher,
        updateTeacher,
        deleteTeacher,
    };
};
