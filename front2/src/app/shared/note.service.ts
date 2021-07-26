import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class NoteService {

  constructor(private Http:HttpClient) { }

  AddNote(d:any){
    return this.Http.post('http://127.0.0.1:8001/note/ajouter', d);
  }

  GetNotesPatisserie(id: number){
    return this.Http.get('http://127.0.0.1:8001/note/patisserie/' + id);
  }

  GetNotesProduit(id: number){
    return this.Http.get('http://127.0.0.1:8001/note/produit/' + id);
  }

}
