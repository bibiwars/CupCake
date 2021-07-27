import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ShowCommandesComponent } from './show-commandes.component';

describe('ShowCommandesComponent', () => {
  let component: ShowCommandesComponent;
  let fixture: ComponentFixture<ShowCommandesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowCommandesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ShowCommandesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
