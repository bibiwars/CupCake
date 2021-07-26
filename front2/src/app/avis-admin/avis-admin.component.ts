import { Component, OnInit } from '@angular/core';
import {Avis} from '../model/avis';
import {AvisService} from '../services/avis.service';

@Component({
  selector: 'app-avis-admin',
  templateUrl: './avis-admin.component.html',
  styleUrls: ['./avis-admin.component.css']
})
export class AvisAdminComponent implements OnInit {
  listAvis: Avis[];
  constructor(private serviceAvis: AvisService) { }

  ngOnInit(): void {
    this.serviceAvis.getAvis().subscribe(
      (res: Avis[]) => this.listAvis = res
    );
  }
  delete(id: number){
    this.serviceAvis.deleteAvis(id).subscribe(
      () => this.listAvis = this.listAvis.filter(avis => avis.id !== id)
    );
  }

}
