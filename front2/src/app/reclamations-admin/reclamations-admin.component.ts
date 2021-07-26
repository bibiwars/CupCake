import { Component, OnInit } from '@angular/core';
import {Reclamation} from '../model/reclamation';
import {ReclamationService} from '../services/reclamation.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-reclamations-admin',
  templateUrl: './reclamations-admin.component.html',
  styleUrls: ['./reclamations-admin.component.css']
})
export class ReclamationsAdminComponent implements OnInit {

  listRec: Reclamation[];
  constructor(private serviceReclamation: ReclamationService, private route: Router) { }

  ngOnInit(): void {
    this.serviceReclamation.getReclamations().subscribe(
      (res: Reclamation[]) => this.listRec = res
    );
  }

  delete(idreclamation: number){
    this.serviceReclamation.deleteReclamation(idreclamation).subscribe(
      () => this.listRec = this.listRec.filter(rec => rec.idReclamation !== idreclamation)
    );
    this.route.navigate(['admin/reclamations']);
  }

}
