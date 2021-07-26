import { Component, OnInit } from '@angular/core';
import {Patisserie} from '../model/patisserie';
import {PatisserieServiceService} from '../services/patisserie-service.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-ajout-patisserie',
  templateUrl: './ajout-patisserie.component.html',
  styleUrls: ['./ajout-patisserie.component.css']
})
export class AjoutPatisserieComponent implements OnInit {
  patisserie: Patisserie;
  constructor(private servicePatisserie: PatisserieServiceService, private router: Router) { }

  ngOnInit(): void {
    this.patisserie = new Patisserie();
  }

  save(){
    this.patisserie.idutilisateur = 1;
    this.patisserie.activer = 1;
    this.servicePatisserie.postPatisserie(this.patisserie);
  }

}
