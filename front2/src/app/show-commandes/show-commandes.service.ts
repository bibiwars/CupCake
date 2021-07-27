import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Commande } from '../commande/commande';

@Injectable({
  providedIn: 'root'
})
export class ShowCommandesService {

  constructor(private http: HttpClient,) { }
  public getAllCommandes() {
    return this.http.get("https://127.0.0.1:8001/commande/get-all", {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any[]) => {
      return response;
    }));
  }
  public deleteCommande(id) {
    return this.http.delete("https://127.0.0.1:8001/commande/delete/" + id, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response.data;
    }));
  }
  public updateCommande(commande) {
    return this.http.put('https://127.0.0.1:8001/commande/update/' + commande.id, commande, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem('auth_token'),
      })
    }).pipe(map((response: any) => {
      return response;
    }));
  }
}

