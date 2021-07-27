import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Condidature } from '../condidature/Condidature';
import { ShowCondidaturesService } from './show-condidatures.service';
import { NotifierService } from 'angular-notifier';
import { Router } from '@angular/router';
@Component({
  selector: 'app-show-condidatures',
  templateUrl: './show-condidatures.component.html',
  styleUrls: ['./show-condidatures.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ShowCondidaturesComponent implements OnInit {
  selectedCondidature: Condidature = new Condidature();
  filterCondidatures: string = "";
  today: Date = new Date()
  condidatures: Condidature[] = [new Condidature()];
  categoryModify: Condidature = new Condidature();
  rowIndex: number = 0;


  myClonedCondidatures: Condidature[];
  private notifier: NotifierService;
  constructor(private router: Router, public showCondidaturesService: ShowCondidaturesService, notifierService: NotifierService) {
    this.notifier = notifierService;
  }
  ngOnInit() {

    this.showCondidaturesService.getAllCondidatures().subscribe(r => {
      this.condidatures = r;
      this.myClonedCondidatures = Object.assign([], this.condidatures);
    });
  }
  updateFilterCondidatures() {
    this.condidatures = Object.assign([], this.myClonedCondidatures);
    this.condidatures = this.condidatures.filter(a => a.applicateur.toUpperCase().match(this.filterCondidatures.toUpperCase()));
  }


  delete(row) {
    this.showCondidaturesService.deleteCondidature(this.condidatures[this.rowIndex].id).subscribe(r => {
    });
    this.showNotification("error", "Condidature de " + this.condidatures[this.rowIndex].applicateur + " effacé");
    this.condidatures.splice(this.rowIndex, 1);
    this.condidatures = [...this.condidatures];
  }
  accept(row) {
    this.condidatures = Object.assign([], this.myClonedCondidatures);
    row.etat = "accepted";
    this.showCondidaturesService.updateCondidature(row).subscribe(r => {
      this.showNotification("success", "Condidature de " + this.condidatures[this.rowIndex].applicateur + " accepté");
    }, error => this.showNotification("error", "erreur"));
  }

  public showNotification(type: string, message: string): void {
    this.notifier.notify(type, message);
  }
  cv(file) {
    this.router.navigate(['/assets/' + file]);
    console.log(file);
  }
}
