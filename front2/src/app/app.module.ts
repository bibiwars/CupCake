import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { DatePipe } from '@angular/common';

import { AppComponent } from './app.component';
import { JwtInterceptorService } from './shared/jwt-interceptor.service';
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

import { PublicationComponent } from './publication/publication.component';
import { AjoutReclamationComponent } from './ajout-reclamation/ajout-reclamation.component';
import { ReclamationsComponent } from './reclamations/reclamations.component';
import { ReclamationsAdminComponent } from './reclamations-admin/reclamations-admin.component';
import { RepondreReclamationsAdminComponent } from './repondre-reclamations-admin/repondre-reclamations-admin.component';
import { DetailReclamationComponent } from './detail-reclamation/detail-reclamation.component';
import { StatsComponent } from './stats/stats.component';
import { GoogleChartsModule } from 'angular-google-charts';
import { AvisAdminComponent } from './avis-admin/avis-admin.component';
import { AjoutAvisComponent } from './ajout-avis/ajout-avis.component';

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
import { PublicationAdminComponent } from './publication-admin/publication-admin.component';
import { UpdatePublicationComponent } from './update-publication/update-publication.component';
import { UpdateReclamationComponent } from './update-reclamation/update-reclamation.component';

import { CondidatureComponent } from './condidature/condidature.component';
import { AngularFileUploaderModule } from "angular-file-uploader";
import { ShowCondidaturesComponent } from './show-condidatures/show-condidatures.component';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { CommonModule } from '@angular/common';
import { NotifierModule } from 'angular-notifier';
import { CommandesComponent } from './commande/commandes.component';
import { ShowCommandesComponent } from './show-commandes/show-commandes.component';
import { PaymentComponent } from './payment/payment.component';


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
    UserDeactivateComponent,
    PublicationComponent,
    AjoutReclamationComponent,
    ReclamationsComponent,
    ReclamationsAdminComponent,
    RepondreReclamationsAdminComponent,
    DetailReclamationComponent,
    StatsComponent,
    AvisAdminComponent,
    AjoutAvisComponent,
    PublicationAdminComponent,
    UpdatePublicationComponent,
    UpdateReclamationComponent,
    CondidatureComponent,
    ShowCondidaturesComponent,
    CommandesComponent,
    ShowCommandesComponent,
    PaymentComponent
  ],
    imports: [
        AppRoutingModule,
        NgxDatatableModule,
        NotifierModule,
        CommonModule,
        BrowserModule,
        FormsModule,
        HttpClientModule,
        GoogleChartsModule,
        AngularFileUploaderModule,
    ],
  providers: [{provide: HTTP_INTERCEPTORS, useClass: JwtInterceptorService, multi: true}, DatePipe],
  bootstrap: [AppComponent]
})
export class AppModule { }
