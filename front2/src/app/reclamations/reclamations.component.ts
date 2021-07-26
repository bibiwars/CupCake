import { Component, OnInit } from '@angular/core';
import {Reclamation} from '../model/reclamation';
import {ReclamationService} from '../services/reclamation.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-reclamations',
  templateUrl: './reclamations.component.html',
  styleUrls: ['./reclamations.component.css']
})
export class ReclamationsComponent implements OnInit {
  listRec: Reclamation[];
  constructor(private serviceReclamation: ReclamationService, private route: Router) { }

  ngOnInit(): void {
    this.serviceReclamation.getMesReclamations(4).subscribe(
      (res: Reclamation[]) => this.listRec = res
    );
  }

  delete(idreclamation: number){
    this.serviceReclamation.deleteReclamation(idreclamation).subscribe(
      () => this.listRec = this.listRec.filter(rec => rec.idReclamation !== idreclamation)
    );
    this.route.navigate(['mesreclamations']);
  }
}
