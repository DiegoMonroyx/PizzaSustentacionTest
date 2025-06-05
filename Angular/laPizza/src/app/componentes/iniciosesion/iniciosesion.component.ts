import { Component } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from '../../../environments/environment';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-iniciosesion',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './iniciosesion.component.html',
  styleUrls: ['./iniciosesion.component.css'] // Corregido aquí
})
export class IniciosesionComponent {
  form: FormGroup;

  constructor(private http: HttpClient, private router: Router) {
    this.form = new FormGroup({
      UsuarioDocumento: new FormControl(''),
      Correo: new FormControl(''),
      Contrasena: new FormControl('')
    });
  }

  onLogin() {
    if (this.form.valid) {
      const datos = this.form.value;
      this.http.post<{ token: string, usuario: any }>(`${environment.apiUrl}/login`, datos)
        .subscribe({
          next: (respuesta) => {
            console.log('Inicio de sesión exitoso', respuesta);
            if (respuesta.token && respuesta.usuario.idTipoUsuario) {
              localStorage.setItem('token', respuesta.token);
              localStorage.setItem('idTipoUsuario', respuesta.usuario.idTipoUsuario);
              localStorage.setItem('documento', respuesta.usuario.UsuarioDocumento);
              this.router.navigate(['/disboard']);
            } else {
              console.log('Respuesta inesperada:', respuesta);
            }
          },
          error: (error) => {
            console.log('Error en el inicio de sesión', error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Datos incorrectos. Por favor, verifica tu correo, documento o contraseña.',
              confirmButtonColor: '#d33',
              confirmButtonText: 'Entendido'
            });
          }

        });
    } else {
      console.log('Formulario no válido');
    }
  }

  irARegistro() {
    this.router.navigate(['/formulario']); // Agregada la función para redirigir al registro
  }
}
