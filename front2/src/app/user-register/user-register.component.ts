import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-user-register',
  templateUrl: './user-register.component.html',
  styleUrls: ['./user-register.component.css']
})
export class UserRegisterComponent implements OnInit {

  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
  }
  Register(d:any) {
    this.serviceUser.Register(d).subscribe(
      (data) => {
        let str = JSON.stringify(data);
        let jsonobj = JSON.parse(str);
        if(jsonobj.resultat!=0){
          alert("Erreur. Réessayer");
        }
        window.location.href = '/login';
      },(error) => {
				alert('Erreur inconnue.');
			}
    );
  }

}
