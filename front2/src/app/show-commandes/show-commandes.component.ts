import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Commande } from '../commande/commande';
import { ShowCommandesService } from './show-commandes.service';
import { NotifierService } from 'angular-notifier';
import { Router } from '@angular/router';
@Component({
  selector: 'app-show-commandes',
  templateUrl: './show-commandes.component.html',
  styleUrls: ['./show-commandes.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class ShowCommandesComponent implements OnInit {
  selectedCommande: Commande = new Commande();
  filterCommandes: string = "";
  today: Date = new Date()
  commandes: Commande[] = [new Commande()];
  categoryModify: Commande = new Commande();
  rowIndex: number = 0;


  myClonedCommandes: Commande[];
  private notifier: NotifierService;
  constructor(private router: Router, public showCommandesService: ShowCommandesService, notifierService: NotifierService) {
    this.notifier = notifierService;
  }
  ngOnInit() {

    this.showCommandesService.getAllCommandes().subscribe(r => {
      this.commandes = r;
      this.myClonedCommandes = Object.assign([], this.commandes);
    });
  }
  updateFilterCommandes() {
    this.commandes = Object.assign([], this.myClonedCommandes);
    this.commandes = this.commandes.filter(a => a.ref_cmd.toUpperCase().match(this.filterCommandes.toUpperCase()));
  }


  delete(row) {
    this.showCommandesService.deleteCommande(this.commandes[this.rowIndex].id).subscribe(r => {
    });
    this.showNotification("error", "Commande " + this.commandes[this.rowIndex].ref_cmd + " effacé");
    this.commandes.splice(this.rowIndex, 1);
    this.commandes = [...this.commandes];
  }

  public showNotification(type: string, message: string): void {
    this.notifier.notify(type, message);
  }
  cv(file) {
    this.router.navigate(['/assets/' + file]);
    console.log(file);
  }
}
