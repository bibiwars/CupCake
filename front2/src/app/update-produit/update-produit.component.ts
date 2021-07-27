import { Component, OnInit } from '@angular/core';
import {Produit} from '../model/produit';
import {ActivatedRoute} from '@angular/router';
import {ProduitService} from '../services/produit.service';

@Component({
  selector: 'app-update-produit',
  templateUrl: './update-produit.component.html',
  styleUrls: ['./update-produit.component.css']
})
export class UpdateProduitComponent implements OnInit {

  produit: Produit;
  constructor(private service: ActivatedRoute, private serviceProduit: ProduitService) { }

  ngOnInit(): void {
    this.produit = new Produit();
    this.serviceProduit.getProduit(this.service.snapshot.params.id).subscribe(
      (res: Produit) => this.produit = res
    );
    
  }
  update(){
    this.produit.idpatisserie = this.service.snapshot.params.id;
    this.serviceProduit.updateProduit(this.produit);
  }

}
