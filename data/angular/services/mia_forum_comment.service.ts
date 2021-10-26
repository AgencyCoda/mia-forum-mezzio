import { Injectable } from '@angular/core';
import { MiaForumComment } from '../entities/mia_forum_comment';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaForumCommentService extends MiaBaseCrudHttpService<MiaForumComment> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_forum_comment';
  }
 
}