import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AvisAdminComponent } from './avis-admin.component';

describe('AvisAdminComponent', () => {
  let component: AvisAdminComponent;
  let fixture: ComponentFixture<AvisAdminComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AvisAdminComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AvisAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
