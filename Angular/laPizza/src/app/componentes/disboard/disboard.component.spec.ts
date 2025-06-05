import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DisboardComponent } from './disboard.component';

describe('DisboardComponent', () => {
  let component: DisboardComponent;
  let fixture: ComponentFixture<DisboardComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DisboardComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DisboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
