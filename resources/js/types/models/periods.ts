export type Period = {
    id: number;
    name: string;
    type: PeriodType;
};

export type ApiSemester = {
    id: number;
    number: string;
};

export type ApiTrimester = {
    id: number;
    number: string;
};

export type ApiPeriodResponse = {
    semesters?: ApiSemester[];
    trimesters?: ApiTrimester[];
};

export enum PeriodType {
    SEMESTER = "SEMESTER",
    TRIMESTER = "TRIMESTER",
}
