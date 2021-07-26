import { Component, OnInit, Input } from '@angular/core';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent implements OnInit {
  //@Input() creds: TeamComponent;
  constructor(private serviceAuth: AuthService) { }

  ngOnInit(): void {
    let loggedin = 1;
  }
  Login(d:any) {
    this.serviceAuth.Login(d).subscribe(
      (data) => {
        let str = JSON.stringify(data);
        let jsonobj = JSON.parse(str);
        if(jsonobj.token!=''){
          localStorage.setItem('jwt', jsonobj.token);
          window.location.href = '/';
        }else{
          alert('Erreur.');
        }
      },(error) => {
				alert('Invalide.');
			}
    );
  }

}
