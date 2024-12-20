import { MenuItem } from "@/types/models";

const provisionnalCalendarMenuItems: MenuItem[] = [
    { iconClass: "User", label: 'Groupes', route: 'groupes' },
    { iconClass: "Book", label: 'Enseignants/Enseignements', route: 'enseignants-enseignements' },
    { iconClass: "Calendar", label: 'Calendrier Prévisionnels', route: 'editeur' }
];

export const sidebarMenuItems: MenuItem[] = [
    { iconClass: "Calendar", label: 'Calendrier Prévisionnel', route: 'calendrier-previsionnel', submenu: provisionnalCalendarMenuItems },
    { iconClass: "Clock", label: 'EDT', route: 'edt', disable: true },
    { iconClass: "NotebookText", label: 'Service', route: 'service', disable: true },
    { iconClass: "Settings", label: 'Configurations', route: 'configurations' }

];