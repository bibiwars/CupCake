import { Component, OnInit } from '@angular/core';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {
  id=0;
  user: any;
  constructor(private serviceUser: UserService) { }

  ngOnInit(): void {
    this.serviceUser.GetLoggedinUser().subscribe(
			(data) => {
        let str = JSON.stringify(data);
        let jsonobj = JSON.parse(str);
				this.id = jsonobj.id;
        console.log(this.id);
          this.serviceUser.GetUserById(this.id).subscribe(
            (data) => {
              this.user = data;
              console.log(data)
            }
          );
			}
		);
    
  }

}
