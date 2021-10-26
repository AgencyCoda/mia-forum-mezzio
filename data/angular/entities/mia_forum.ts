import { MiaModel } from "@agencycoda/mia-core";

export class MiaForum extends MiaModel {
    id: number = 0;
    user_id: number = 0;
    title: string = '';
    slug: string = '';
    content: string = '';
    favorites: number = 0;
    comments: number = 0;
    type: number = 0;
    item_id: number = 0;
    created_at: string = '';
    updated_at: string = '';
    deleted: number = 0;

}