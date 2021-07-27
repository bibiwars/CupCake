import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ShowCondidaturesComponent } from './show-condidatures.component';

describe('ShowCondidaturesComponent', () => {
  let component: ShowCondidaturesComponent;
  let fixture: ComponentFixture<ShowCondidaturesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowCondidaturesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ShowCondidaturesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
