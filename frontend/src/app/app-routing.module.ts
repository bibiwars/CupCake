import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { AdminUserComponent } from './admin-user/admin-user.component';
import { AdminUsersComponent } from './admin-users/admin-users.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { UserRegisterComponent } from './user-register/user-register.component';
import { UserResetComponent } from './user-reset/user-reset.component';
import { UserSettingsComponent } from './user-settings/user-settings.component';

const routes: Routes = [
	{
		path: 'login',
		component: LoginComponent,
		data: { title: 'Login' }
	},
	{
		path: 'register',
		component: UserRegisterComponent,
		data: { title: 'Register' }
	},
	{
		path: 'profile/:username',
		component: UserProfileComponent,
		data: { title: 'UserProfile' }
	},
	{
		path: 'reset',
		component: UserResetComponent,
		data: { title: 'UserReset' }
	},
	{
		path: 'settings',
		component: UserSettingsComponent,
		data: { title: 'UserSettings' }
	},
	{
		path: 'admin/user/:id',
		component: AdminUserComponent,
		data: { title: 'AdminUser' }
	},
	{
		path: 'admin/users',
		component: AdminUsersComponent,
		data: { title: 'AdminUsers' }
	},
  	{
		path: '**',
		redirectTo: '/login'
	}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
