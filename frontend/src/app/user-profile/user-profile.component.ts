import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {
  id=1; //id = this user
  user: any;
  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.GetUserById(this.id).subscribe(
			(data) => {
				this.user = data;
			}
		);
  }

}
