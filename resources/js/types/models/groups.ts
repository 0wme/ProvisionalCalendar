import { Item } from "./utils";

export type Subgroup = Item;

export type Group = Item & {
    subgroups?: Subgroup[];
};

export type Promotion = Item & {
    groups?: Group[];
};
