import { Injectable } from '@angular/core';
import {Produit} from '../model/produit';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {Publication} from '../model/publication';
import {Router} from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class PublicationService {

  url = 'http://127.0.0.1:8001/publication';
  constructor(private http: HttpClient, private router: Router) { }
  postPublication(publication: Publication){
    return this.http.post(this.url + '/add'  , publication).subscribe((res: any) => {
      console.log(res);
      this.router.navigate(['/publications']);
    });
  }
  getPublications(){
    return this.http.get<Publication[]>(this.url );
  }
  getPublication(id): Observable<Publication>{
    return this.http.get<Publication>(this.url + '/' + id);
  }
  updatePublication(publication: Publication){
    return this.http.post(this.url + '/update'  , publication).subscribe((res: any) => {
      console.log(res);
    });
  }
  deletePublication(id){
    return this.http.get(this.url + '/delete/' + id);
  }
}
