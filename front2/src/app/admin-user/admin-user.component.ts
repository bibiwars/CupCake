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
	  	let role = "";
		if(d.type=="Admin")
		  role = "ROLE_ADMIN";
		if(d.type=="Client")
		  role = "ROLE_CLIENT";
		if(d.type=="Patissier")
		  	role = "ROLE_PATISSIER";
		this.serviceUser.UpdateUser(this.activatedroute.snapshot.params.id, { "roles": [role] }).subscribe(
			() => {
				//alert('User roles modified');
			}
		);
	}

}
