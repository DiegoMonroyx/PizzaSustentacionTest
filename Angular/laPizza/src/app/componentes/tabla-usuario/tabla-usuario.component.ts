import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { ClienteService } from '../../cliente.service';
import { CommonModule } from '@angular/common';
import { HttpClient } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { FormBuilder, FormGroup } from '@angular/forms';
import { environment } from '../../../environments/environment';

@Component({
  selector: 'app-tabla-usuario',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './tabla-usuario.component.html',
  styleUrls: ['./tabla-usuario.component.css']
})
export class TablaUsuarioComponent implements OnInit {

  usuario: any[] = []; // Array para almacenar los datos de los usuarios
  mensajeError: string = ''; // Mensaje en caso de error
  formularioEdicion: FormGroup;
  formularioEliminar: FormGroup;

  // Mapa de tipos de documento
  tipoDocumentoMap: { [key: number]: string } = {
    1: 'Cedula de Ciudadania',
    2: 'Cedula de Extranjeria',
    3: 'Numero de Pasaporte'
  };

  // Mapa de tipos de usuario
  tipoUsuarioMap: { [key: number]: string } = {
    1: 'Gerente',
    2: 'Encargado de Reserva',
    3: 'Cliente'
  };

  constructor(private clienteService: ClienteService, private fb: FormBuilder, private http: HttpClient) {
    this.formularioEdicion = this.fb.group({
      UsuarioDocumento: [''],
      UsuarioDocumento1: [{ value: '', disabled: true }],
      UsuarioTelefono: [''],
      Contrasena: [''],
      Correo: [''],
      UsuarioPrimerNombre: [''],
      UsuarioApellido: [''],
      idTipoDocumento: [''],
      idTipoUsuario: [''],
    });
    this.formularioEliminar = this.fb.group({
      UsuarioDocumento: ['']
    });
  }

  ngOnInit(): void {
    this.clienteService.getClientes().subscribe(
      (data) => {
        this.usuario = data;  // Asignamos los datos obtenidos a la variable usuario
      },
      (error) => {
        console.error('Error al obtener los Usuarios', error);
      }
    );
  }

  editarUsuario(usuario: any): void {
    if (usuario && usuario.UsuarioDocumento) {
      console.log('Usuario a editar:', usuario);

      // Mapeamos el idTipoDocumento al nombre usando tipoDocumentoMap
      const tipoDocumento = this.tipoDocumentoMap[usuario.idTipoDocumento];
      if (tipoDocumento) {
        console.log(`Tipo de Documento: ${tipoDocumento}`); // Imprimimos el nombre del tipo de documento
      }

      // Mapeamos el idTipoUsuario al nombre usando tipoUsuarioMap
      const tipoUsuario = this.tipoUsuarioMap[usuario.idTipoUsuario];
      if (tipoUsuario) {
        console.log(`Tipo de Usuario: ${tipoUsuario}`); // Imprimimos el nombre del tipo de usuario
      }

      this.formularioEdicion.patchValue({
        UsuarioDocumento: usuario.UsuarioDocumento,
        UsuarioDocumento1: usuario.UsuarioDocumento,
        UsuarioTelefono: usuario.UsuarioTelefono,
        Contrasena: usuario.Contrasena,
        Correo: usuario.Correo,
        UsuarioPrimerNombre: usuario.UsuarioPrimerNombre,
        UsuarioApellido: usuario.UsuarioApellido,
        idTipoDocumento: tipoDocumento || usuario.idTipoDocumento, // Asignamos el nombre del tipo de documento si existe
        idTipoUsuario: tipoUsuario || usuario.idTipoUsuario // Asignamos el nombre del tipo de usuario si existe
      });
    } else {
      console.error('Usuario no válido o sin Documento');
    }
  }

  guardarEdicion() {
    if (this.formularioEdicion.valid) {
      const datos = this.formularioEdicion.value;
      this.http.put(`${environment.apiUrl}/pizzapaisa/${datos.UsuarioDocumento}`, datos)
        .subscribe(
          (response) => {
            console.log('Usuario actualizado', response);
          },
          (error: any) => {
            console.error('Error al actualizar el usuario', error);
          }
        );
    } else {
      console.log('Formulario inválido');
    }
  }

  eliminarUsuario(usuario: any): void {
    if (usuario.UsuarioDocumento) {
      console.log('Usuario a eliminar:', usuario);
      this.formularioEliminar.patchValue({
        UsuarioDocumento: usuario.UsuarioDocumento
      });
    } else {
      console.error('Error de usuario');
    }
  }

  guardarElimin() {
    if (this.formularioEliminar.valid) {
      const datos = this.formularioEliminar.value;
      this.http.delete(`${environment.apiUrl}/pizzapaisa/${datos.UsuarioDocumento}`)
        .subscribe(
          (response) => {
            console.log('Usuario Eliminado', response);
          },
          (error: any) => {
            console.error('Error al eliminar el usuario');
          }
        );
    } else {
      console.log('Formulario inválido');
    }
  }

  // Función para obtener el nombre del tipo de documento
  obtenerTipoDocumento(id: number): string {
    return this.tipoDocumentoMap[id] || 'Tipo desconocido';
  }

  // Función para obtener el nombre del tipo de usuario
  obtenerTipoUsuario(id: number): string {
    return this.tipoUsuarioMap[id] || 'Tipo de Usuario desconocido';
  }

}
