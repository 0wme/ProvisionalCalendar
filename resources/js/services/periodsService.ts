import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Period } from "@/types/models";

export const usePeriodService = () => {
    const getPeriods = (promotionId: number): Promise<Period[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.TEACHINGS}/${promotionId}`)
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
        getPeriods,
    };
};
