import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { SafeUrlPipe } from '../pipes/safe-url.pipe';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-iframes',
  standalone: true,
  imports: [SafeUrlPipe, CommonModule],
  templateUrl: './iframes.component.html',
  styleUrls: ['./iframes.component.css']
})
export class IframesComponent implements OnInit{
  iframeUrl: string = '';

  constructor(private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.iframeUrl = params['url'] || '';
    });
  }
}
