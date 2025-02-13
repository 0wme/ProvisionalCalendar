export enum SlotType {
    CM = "CM",
    TD = "TD",
    TP = "TP",
}

/**
 * @interface CalendarContent
 *
 * Représente le contenu d'une cellule du calendrier.
 */
export interface CalendarContent {
    /**
     * Le nombre d'heures.
     */
    hours: number;
    /**
     * Le code de l'enseignant.
     */
    teacherCode: string;
    /**
     * Le type de cours (CM, TD, TP).
     */
    type: string;
    /**
     * Indique si le contenu est neutralisé.
     */
    isNeutralized: boolean;
}

/**
 * @interface CalendarGroup
 *
 * Représente un groupe dans le calendrier avec ses contenus et sous-groupes.
 */
export interface CalendarGroup {
    /**
     * Les contenus du groupe.
     */
    contents: CalendarContent[];
    /**
     * Les sous-groupes.
     */
    groups?: CalendarGroup[];
}

/**
 * @interface CalendarWeek
 *
 * Représente une semaine dans le calendrier.
 */
export interface CalendarWeek {
    /**
     * Le numéro de la semaine.
     */
    week: number;
    /**
     * Les groupes de la semaine.
     */
    groups: CalendarGroup[];
}

/**
 * @type Calendar
 *
 * Représente le calendrier complet.
 */
export type Calendar = CalendarWeek[];
