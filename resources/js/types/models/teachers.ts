import { Item } from "./utils";
import { Teaching } from "./teachings";

/**
 * @interface Teacher
 *
 * Représente un enseignant.
 */
export type Teacher = Item & {
    /**
     * Le code de l'enseignant.
     */
    code: string;
    user?: User;
    /**
     * Les enseignements de l'enseignant.
     */
    teachings?: Teaching[];
};

export type User = Item & {
    username: string;
    firstname: string;
    lastname: string;
    email: string;
    roleId: number;
};
