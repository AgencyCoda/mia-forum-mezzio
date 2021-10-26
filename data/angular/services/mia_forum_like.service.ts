import { Injectable } from '@angular/core';
import { MiaForumLike } from '../entities/mia_forum_like';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaForumLikeService extends MiaBaseCrudHttpService<MiaForumLike> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_forum_like';
  }
 
}