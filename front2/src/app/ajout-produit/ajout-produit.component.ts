import { Component, OnInit } from '@angular/core';
import {Produit} from '../model/produit';
import {ActivatedRoute} from '@angular/router';
import {ProduitService} from '../services/produit.service';

@Component({
  selector: 'app-ajout-produit',
  templateUrl: './ajout-produit.component.html',
  styleUrls: ['./ajout-produit.component.css']
})
export class AjoutProduitComponent implements OnInit {

  produit: Produit;
  constructor(private service: ActivatedRoute, private serviceProduit: ProduitService) { }

  ngOnInit(): void {
    this.produit = new Produit();
    this.produit.idpatisserie = this.service.snapshot.params.id;
  }
  save(){
    this.serviceProduit.postProduit(this.produit);
  }

}
