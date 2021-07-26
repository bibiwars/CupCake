import { Component, OnInit , Input} from '@angular/core';
import {Publication} from '../model/publication';
@Component({
  selector: 'app-publication',
  templateUrl: './publication.component.html',
  styleUrls: ['./publication.component.css']
})
export class PublicationComponent implements OnInit {
  @Input() pub: Publication = new Publication();
  constructor() { }

  ngOnInit(): void {
  }

}
