import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-admin-user',
  templateUrl: './admin-user.component.html',
  styleUrls: ['./admin-user.component.css']
})
export class AdminUserComponent implements OnInit {
  user: any;
  constructor(private activatedroute: ActivatedRoute, private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.GetUserById(this.activatedroute.snapshot.params.id).subscribe(
			(data) => {
				this.user = data;
			}
		);
  }

  updateUser(d: any) {
		this.serviceUser.UpdateUser(this.activatedroute.snapshot.params.id, d).subscribe(
			() => {
				alert('User roles modified');
			}
		);
	}

}
