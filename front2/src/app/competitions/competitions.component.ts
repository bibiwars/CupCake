import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import { Router } from '@angular/router';
import {Competition} from '../model/competition';
import {CompetitionService} from '../services/competition.service';

@Component({
  selector: 'app-competitions',
  templateUrl: './competitions.component.html',
  styleUrls: ['./competitions.component.css']
})
export class CompetitionsComponent implements OnInit {
  listComp: Competition[];
  idComp: number;
  constructor(private serviceCompetition: CompetitionService , private router :Router) { }
  ngOnInit(): void {
    this.serviceCompetition.getCompetitions().subscribe(
      (data: Competition[]) => {
        this.listComp = data;
        console.log(data);
      }
    );
  }
  delete(id: number){
  this.serviceCompetition.deleteCompetition(id).subscribe(
    () => this.listComp = this.listComp.filter(comp => comp.idCompetition !== id)
  );
  this.router.navigate(['admin/competitions']);
  }
  setCurrentComp(idComp: number){
    this.idComp = idComp;
  }

}
