import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-admin-users',
  templateUrl: './admin-users.component.html',
  styleUrls: ['./admin-users.component.css']
})
export class AdminUsersComponent implements OnInit {
  users: any;
  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.GetUsers().subscribe(
			(data) => {
				this.users = data;
        console.log(data);
			}
		);
  }

}
