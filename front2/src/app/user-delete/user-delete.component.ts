import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-delete',
  templateUrl: './user-delete.component.html',
  styleUrls: ['./user-delete.component.css']
})
export class UserDeleteComponent implements OnInit {

  constructor(private activatedroute: ActivatedRoute, private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.DeleteUser(this.activatedroute.snapshot.params.id).subscribe(
			(data) => {
				window.location.href = '/admin/users';
			}
		);
  }

}
