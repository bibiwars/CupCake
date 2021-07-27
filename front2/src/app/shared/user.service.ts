import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private Http:HttpClient) { }

  Register(d:any){
    return this.Http.post('https://127.0.0.1:8001/utilisateur/ajouter', d);
  }

  GetLoggedinUser(){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/authenticated');
  }

  GetRolesUser(){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/roles');
  }

  GetUsers(){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/liste');
  }

  GetUserById(id: number){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/id/' + id);
  }

  UpdateUser(id: number, d: any){
    return this.Http.post('https://127.0.0.1:8001/utilisateur/modifier/' + id, d);
  }

  DeleteUser(id: number){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/supprimer/' + id);
  }

  ChangeUserPass(id: number, d: any){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/changerpass/' + id, d);
  }

  ActivateUser(id: number){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/activer/' + id);
  }

  DeactivateUser(id: number){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/bloquer/' + id);
  }

  OTPUser(email: string){
    return this.Http.get('https://127.0.0.1:8001/utilisateur/reset/' + email);
  }

  ResetUser(d: any, email: string){
    return this.Http.post('https://127.0.0.1:8001/utilisateur/resetpass/' + email, d);
  }

  ImgUploadUser(d: any){
    return this.Http.post('https://127.0.0.1:8001/utilisateur/', d);
  }

}
