import { TestBed } from '@angular/core/testing';

import { ShowCondidaturesService } from './show-condidatures.service';

describe('ShowCondidaturesService', () => {
  let service: ShowCondidaturesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ShowCondidaturesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
