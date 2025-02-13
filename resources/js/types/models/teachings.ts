/**
 * @interface Teaching
 *
 * Représente un enseignement.
 */
export type Teaching = Item & {
    /**
     * Le code apogee de l'enseignement.
     */
    apogee_code: string;
    mcccFormInput: MCCCFormInput;
    /**
     * Les enseignants de l'enseignement.
     */
    period?: Period;
};

export interface MCCCFormInput {
    /**
     * Le nombre initial de CM de l'enseignement.
     */
    initial_cm?: number;
    /**
     * Le nombre initial de TD de l'enseignement.
     */
    initial_td?: number;
    /**
     * Le nombre initial de TP de l'enseignement.
     */
    initial_tp?: number;
    /**
     * Le nombre continu de CM de l'enseignement.
     */
    continuing_cm?: number;
    /**
     * Le nombre continu de TD de l'enseignement.
     */
    continuing_td?: number;
    /**
     * Le nombre continu de TP de l'enseignement.
     */
    continuing_tp?: number;
}
