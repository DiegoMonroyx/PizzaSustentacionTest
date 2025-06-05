import { Component, ChangeDetectorRef } from '@angular/core';
import { FormBuilder, FormGroup, FormArray } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { environment } from '../../../environments/environment';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-orden',
  standalone: true,
  templateUrl: './orden.component.html',
  styleUrls: ['./orden.component.css'],
  imports: [CommonModule, ReactiveFormsModule]
})
export class OrdenComponent {
  form: FormGroup;
  ingredientes = [
    { id: 'Act', nombre: 'Aceitunas' },
    { id: 'Cbll', nombre: 'Cebolla' },
    { id: 'Cdr', nombre: 'Carne de Res' },
    { id: 'Chpm', nombre: 'Champiñones' },
    { id: 'Chz', nombre: 'Chorizo' },
    { id: 'Cra', nombre: 'Cereza Almibar' },
    { id: 'Drl', nombre: 'Duraznos Almibar' },
    { id: 'jlp', nombre: 'Jalapeños' },
    { id: 'Jm', nombre: 'Jamón' },
    { id: 'Mng', nombre: 'Mango' },
    { id: 'Ms', nombre: 'Masa' },
    { id: 'Mz', nombre: 'Maíz' },
    { id: 'Pll', nombre: 'Pollo' },
    { id: 'Plt', nombre: 'Plátano' },
    { id: 'Pmto', nombre: 'Pimiento' },
    { id: 'Pna', nombre: 'Piña' },
    { id: 'Pprn', nombre: 'Pepperoni' },
    { id: 'Pst', nombre: 'Pasta de Tomate' },
    { id: 'Qs', nombre: 'Queso' },
    { id: 'sBBQ', nombre: 'Salsa BBQ' },
    { id: 'Slch', nombre: 'Salchicha' },
    { id: 'Tcn', nombre: 'Tocino' },
    { id: 'Uvp', nombre: 'Uvas Pasas' }
  ];

  constructor(
    private http: HttpClient,
    private fb: FormBuilder,
    private cdRef: ChangeDetectorRef
  ) {
    this.form = this.fb.group({
      items: this.fb.array([])
    });
  }

  get items(): FormArray {
    return this.form.get('items') as FormArray;
  }

  addItem() {
    const itemGroup = this.fb.group({
      idIngrediente: [''],
      CantidadComprada: ['']
    });

    itemGroup.reset({ idIngrediente: '', CantidadComprada: '' });

    this.items.push(itemGroup);
    this.cdRef.detectChanges();
  }

  removeItem(index: number) {
    this.items.removeAt(index);
  }

  onSubmit() {
    if (this.form.valid) {
      const datos = this.form.value;
      const documento = localStorage.getItem('documento');

      this.http.post<any>('${environment.apiUrl}/orden-compra', {
        UsuarioDocumento: documento
      }).subscribe({
        next: (respuesta) => {
          const idOrden = respuesta['Orden de Compra'].idOrden;

          const payload = {
            idOrden: idOrden,
            items: datos.items
          };

          this.http.post(`${environment.apiUrl}/orden-ingrediente`, payload)
            .subscribe({
              next: (res) => {
                console.log('Orden registrada con éxito', res);
                Swal.fire({
                  title: "Orden registrada exitosamente.",
                  icon: "success",
                  draggable: true
                });
              },
              error: (err) => {
                console.log('Error al registrar ingredientes', err);
              }
            });
        },
        error: (err) => {
          console.log('Error al crear orden de compra', err);
        }
      });

    } else {
      console.log('Formulario inválido');
    }
  }
}