import { User } from "@/types/models/teachers";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import axios from "axios";

export const useUserService = () => {
    const getUsers = (): Promise<User[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.USERS}`)
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
        getUsers,
    };
};
