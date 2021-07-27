import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {RouterModule, Routes} from '@angular/router';
import {PatisseriesComponent} from './patisseries/patisseries.component';
import {AjoutPatisserieComponent} from './ajout-patisserie/ajout-patisserie.component';
import {AjoutProduitComponent} from './ajout-produit/ajout-produit.component';
import {Produit} from './model/produit';
import {ProduitsComponent} from './produits/produits.component';
import {UpdatePatisserieComponent} from './update-patisserie/update-patisserie.component';
import {CompetitionsComponent} from './competitions/competitions.component';
import {AjoutCompetitionComponent} from './ajout-competition/ajout-competition.component';
import {UpdateCompetitionComponent} from './update-competition/update-competition.component';
import {UpdateProduitComponent} from './update-produit/update-produit.component';
import {NotFoundComponent} from './not-found/not-found.component';

import {PublicationsComponent} from './publications/publications.component';
import {AjoutReclamationComponent} from './ajout-reclamation/ajout-reclamation.component';
import {ReclamationsComponent} from './reclamations/reclamations.component';
import {ReclamationsAdminComponent} from './reclamations-admin/reclamations-admin.component';
import {RepondreReclamationsAdminComponent} from './repondre-reclamations-admin/repondre-reclamations-admin.component';
import {DetailReclamationComponent} from './detail-reclamation/detail-reclamation.component';
import {StatsComponent} from './stats/stats.component';
import {AvisAdminComponent} from './avis-admin/avis-admin.component';

import { LoginComponent } from './login/login.component';
import { LogoutComponent } from './logout/logout.component';
import { AdminUserComponent } from './admin-user/admin-user.component';
import { AdminUsersComponent } from './admin-users/admin-users.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import { UserRegisterComponent } from './user-register/user-register.component';
import { UserResetComponent } from './user-reset/user-reset.component';
import { UserSettingsComponent } from './user-settings/user-settings.component';
import { UserActivateComponent } from './user-activate/user-activate.component';
import { UserDeactivateComponent } from './user-deactivate/user-deactivate.component';
import { UserDeleteComponent } from './user-delete/user-delete.component';
import { PublicationAdminComponent } from './publication-admin/publication-admin.component';
import { UpdatePublicationComponent } from './update-publication/update-publication.component';


const ROUTES: Routes = [
  {path: '', redirectTo: '/pat', pathMatch: 'full'},
  {path: 'pat', component: PatisseriesComponent},
  {path: 'pat/add', component: AjoutPatisserieComponent},
  {path: 'pat/update/:id', component: UpdatePatisserieComponent},
  {path: 'pat/:id/produit/add', component: AjoutProduitComponent},
  {path: 'pat/produits/:id', component: ProduitsComponent},
  {path: 'produit/update/:id', component: UpdateProduitComponent},
  {path: 'admin/competitions', component: CompetitionsComponent},
  {path: 'admin/competition/add', component: AjoutCompetitionComponent},
  {path: 'admin/competition/update/:id', component: UpdateCompetitionComponent},
  {path: 'publications', component: PublicationsComponent},
  {path: 'reclamation/add', component: AjoutReclamationComponent},
  {path: 'mesreclamations', component: ReclamationsComponent},
  {path: 'reclamation/detail/:id', component: DetailReclamationComponent},
  {path: 'admin/reclamations', component: ReclamationsAdminComponent},
  {path: 'admin/reclamation/repondre/:id', component: RepondreReclamationsAdminComponent},
  {path: 'admin/reclamations/stats', component: StatsComponent},
  {path: 'admin/avis', component: AvisAdminComponent},
  {path: 'admin/publications', component: PublicationAdminComponent},
  {path: 'admin/publication/update/:id', component: UpdatePublicationComponent},
  
  {  path: 'login',   component: LoginComponent,   data: { title: 'Login' } },
  {  path: 'logout',   component: LogoutComponent,   data: { title: 'Logout' } },
  {  path: 'register',   component: UserRegisterComponent,   data: { title: 'Register' } },
  {  path: 'profile',   component: UserProfileComponent,   data: { title: 'UserProfile' } },
  {  path: 'reset',   component: UserResetComponent,   data: { title: 'UserReset' } },
  {  path: 'settings',   component: UserSettingsComponent,   data: { title: 'UserSettings' } },
  {  path: 'admin/user/:id',   component: AdminUserComponent,   data: { title: 'AdminUser' } },
  {  path: 'admin/users',   component: AdminUsersComponent,   data: { title: 'AdminUsers' } },
  {  path: 'u/activate/:id',   component: UserActivateComponent,   data: { title: 'UserActivate' } },
  {  path: 'u/deactivate/:id',   component: UserDeactivateComponent,   data: { title: 'UserDeactivate' } },
  {  path: 'u/delete/:id',   component: UserDeleteComponent,   data: { title: 'UserDelete' } },
  
  {path: '**', component: NotFoundComponent},
  
];

@NgModule({
  declarations: [],
  imports: [
    RouterModule.forRoot(ROUTES),
    CommonModule
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }












