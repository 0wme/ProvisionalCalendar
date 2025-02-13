/**
 * @interface MenuItem
 *
 * Représente un élément du menu.
 */
export interface MenuItem {
    /**
     * Le nom de la classe de l'icône.
     */
    iconClass: string;
    /**
     * Le label de l'élément du menu.
     */
    label: string;
    /**
     * La route de l'élément du menu.
     */
    route: string;
    /**
     * Le sous-menu de l'élément du menu.
     */
    submenu?: MenuItem[];
    /**
     * Indique si l'élément du menu est désactivé.
     */
    disable?: boolean;
}

/**
 * @interface Item
 *
 * Représente un élément.
 */
export type Item = {
    /**
     * L'ID de l'élément.
     */
    id?: number;
    /**
     * Le nom de l'élément.
     */
    name: string;
    /**
     * La période de l'élément.
     */
    period?: Period;
};
