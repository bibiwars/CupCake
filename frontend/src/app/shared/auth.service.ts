import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private Http:HttpClient) { }
  
  Login(d:any){
    return this.Http.post('http://localhost:8001/login_check', d);
  }

  DeactivateUser(id: number){
    return this.Http.get('http://localhost:8001/logout');
  }

}
