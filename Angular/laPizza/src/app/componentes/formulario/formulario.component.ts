import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, FormBuilder, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { RouterLink, RouterOutlet } from '@angular/router';
import { ClienteService } from '../../cliente.service';
import { CommonModule } from '@angular/common';
import { environment } from '../../../environments/environment';

@Component({
  selector: 'app-formulario',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterLink, RouterOutlet],
  templateUrl: './formulario.component.html',
  styleUrls: ['./formulario.component.css'] 
})
export class FormularioComponent implements OnInit {
  form: FormGroup;
  tiposUsuario = [{ idTipoUsuario: 3, tipoUsuario: 'Cliente' }];
  tiposDocumento = [
    { idTipoDocumento: 1, tipoDocumento: 'Cédula de ciudadanía' },
    { idTipoDocumento: 2, tipoDocumento: 'Cédula extranjera' },
    { idTipoDocumento: 3, tipoDocumento: 'Pasaporte' }
  ];

  constructor(private http: HttpClient, private router: Router, private fb: FormBuilder, private clienteService: ClienteService) {
    this.form = this.fb.group({
      UsuarioDocumento: ['', [Validators.required, Validators.pattern('^[0-9]*$')]], 
      UsuarioTelefono: ['', [Validators.required, Validators.pattern('^[0-9]*$')]], 
      Contrasena: ['', [Validators.required, Validators.minLength(6)]], 
      Correo: ['', [Validators.required, Validators.email]], 
      UsuarioPrimerNombre: ['', Validators.required], 
      UsuarioApellido: ['', Validators.required], 
      idTipoDocumento: ['', Validators.required], 
      idTipoUsuario: [this.tiposUsuario[0].idTipoUsuario, Validators.required] 
    });
  }

  ngOnInit() {
    this.clienteService.getTiposDocumento().subscribe(tipos => {
      console.log('Tipos de documento recibidos:', tipos); 
      this.tiposDocumento = tipos; 
    }, error => {
      console.error('Error al obtener tipos de documento:', error);
    });
  }
  

  onSubmit() {
  console.log('Formulario inválido:', this.form.invalid);
  if (this.form.valid) {
    const datos = this.form.value;
    const url = `${environment.apiUrl}/pizzapaisa`;
    console.log('URL para enviar:', url);
    this.http.post(url, datos).subscribe({
      next: (respuesta) => {
        console.log('Datos enviados exitosamente', respuesta);
        this.router.navigate(['/inicio-sesion']);
      },
      error: (error) => {
        console.log('Hubo un error al enviar los datos', error);
      }
    });
  } else {
    console.log('Error en el formulario');
  }
}
}