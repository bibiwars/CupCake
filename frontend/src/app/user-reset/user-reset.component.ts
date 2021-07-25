import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-user-reset',
  templateUrl: './user-reset.component.html',
  styleUrls: ['./user-reset.component.css']
})
export class UserResetComponent implements OnInit {
  email = "";
  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
  }

  Reset(email:string) {
    this.email = email;
    this.serviceUser.OTPUser(email).subscribe(
      (data) => {
        alert(data);
        // if invalid: return an error
        // else: localStorage.setItem('jwt', JSON.stringify(response));
      }
    );
  }

  Resetpass(d:any) {
    this.serviceUser.ResetUser(d, this.email).subscribe(
      (data) => {
        alert(data);
        // if invalid: return an error
        // else: localStorage.setItem('jwt', JSON.stringify(response));
      }
    );
  }

}
