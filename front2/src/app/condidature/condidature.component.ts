import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Condidature } from './Condidature';
import { CondidatureService } from './condidature.service';
import { NotifierService } from 'angular-notifier';

@Component({
  selector: 'app-condidature',
  templateUrl: './condidature.component.html',
  styleUrls: ['./condidature.component.css'],
  encapsulation: ViewEncapsulation.None

})
export class CondidatureComponent implements OnInit {
  condidature: Condidature = new Condidature();
  private notifier: NotifierService;
  constructor(private condidatureService: CondidatureService, notifierService: NotifierService) {
    this.notifier = notifierService;
  }
  afuConfig = {
    formatsAllowed: ".pdf,.doc,.txt",
    hideResetBtn: true,
    fileNameIndex: true,
    uploadAPI: {
      url: "https://127.0.0.1:8001/condidature/upload/"
    },
    replaceTexts: {
      selectFileBtn: 'Sélectionner CV',
      resetBtn: 'Reset',
      uploadBtn: 'Télecharger',
      afterUploadMsg_success: 'Télechargement Réussi !',
      afterUploadMsg_error: 'Echec du Télechargement!',
      sizeLimit: 'taille limite'
    }
  };
  ngOnInit(): void {
  }
  public showNotification(type: string, message: string): void {
    this.notifier.notify(type, message);
  }
  send() {
    this.condidatureService.addCondidature(this.condidature).subscribe(r => {
      this.showNotification("success", "Condidature envoyé");
    }, error => this.showNotification("error", "Champ(s) manquant(s)"));
  }
  docUpload(e) {
    this.condidature.cv = e.body;
  }
}
