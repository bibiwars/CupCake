import { Component, OnInit, Input } from '@angular/core';
import {Avis} from '../model/avis';
import {AvisService} from '../services/avis.service';

@Component({
  selector: 'app-ajout-avis',
  templateUrl: './ajout-avis.component.html',
  styleUrls: ['./ajout-avis.component.css']
})
export class AjoutAvisComponent implements OnInit {
  avis: Avis;
  @Input() idreclamation;
  constructor(private serviceAvis: AvisService) { }
  ngOnInit(): void {
    this.avis = new Avis();
    this.avis.note = 0;
  }

  setNote(n: number){
    this.avis.note = n;
  }
  save(){
    this.avis.idReclamation = this.idreclamation;
    this.avis.iduser = 4;
    this.serviceAvis.postAvis(this.avis);
  }

}
