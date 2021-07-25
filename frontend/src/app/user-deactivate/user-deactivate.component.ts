import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-deactivate',
  templateUrl: './user-deactivate.component.html',
  styleUrls: ['./user-deactivate.component.css']
})
export class UserDeactivateComponent implements OnInit {

  constructor(private activatedroute: ActivatedRoute, private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.DeactivateUser(this.activatedroute.snapshot.params.id).subscribe(
			(data) => {
				window.location.href = '/admin/users';
			}
		);
  }

}
