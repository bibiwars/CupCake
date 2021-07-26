import { TestBed } from '@angular/core/testing';

import { PatisserieServiceService } from './patisserie-service.service';

describe('PatisserieServiceService', () => {
  let service: PatisserieServiceService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PatisserieServiceService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
