import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AjoutPatisserieComponent } from './ajout-patisserie.component';

describe('AjoutPatisserieComponent', () => {
  let component: AjoutPatisserieComponent;
  let fixture: ComponentFixture<AjoutPatisserieComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AjoutPatisserieComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AjoutPatisserieComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
