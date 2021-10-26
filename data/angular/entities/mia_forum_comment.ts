import { MiaModel } from "@agencycoda/mia-core";

export class MiaForumComment extends MiaModel {
    id: number = 0;
    forum_id: number = 0;
    user_id: number = 0;
    comment: string = '';
    favorites: number = 0;
    created_at: string = '';
    updated_at: string = '';
    deleted: number = 0;
    status: number = 0;

}