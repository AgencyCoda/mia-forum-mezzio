import { Injectable } from '@angular/core';
import { MiaForumCommentLike } from '../entities/mia_forum_comment_like';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaForumCommentLikeService extends MiaBaseCrudHttpService<MiaForumCommentLike> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_forum_comment_like';
  }
 
}