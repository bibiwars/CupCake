import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdatePatisserieComponent } from './update-patisserie.component';

describe('UpdatePatisserieComponent', () => {
  let component: UpdatePatisserieComponent;
  let fixture: ComponentFixture<UpdatePatisserieComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UpdatePatisserieComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UpdatePatisserieComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
