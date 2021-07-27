import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Commande } from './commande';

@Injectable({
  providedIn: 'root'
})
export class CommandesService {

  constructor(private http: HttpClient,) { }
  public addCommande(commande) {
    return this.http.post('https://127.0.0.1:8001/commande/add', commande, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response;
    }))
  }
  public uploadpdf(name, pdf) {
    return this.http.post('https://127.0.0.1:8001/commande/upload/' + name, pdf, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response;
    }));
  }
}

