import { Injectable } from '@angular/core';
import {Produit} from '../model/produit';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {Competition} from '../model/competition';

@Injectable({
  providedIn: 'root'
})
export class CompetitionService {

  url = 'https://127.0.0.1:8001/competition';
  constructor(private http: HttpClient) { }
  postCompetition(competititon: Competition){
    return this.http.post(this.url + '/add'  , competititon).subscribe((res: any) => {
      console.log(res);
    });
  }
  getCompetitions(){
    return this.http.get<Competition[]>(this.url);
  }
  getCompetition(id): Observable<Competition>{
    return this.http.get<Competition>(this.url + '/' + id);
  }

  updateCompetition(competition: Competition){
    return this.http.post(this.url + '/update'  , competition).subscribe((res: any) => {
      console.log(res);
    });
  }
  deleteCompetition(id){
    return this.http.get(this.url + '/delete/' + id);
  }
}
