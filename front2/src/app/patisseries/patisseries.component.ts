import { Component, OnInit } from '@angular/core';
import {PatisserieServiceService} from '../services/patisserie-service.service';
import {Patisserie} from '../model/patisserie';

@Component({
  selector: 'app-patisseries',
  templateUrl: './patisseries.component.html',
  styleUrls: ['./patisseries.component.css']
})
export class PatisseriesComponent implements OnInit {
  listPat: Patisserie[];
  constructor(private servicePatisserie: PatisserieServiceService) { }

  ngOnInit(): void {
    this.servicePatisserie.getPatisseries().subscribe(
      (data: Patisserie[]) => this.listPat = data
    );
  }
  delete(id: number){
    this.servicePatisserie.deletePatisserie(id).subscribe(
      () => this.listPat = this.listPat.filter(pat => pat.id !== id)
    );
  }

}
