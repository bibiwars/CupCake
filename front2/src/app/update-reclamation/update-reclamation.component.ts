import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Reclamation } from '../model/reclamation';
import { ReclamationsComponent } from '../reclamations/reclamations.component';
import { ReclamationService } from '../services/reclamation.service';

@Component({
  selector: 'app-update-reclamation',
  templateUrl: './update-reclamation.component.html',
  styleUrls: ['./update-reclamation.component.css']
})
export class UpdateReclamationComponent implements OnInit {

  reclamation: Reclamation;
  constructor(private serviceReclamation: ReclamationService, private service: ActivatedRoute) { }

  ngOnInit(): void {
    this.reclamation =new Reclamation();
    this.serviceReclamation.getReclamation(this.service.snapshot.params.id).subscribe(
      (res: Reclamation) => this.reclamation = res
    );
  }
  update(){
    this.serviceReclamation.updateReclamation(this.reclamation);
  }

}
