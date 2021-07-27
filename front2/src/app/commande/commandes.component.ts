import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Commande } from './commande';
import { CommandesService } from './commandes.service';
import { NotifierService } from 'angular-notifier';
import { Router } from '@angular/router';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import { DatePipe } from '@angular/common';
import { ThrowStmt } from '@angular/compiler';

pdfMake.vfs = pdfFonts.pdfMake.vfs;

@Component({
  selector: 'app--commandes',
  templateUrl: './commandes.component.html',
  styleUrls: ['./commandes.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class CommandesComponent implements OnInit {
  filterCommandes: string = "";
  today: Date = new Date()
  products: any[] = [];
  commande: Commande = new Commande();
  rowIndex: number = 0;
  totalPrice: number = 0;
  user: any = {};
  private notifier: NotifierService;
  constructor(public datepipe: DatePipe, private router: Router, public CommandesService: CommandesService, notifierService: NotifierService) {
    this.notifier = notifierService;
  }
  ngOnInit() {
    this.user = JSON.parse(localStorage.getItem('user'));
    this.products = JSON.parse(localStorage.getItem('products'));
    for (let i of this.products) {
      this.totalPrice += i.prix;
    }

  }
  public showNotification(type: string, message: string): void {
    this.notifier.notify(type, message);
  }
  makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() *
        charactersLength));
    }
    return result;
  }

  decrease(row, rowIndex) {
    this.totalPrice -= row.prix / row.number;
    console.log(this.totalPrice);
    if (row.number > 1) {
      row.prix = row.prix - row.prix / row.number
      row.number -= 1;
    }
    else {
      this.products.splice(rowIndex, 1);
      this.products = [...this.products];
    }
    localStorage.setItem('products', JSON.stringify(this.products));
  }
  add(row) {
    this.totalPrice += row.prix / row.number;
    row.prix = row.prix + row.prix / row.number
    row.number += 1;
    localStorage.setItem('products', JSON.stringify(this.products));
  }

  public Notification(type: string, message: string): void {
    this.notifier.notify(type, message);
  }
  send() {
    this.totalPrice = 0;
    this.commande.ref_cmd = this.makeid(19);
    this.commande.etat_cmd = this.user.username;
    this.commande.products = this.products;
    this.commande.date_cmd = new Date();
    localStorage.setItem('products', "[]");
    this.products = [];
    this.generatePdf(this.commande, 'download');
    this.CommandesService.addCommande(this.commande).subscribe(r => {
      this.showNotification("success", "Commande validé");
      this.router.navigate(['/payment']);
    }, error => this.showNotification("error", "erreur"));

  }
  async generatePdf(commande, action = 'download') {
    let title = "facture"
    let list = [['Nombre', 'Désignation', 'prix']]
    for (let i of this.commande.products) {
      list = [...list, [i.number, i.designation, i.prix]];
    }

    const documentDefinition =
    {
      content: [

        {
          text: (title),
          bold: true,
          fontSize: 20,
          alignment: 'center',
          margin: [0, 0, 0, 20]
        },

        {
          text: 'Réference ' + commande.ref_cmd,
          style: 'header'
        },
        {
          text: 'Client ' + this.user.user_name,
          style: 'header'
        },
        {
          style: 'tableExample',
          table: {
            body: list
          }
        },
        {
          margin: [0, 30, 0, 0],
          text: '                           Tunis, le' + this.datepipe.transform(commande.date_cmd, 'dd/MM/yyyy'),
        }
      ],

      styles: {
        header: {
          fontSize: 18,
          bold: true,
          margin: [0, 20, 0, 10],
          decoration: 'underline'
        },
        name: {
          fontSize: 16,
          bold: true
        },
        jobTitle: {
          fontSize: 14,
          bold: true,
          italics: true
        },
        sign: {
          margin: [0, 50, 0, 10],
          alignment: 'right',
          italics: true
        },
        tableHeader: {
          bold: true,
        }
      }
    };
    const pdfDocGenerator = pdfMake.createPdf(documentDefinition);
    pdfDocGenerator.getBase64((image) => {

      this.CommandesService.uploadpdf(this.commande.ref_cmd, image).subscribe(r => {
      })
    });


    switch (action) {
      case 'open': pdfMake.createPdf(documentDefinition).open(); break;
      case 'print': pdfMake.createPdf(documentDefinition).print(); break;
      case 'download': pdfMake.createPdf(documentDefinition).download(); break;
      default: pdfMake.createPdf(documentDefinition).open(); break;
    }
  }

}