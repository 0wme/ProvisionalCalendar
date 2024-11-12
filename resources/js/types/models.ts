export interface Period {
    id: number;
    name: string;
}

export interface Item {
    id: number;
    name: string;
}

export interface Teacher extends Item {
    firstname: string;
    lastname: string;
    code: string;
}

export interface Teaching extends Item {
    apogee_code: string;
    initial_cm: number;
    initial_td: number;
    initial_tp: number;
    continuing_cm: number;
    continuing_td: number;
    continuing_tp: number;
    period: Period | null;
    teachers: Teacher[];
}
