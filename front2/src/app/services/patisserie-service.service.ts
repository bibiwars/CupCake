import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Patisserie} from '../model/patisserie';
import {Observable} from 'rxjs';
import {Router} from '@angular/router';
@Injectable({
  providedIn: 'root'
})
export class PatisserieServiceService {
  url = 'https://127.0.0.1:8001/pat';
  patisserie: Patisserie;
  constructor(private http: HttpClient, private router: Router) { }
  postPatisserie(patisserie: Patisserie){
    return this.http.post(this.url + '/add'  , patisserie).subscribe((res: any) => {
      console.log(patisserie);
      this.router.navigate(['pat']);
    });
  }
  getPatisseries(){
    return this.http.get<Patisserie[]>(this.url);
  }
  deletePatisserie(id){
    return this.http.get(this.url + '/del/' + id);
  }
  getPatisserie(id): Observable<Patisserie>{
    return this.http.get<Patisserie>(this.url + '/' + id);
  }
  updatePatisserie(patisserie: Patisserie){
    return this.http.post(this.url + '/update/' + patisserie.id  , patisserie).subscribe((res: any) => {
      console.log(res);
    });
  }
}
