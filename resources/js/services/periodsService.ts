import axios from "axios";
import { API_ENDPOINTS, MESSAGES } from "@/constants";
import { Period, PeriodType, ApiPeriodResponse, ApiSemester, ApiTrimester } from "@/types/models/periods";

export const usePeriodService = () => {
    const getPeriods = (yearId: number): Promise<Period[]> => {
        return new Promise((resolve, reject) =>
            axios
                .get<ApiPeriodResponse>(`${API_ENDPOINTS.PERIODS}/${yearId}`)
                .then((response) => {
                    if (response.data.semesters) {
                        resolve(
                            response.data.semesters.map((semester: ApiSemester) => ({
                                id: semester.id,
                                name: `Semestre ${semester.number}`,
                                type: PeriodType.SEMESTER,
                            }))
                        );
                    } else if (response.data.trimesters) {
                        resolve(
                            response.data.trimesters.map((trimester: ApiTrimester) => ({
                                id: trimester.id,
                                name: `Trimestre ${trimester.number}`,
                                type: PeriodType.TRIMESTER,
                            }))
                        );
                    } else {
                        reject(MESSAGES.DEFAULT_ERROR_MESSAGE);
                    }
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

    return {
        getPeriods,
    };
};
