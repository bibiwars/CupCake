import { Component, OnInit } from '@angular/core';
import {Competition} from '../model/competition';
import {CompetitionService} from '../services/competition.service';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-update-competition',
  templateUrl: './update-competition.component.html',
  styleUrls: ['./update-competition.component.css']
})
export class UpdateCompetitionComponent implements OnInit {

  competition: Competition;
  constructor(private service: ActivatedRoute, private  serviceCompetition: CompetitionService) { }

  ngOnInit(): void {
    this.competition = new Competition();
    this.serviceCompetition.getCompetition(this.service.snapshot.params.id).subscribe(
      (res: Competition) => this.competition = res
    );
  }


  update(){
    this.serviceCompetition.updateCompetition(this.competition);
  }

}
