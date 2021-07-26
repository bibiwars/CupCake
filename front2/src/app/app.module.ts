import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { AjoutPatisserieComponent } from './ajout-patisserie/ajout-patisserie.component';
import { PatisseriesComponent } from './patisseries/patisseries.component';
import { AppRoutingModule } from './app-routing.module';
import { AjoutProduitComponent } from './ajout-produit/ajout-produit.component';
import { ProduitsComponent } from './produits/produits.component';
import { UpdatePatisserieComponent } from './update-patisserie/update-patisserie.component';
import { UpdateProduitComponent } from './update-produit/update-produit.component';
import { CompetitionsComponent } from './competitions/competitions.component';
import { AjoutCompetitionComponent } from './ajout-competition/ajout-competition.component';
import { UpdateCompetitionComponent } from './update-competition/update-competition.component';
import { AjoutPublicationComponent } from './ajout-publication/ajout-publication.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { PublicationsComponent } from './publications/publications.component';
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
    AjoutPatisserieComponent,
    PatisseriesComponent,
    AjoutProduitComponent,
    ProduitsComponent,
    UpdatePatisserieComponent,
    UpdateProduitComponent,
    CompetitionsComponent,
    AjoutCompetitionComponent,
    UpdateCompetitionComponent,
    AjoutPublicationComponent,
    NotFoundComponent,
    PublicationsComponent,
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
        AppRoutingModule,
        BrowserModule,
        FormsModule,
        HttpClientModule,
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
