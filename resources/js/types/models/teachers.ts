/**
 * @interface Teacher
 *
 * Représente un enseignant.
 */
export type Teacher = Item & {
    /**
     * Le prénom de l'enseignant.
     */
    firstname: string;
    /**
     * Le nom de l'enseignant.
     */
    lastname: string;
    /**
     * Le code de l'enseignant.
     */
    code: string;
    /**
     * Les enseignements de l'enseignant.
     */
    teachings: Teaching[];
};
