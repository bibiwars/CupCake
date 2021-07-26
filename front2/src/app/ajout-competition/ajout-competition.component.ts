import { Component, OnInit } from '@angular/core';
import {Competition} from '../model/competition';
import {CompetitionService} from '../services/competition.service';

@Component({
  selector: 'app-ajout-competition',
  templateUrl: './ajout-competition.component.html',
  styleUrls: ['./ajout-competition.component.css']
})
export class AjoutCompetitionComponent implements OnInit {

  competition: Competition;
  constructor(private  serviceCompetition: CompetitionService) { }

  ngOnInit(): void {
    this.competition = new Competition();
  }
  save(){
    this.serviceCompetition.postCompetition(this.competition);
  }
}
