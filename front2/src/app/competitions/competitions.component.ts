import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import { DatePipe } from '@angular/common';
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
  constructor(private serviceCompetition: CompetitionService , private router :Router, public datepipe: DatePipe) { }
  ngOnInit(): void {
    this.serviceCompetition.getCompetitions().subscribe(
      (data: Competition[]) => {
        this.listComp = data;
        let datax = '[';
        //console.log(data);
        for (let i of data){
          //console.log(i);
          let str = JSON.stringify(i);
          let jsonobj = JSON.parse(str);
          jsonobj.dateDebut = jsonobj.dateDebut.timestamp*1000;
          jsonobj.dateFin = jsonobj.dateFin.timestamp*1000;
          datax += JSON.stringify(jsonobj) + ',';
        }
        datax = datax.slice(0, -1);
        datax += ']';
        this.listComp = JSON.parse(datax);
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
