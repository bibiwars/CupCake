import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-activate',
  templateUrl: './user-activate.component.html',
  styleUrls: ['./user-activate.component.css']
})
export class UserActivateComponent implements OnInit {

  constructor(private activatedroute: ActivatedRoute, private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.ActivateUser(this.activatedroute.snapshot.params.id).subscribe(
			(data) => {
				window.location.href = '/admin/users';
			}
		);
  }

}
