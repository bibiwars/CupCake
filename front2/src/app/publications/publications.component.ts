import { Component, OnInit } from '@angular/core';
import {Publication} from '../model/publication';
import {PublicationService} from '../services/publication.service';

@Component({
  selector: 'app-publications',
  templateUrl: './publications.component.html',
  styleUrls: ['./publications.component.css']
})
export class PublicationsComponent implements OnInit {
  listPub: Publication[];
  constructor(private servicePublication: PublicationService) { }

  ngOnInit(): void {
    this.servicePublication.getPublications().subscribe(
      (res: Publication[]) => {this.listPub = res; console.log(res); }
    );
  }

}
