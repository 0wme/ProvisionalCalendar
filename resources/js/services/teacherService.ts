import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Teacher } from "@/types/models/teachers";
import { Period } from "@/types/models/periods";

export const useTeacherService = () => {
    const getTeachers = (
        promotionId: number,
        periods: Period[]
    ): Promise<Teacher[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHERS}/${promotionId}`)
                .then((response) => {
                    const teachings: Teaching[] = [];
                    for (const teaching of response.data) {
                        teachings.push({
                            id: teaching.id,
                            name: teaching.name,
                            period: periods.find(
                                (p) =>
                                    p.id === teaching.semester ||
                                    teaching.trimester
                            ),
                            apogee_code: teaching.apogee_code,
                            mcccFormInput: {
                                initial_tp: teaching.tp_hours_initial,
                                continuing_tp: teaching.tp_hours_continued,
                                initial_td: teaching.td_hours_initial,
                                continuing_td: teaching.td_hours_continued,
                                initial_cm: teaching.cm_hours_initial,
                                continuing_cm: teaching.cm_hours_continued,
                            },
                        });
                    }
                    resolve(teachings);
                })
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

    const deleteTeaching = (teachingId: number): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .delete(`${API_ENDPOINTS.TEACHING}/${teachingId}`)
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
        updateTeaching,
        deleteTeaching,
    };
};
