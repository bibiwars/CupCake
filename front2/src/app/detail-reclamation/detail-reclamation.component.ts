import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {Reclamation} from '../model/reclamation';
import {ReclamationService} from '../services/reclamation.service';

@Component({
  selector: 'app-detail-reclamation',
  templateUrl: './detail-reclamation.component.html',
  styleUrls: ['./detail-reclamation.component.css']
})
export class DetailReclamationComponent implements OnInit {
  reclamation: Reclamation;
  constructor(private service: ActivatedRoute, private serviceReclamation: ReclamationService, private router: Router) { }

  ngOnInit(): void {
    this.reclamation = new Reclamation();
    this.serviceReclamation.getReclamation(this.service.snapshot.params.id).subscribe(
      (res: Reclamation) => {
        console.log(res);
        if ( res === null){
          this.router.navigate(['mesreclamations']);
        }
        else{
          this.reclamation = res;
        }
      }
    );
  }

}
