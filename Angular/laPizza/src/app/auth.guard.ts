import { Injectable } from '@angular/core';
import { CanActivateFn } from '@angular/router';
import { AuthService } from './auth.service'; 
import { inject } from '@angular/core';
import { Router } from '@angular/router';

export const authGuard: CanActivateFn = (route, state) => {
 
  const authService = inject(AuthService);
  const router = inject(Router);

  if (authService.isAuthenticated()) {
    const routePath = route.url[0].path;
 
    if (routePath === 'disboard') {
       return true; // Todos los usuarios autenticados pueden acceder
    }
 
    if (routePath === 'tablaUsuario' || routePath === 'iframes') {
       if (authService.isAuthenticatedGerente()) {
        
          return true; // Solo los gerentes pueden acceder
       } else {
          router.navigate(['/disboard']); // Redirige a disboard si no es gerente
          return false;
       }
    }
 
    // Si ninguna ruta coincide, redirige a inicio-sesión
    router.navigate(['/inicio-sesion']);
    return false;
 } else {
    router.navigate(['/inicio-sesion']); // Redirige si no está autenticado
    return false;
 }
};

