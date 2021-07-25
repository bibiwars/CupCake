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
        alert(data);
        // if invalid: return an error
        // else: localStorage.setItem('jwt', JSON.stringify(response));
      }
    );
  }

}
