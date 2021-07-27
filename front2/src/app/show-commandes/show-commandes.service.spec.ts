import { TestBed } from '@angular/core/testing';

import { ShowCommandesService } from './show-commandes.service';

describe('ShowCommandesService', () => {
  let service: ShowCommandesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ShowCommandesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
