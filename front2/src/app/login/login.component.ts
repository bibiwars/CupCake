import { Component, OnInit, Input } from '@angular/core';
import { AuthService } from '../shared/auth.service';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent implements OnInit {
  //@Input() creds: TeamComponent;
  id=0;
  user: any;
  constructor(private serviceAuth: AuthService, private serviceUser: UserService) { }

  ngOnInit(): void {
    //let loggedin = 1;
  }
  Login(d:any) {
    this.serviceAuth.Login(d).subscribe(
      (data) => {
        let str = JSON.stringify(data);
        let jsonobj = JSON.parse(str);
        if(jsonobj.token!=''){
          localStorage.setItem('jwt', jsonobj.token);
          this.serviceUser.GetLoggedinUser().subscribe(
            (data1) => {
              let str = JSON.stringify(data1);
              let jsonobj = JSON.parse(str);
              this.id = jsonobj.id;
                this.serviceUser.GetUserById(this.id).subscribe(
                  (data2) => {
                    this.user = data2;
                    localStorage.setItem('user', JSON.stringify(this.user));
                  }
                );
            }
          );

          //window.location.href = '/';
        }else{
          alert('Erreur.');
        }
      },(error) => {
				alert('Invalide.');
			}
    );
  }

}
