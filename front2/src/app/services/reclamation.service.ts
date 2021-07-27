import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {Publication} from '../model/publication';
import {Observable} from 'rxjs';
import {Reclamation} from '../model/reclamation';

@Injectable({
  providedIn: 'root'
})
export class ReclamationService {

  url = 'https://127.0.0.1:8001/reclamation';
  private nbr: number;
  constructor(private http: HttpClient, private router: Router) { }
  postReclamation(reclamation: Reclamation){
    return this.http.post(this.url + 'add'  , reclamation).subscribe((res: any) => {
      console.log(res);
      this.router.navigate(['/mesreclamations']);
    });
  }
  getReclamations(){
    return this.http.get<Reclamation[]>(this.url );
  }
  getMesReclamations(iduser: number){
    return this.http.get<Reclamation[]>(this.url + '/user/' + iduser );
  }
  getReclamation(id): Observable<Reclamation>{
    return this.http.get<Reclamation>(this.url + '/' + id);
  }
  updateReclamation(reclamation: Reclamation){
    return this.http.post(this.url + 'update'  , reclamation).subscribe((res: any) => {
      console.log(res);
      this.router.navigate(['/mesreclamations']);
    });
  }
  deleteReclamation(id){
    return this.http.get(this.url + '/delete/' + id);
  }
  repondreReclamation(reclamation: Reclamation){
    return this.http.post(this.url + 's/repondre/' + reclamation.idReclamation  , reclamation).subscribe((res: any) => {
      this.router.navigate(['/mesreclamations']);
      console.log(res);
    });
  }
  calculeReclamation(type: string){
    return this.http.get<number>(this.url + 'Calcul/' + type );
  }
}
