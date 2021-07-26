import { Component } from '@angular/core';
import { UserService } from './shared/user.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  serviceUser: UserService;
  title = 'cupcakeF';
  /*loggedin = 1;
  id = 1;
  jwt = localStorage.getItem('jwt');
  if(jwt){
    this.loggedin = 0;
  }*/
}
