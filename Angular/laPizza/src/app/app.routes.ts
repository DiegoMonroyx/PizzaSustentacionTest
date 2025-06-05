import { Routes } from '@angular/router';
import { FormularioComponent } from './componentes/formulario/formulario.component';
import { IniciosesionComponent } from './componentes/iniciosesion/iniciosesion.component';
import { DisboardComponent } from './componentes/disboard/disboard.component';
import { authGuard } from './auth.guard';
import { TablaUsuarioComponent } from './componentes/tabla-usuario/tabla-usuario.component';
import { IframesComponent } from './componentesPhp/iframes/iframes.component';
import { ReservaComponent } from './componentes/reserva/reserva.component';
import { OrdenComponent } from './componentes/orden/orden.component';
import { EstadisticasDashboardComponent } from './componentes/graficas-estadisticas/estadisticas-dashboard/estadisticas-dashboard.component';
export const routes: Routes = [
    { path: '', redirectTo: 'inicio-sesion', pathMatch: 'full' }, // 🔹 Cambiado
    { path: 'inicio-sesion', component: IniciosesionComponent },
    { path: 'disboard', component: DisboardComponent, canActivate: [authGuard] },
    { path: 'tablaUsuario', component: TablaUsuarioComponent, canActivate: [authGuard] },
    { path: 'iframes', component: IframesComponent, canActivate: [authGuard] },
    { path: 'estadistcas-dasboard', component: EstadisticasDashboardComponent},
    { path: 'reserva', component: ReservaComponent },
    { path: 'formulario', component: FormularioComponent },
    { path: 'orden', component: OrdenComponent }
];
