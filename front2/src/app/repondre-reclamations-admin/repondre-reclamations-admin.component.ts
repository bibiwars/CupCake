import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {Reclamation} from '../model/reclamation';
import {ReclamationService} from '../services/reclamation.service';

@Component({
  selector: 'app-repondre-reclamations-admin',
  templateUrl: './repondre-reclamations-admin.component.html',
  styleUrls: ['./repondre-reclamations-admin.component.css']
})
export class RepondreReclamationsAdminComponent implements OnInit {

  reclamation: Reclamation;
  constructor(private service: ActivatedRoute, private serviceReclamtion: ReclamationService, private router: Router) { }

  ngOnInit(): void {
    this.reclamation = new Reclamation();
    this.serviceReclamtion.getReclamation(this.service.snapshot.params.id).subscribe(
      (res: Reclamation) => this.reclamation = res
    );
  }

  repondre(){
    this.serviceReclamtion.repondreReclamation(this.reclamation);
    //this.router.navigate(['admin/reclamations']);
  }
}
