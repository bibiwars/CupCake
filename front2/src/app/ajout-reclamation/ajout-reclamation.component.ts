import { Component, OnInit } from '@angular/core';
import {Reclamation} from '../model/reclamation';
import {ReclamationService} from '../services/reclamation.service';

@Component({
  selector: 'app-ajout-reclamation',
  templateUrl: './ajout-reclamation.component.html',
  styleUrls: ['./ajout-reclamation.component.css']
})
export class AjoutReclamationComponent implements OnInit {
  reclamation: Reclamation;
  constructor(private serviceReclamation: ReclamationService) { }

  ngOnInit(): void {
    this.reclamation = new Reclamation();
  }
  save(){
    this.serviceReclamation.postReclamation(this.reclamation);
  }
}
