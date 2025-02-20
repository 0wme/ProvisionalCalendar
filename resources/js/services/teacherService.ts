import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Teacher, User } from "@/types/models/teachers";

export const useTeacherService = () => {
    const getTeachers = (yearId: number): Promise<Teacher[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHERS}/${yearId}`)
                .then((response) => {
                    resolve(
                        response.data.map((teacher: any) => {
                            return {
                                name:
                                    teacher.firstname + " " + teacher.lastname,
                                ...teacher,
                            };
                        })
                    );
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

    const getTeacher = (teacherId: number, users: User[]): Promise<Teacher> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHER}/${teacherId}`)
                .then((response) =>
                    resolve({
                        code: response.data.acronym,
                        user: users.find((u) => u.id === response.data.user_id),
                        ...response.data,
                    })
                )
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
                .post(`${API_ENDPOINTS.TEACHER}/${promotionId}`, {
                    acronym: teacher.code,
                    user_id: teacher.user?.id,
                })
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
                .put(`${API_ENDPOINTS.TEACHER}/${teacher.id}`, {
                    acronym: teacher.code,
                    user_id: teacher.user?.id,
                })
                .then((response) => resolve(response.data))
                .catch((error) => {
                    console.log(error);
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
