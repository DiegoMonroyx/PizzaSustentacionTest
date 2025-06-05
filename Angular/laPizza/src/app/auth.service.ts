import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private router: Router) { }
   // verifica que el usuario este incioado
   private isBrowser(): boolean {
    return typeof window !== 'undefined' && !!window.localStorage;
  }
  
   isAuthenticated(): boolean {
    if (this.isBrowser()) {
      return !!localStorage.getItem('token');
    }
    return false;
  }
  isAuthenticatedGerente(): boolean {
    if(this.isBrowser()){
    const token = localStorage.getItem('token');
   const idTipoUsuario = localStorage.getItem('idTipoUsuario');
   return !!token && idTipoUsuario === '1';
    }
    return false;
  }

  // Cierra sesión laA sesion y eliminar el tokenn
  logout() {
    if (typeof window !== 'undefined' && window.localStorage) {// PARA verifica si el objeto window está definido y verifica si el navegador tiene la capacidad de almacenar datos
      
      localStorage.removeItem('token');  // va aa elimianr el token de el local Storage
      console.log('Token eliminado');
    }
    
    this.router.navigate(['/inicio-sesion']); 
  }
}
