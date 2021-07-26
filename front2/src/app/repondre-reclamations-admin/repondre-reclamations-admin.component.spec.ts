import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RepondreReclamationsAdminComponent } from './repondre-reclamations-admin.component';

describe('RepondreReclamationsAdminComponent', () => {
  let component: RepondreReclamationsAdminComponent;
  let fixture: ComponentFixture<RepondreReclamationsAdminComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RepondreReclamationsAdminComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RepondreReclamationsAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
