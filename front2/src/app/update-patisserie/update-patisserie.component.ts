import { Component, OnInit } from '@angular/core';
import {PatisserieServiceService} from '../services/patisserie-service.service';
import {Patisserie} from '../model/patisserie';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-update-patisserie',
  templateUrl: './update-patisserie.component.html',
  styleUrls: ['./update-patisserie.component.css']
})
export class UpdatePatisserieComponent implements OnInit {
  patisserie: Patisserie;
  id: number;
  constructor(private service: ActivatedRoute, private servicePatisserie: PatisserieServiceService) { }

  ngOnInit(): void {
    this.patisserie = new Patisserie();
    this.id = this.service.snapshot.params.id;
    this.servicePatisserie.getPatisserie(this.id).subscribe((data) => {
      this.patisserie = data;
    });
  }
  update(){
    this.servicePatisserie.updatePatisserie(this.patisserie);
  }

}
