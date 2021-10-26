import { Injectable } from '@angular/core';
import { MiaForum } from '../entities/mia_forum';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaForumService extends MiaBaseCrudHttpService<MiaForum> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_forum';
  }
 
}