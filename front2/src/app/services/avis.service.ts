import { Injectable } from '@angular/core';
import {Produit} from '../model/produit';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {Observable} from 'rxjs';
import {Avis} from '../model/avis';

@Injectable({
  providedIn: 'root'
})
export class AvisService {
  url = 'https://127.0.0.1:8001/avis';
  constructor(private http: HttpClient, private router: Router) { }
  postAvis(avis: Avis){
    return this.http.post(this.url + '/add' , avis).subscribe((res: any) => {
      this.router.navigate(['mesreclamations' ]);
      console.log(res);
    });
  }
  getAvis(){
    return this.http.get<Avis[]>(this.url );
  }
  deleteAvis(id){
    return this.http.get(this.url + '/delete/' + id);
  }
}
