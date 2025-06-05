import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { Router, NavigationEnd } from '@angular/router';
import { CabeceraComponent } from './componentes/cabecera/cabecera.component';
import { PieComponent } from './componentes/pie/pie.component';
import { FormularioComponent } from './componentes/formulario/formulario.component';
import { IniciosesionComponent } from './componentes/iniciosesion/iniciosesion.component';
import { SafeUrlPipe } from './componentesPhp/pipes/safe-url.pipe';
import { NgChartsModule } from 'ng2-charts';
@Component({
  selector: 'app-root',
  standalone: true,
  imports: [NgChartsModule,SafeUrlPipe, CommonModule,RouterOutlet,CabeceraComponent,PieComponent,FormularioComponent,IniciosesionComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'laPizza';
  mostrarCabeceraYPie = true;

  constructor(private router: Router) {

    this.router.events.subscribe((event) => {
      if (event instanceof NavigationEnd) {
        // esto va a verificar que si la ruta es el formulario de registro o logeo entonces aculta la cabecera y el pie 
        if(event.url === '/inicio-sesion' || event.url === '/formulario' || event.url === '/'){
          this.mostrarCabeceraYPie = false;

        }else{
          this.mostrarCabeceraYPie = true;
        }
      }
    });
  }
}
