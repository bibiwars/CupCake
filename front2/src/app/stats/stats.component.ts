import { Component, OnInit } from '@angular/core';
import {ReclamationService} from '../services/reclamation.service';
import { ChartType, Row } from "angular-google-charts";

@Component({
  selector: 'app-stats',
  templateUrl: './stats.component.html',
  styleUrls: ['./stats.component.css']
})
export class StatsComponent implements OnInit {

  constructor(private serviceReclamation: ReclamationService){}
  title = 'Statistiques des reclamations';
  type = ChartType.PieChart; // 'PieChart'
  data: [(string | number)[], (string | number)[]];
  columnNames = ['Name', 'Percentage'];
  options = {
  };
  width = 500;
  height = 300;
  type1 = 0;
  type2 = 0;
  ngOnInit() {
    this.serviceReclamation.calculeReclamation('type 1').subscribe(
      (res: number) => {
        this.type1 = res;
        console.log(res);
      }
    );
    this.serviceReclamation.calculeReclamation('type 2').subscribe(
      (res: number) => this.type2 = res
    );
    console.log('type 1 :' + this.type1);
    this.type1 = 1;
    this.type2 = 2;
    this.data = [
      ['Type 1', this.type1],
      ['Type 2', this.type2]
    ];
  }

}
