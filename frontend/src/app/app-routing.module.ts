import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { UserComponent } from './user/user.component';
import { LoginComponent } from './login/login.component';
import { AppComponent } from './app.component';

const routes: Routes = [
	{
		path: 'profile',
		component: UserComponent,
		data: { title: 'User profile' }
	},
  {
		path: 'login',
		component: LoginComponent,
		data: { title: 'Login' }
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
