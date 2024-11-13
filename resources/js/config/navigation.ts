import { MenuItem } from "@/types/models";

const provisionnalCalendarMenuItems: MenuItem[] = [
    { iconClass: "User", label: 'Groupes', route: 'groupes' },
    { iconClass: "Book", label: 'Enseignants/Enseignements', route: 'teachers' },
    { iconClass: "Calendar", label: 'Calendrier Prévisionnel', route: 'admin-calendar' },
    { iconClass: "AlertCircle", label: 'Alertes', route: 'alertes' },
    { iconClass: "Settings", label: 'Configurations', route: 'configurations' },
];

export const sidebarMenuItems: MenuItem[] = [
    { iconClass: "Calendar", label: 'Calendrier Prévisionnel', route: 'calendrier-previsionnel', submenu: provisionnalCalendarMenuItems },
    { iconClass: "Clock", label: 'EDT', route: 'edt' },
    { iconClass: "NotebookText", label: 'Service', route: 'service' }
];