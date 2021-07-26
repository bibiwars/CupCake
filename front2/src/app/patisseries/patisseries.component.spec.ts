import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PatisseriesComponent } from './patisseries.component';

describe('PatisseriesComponent', () => {
  let component: PatisseriesComponent;
  let fixture: ComponentFixture<PatisseriesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PatisseriesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PatisseriesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
