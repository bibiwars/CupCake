import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-user-reset',
  templateUrl: './user-reset.component.html',
  styleUrls: ['./user-reset.component.css']
})
export class UserResetComponent implements OnInit {
  email = "";
  divStyle1 = "block";
  divStyle2 = "none";
  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
  }

  Reset(d) {
    this.email = d.email;
    this.serviceUser.OTPUser(this.email).subscribe(
      (data) => {
        this.divStyle1 = "none";
        this.divStyle2 = "block";
      },(error) => {
				alert('Erreur.');
			}
    );
  }

  Resetpass(d:any) {
    console.log(d);
    this.serviceUser.ResetUser(d, this.email).subscribe(
      (data) => {
        console.log(data)
        window.location.href = '/login';
      },(error) => {
				alert('Erreur.');
			}
    );
  }

}
