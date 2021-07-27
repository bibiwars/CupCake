import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Condidature } from '../condidature/Condidature';

@Injectable({
  providedIn: 'root'
})
export class ShowCondidaturesService {

  constructor(private http: HttpClient,) { }
  public getAllCondidatures() {
    return this.http.get("https://127.0.0.1:8001/condidature/get-all", {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any[]) => {
      return response;
    }));
  }
  public deleteCondidature(id) {
    return this.http.delete("https://127.0.0.1:8001/condidature/delete/" + id, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response.data;
    }));
  }
  public updateCondidature(condidature) {
    return this.http.put('https://127.0.0.1:8001/condidature/update/' + condidature.id, condidature, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response;
    }));
  }
}

