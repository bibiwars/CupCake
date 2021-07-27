import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Publication } from '../model/publication';
import { PublicationService } from '../services/publication.service';

@Component({
  selector: 'app-update-publication',
  templateUrl: './update-publication.component.html',
  styleUrls: ['./update-publication.component.css']
})
export class UpdatePublicationComponent implements OnInit {

  publication: Publication;
  constructor(private servicePublication: PublicationService, private service: ActivatedRoute) { }

  ngOnInit(): void {
    this.publication = new Publication();
    this.servicePublication.getPublication(this.service.snapshot.params.id).subscribe(
      (res: Publication) => {
        this.publication = res;
        console.log(res);
      }
    );
  }
  update(){
    console.log(this.publication);
    this.publication.idPublication = this.service.snapshot.params.id;
    this.servicePublication.updatePublication(this.publication,this.service.snapshot.params.id);
  }

}
