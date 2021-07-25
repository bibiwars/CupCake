import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { LoginComponent } from './login/login.component';
import { UserSettingsComponent } from './user-settings/user-settings.component';
import { UserResetComponent } from './user-reset/user-reset.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { AdminUserComponent } from './admin-user/admin-user.component';
import { AdminUsersComponent } from './admin-users/admin-users.component';
import { UserRegisterComponent } from './user-register/user-register.component';
import { LogoutComponent } from './logout/logout.component';
import { UserDeleteComponent } from './user-delete/user-delete.component';
import { UserActivateComponent } from './user-activate/user-activate.component';
import { UserDeactivateComponent } from './user-deactivate/user-deactivate.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    UserSettingsComponent,
    UserResetComponent,
    UserProfileComponent,
    AdminUserComponent,
    AdminUsersComponent,
    UserRegisterComponent,
    LogoutComponent,
    UserDeleteComponent,
    UserActivateComponent,
    UserDeactivateComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
