import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class CondidatureService {

  constructor(private http: HttpClient,) { }

  public addCondidature(condidature) {
    return this.http.post('https://127.0.0.1:8001/condidature/add', condidature, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response;
    }))
  }
}