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

  ngOnInit(): void { }

  Login(d:any) {
    this.serviceAuth.Login(d).subscribe(
      (data) => { alert(data) }
    );
  }

}
