import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Publication } from '../model/publication';
import { PublicationService } from '../services/publication.service';

@Component({
  selector: 'app-publication-admin',
  templateUrl: './publication-admin.component.html',
  styleUrls: ['./publication-admin.component.css']
})
export class PublicationAdminComponent implements OnInit {

  listPub: Publication[];
  constructor(private servicePublication: PublicationService, private router: Router) { }

  ngOnInit(): void {
    this.servicePublication.getPublications().subscribe(
      (res: Publication[]) => {this.listPub = res; console.log(this.listPub); }
    );
  }
  delete(id: number){
    this.servicePublication.deletePublication(id).subscribe(
      () => this.listPub = this.listPub.filter(pat => pat.idPublication !== id)
    )
  }

}
