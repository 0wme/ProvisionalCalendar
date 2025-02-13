import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Promotion } from "@/types/models";

export const usePromotionService = () => {
    const getPromotions = (yearId: number): Promise<Promotion[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.PROMOTIONS}/${yearId}`)
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

    const getPromotion = (promotionId: number): Promise<Promotion> => {
        return new Promise((resolve, reject) =>
            axios
                .get(`${API_ENDPOINTS.PROMOTION}/${promotionId}`)
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

    const addPromotion = (
        yearId: number,
        promotion: Promotion
    ): Promise<Promotion> => {
        return new Promise((resolve, reject) =>
            axios
                .post(`${API_ENDPOINTS.PROMOTION}/${yearId}`, promotion)
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

    const updatePromotion = (promotion: Promotion): Promise<Promotion> => {
        return new Promise((resolve, reject) =>
            axios
                .put(`${API_ENDPOINTS.PROMOTION}/${promotion.id}`, promotion)
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

    const deletePromotion = (promotionId: number): Promise<Promotion> => {
        return new Promise((resolve, reject) =>
            axios
                .delete(`${API_ENDPOINTS.PROMOTION}/${promotionId}`)
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
        getPromotions,
        getPromotion,
        addPromotion,
        updatePromotion,
        deletePromotion,
    };
};
