import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { environment } from '../../../environments/environment';
import {
  FormBuilder,
  FormGroup,
  FormArray,
  ReactiveFormsModule,
  Validators
} from '@angular/forms';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-reserva',
  standalone: true,
  imports: [
    CommonModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  templateUrl: './reserva.component.html',
  styleUrls: ['./reserva.component.css']
})
export class ReservaComponent implements OnInit {
  form: FormGroup;
  resumenPedido: {
    FechaHoraEntrega?: string;
    pizzas?: Array<{ idSabor: string; NumeroPorciones: number; nombre: string }>;
    TotalPrecio?: number;
  } = {};

  horasDisponibles: string[] = [];
  minFecha = '';
  maxFecha = '';

  pizzasDisponibles = [
    { id: 'Crt', nombre: 'Pizza Carne' },
    { id: 'PcBBQ', nombre: 'Pizza de Carne BBQ' },
    { id: 'Phw', nombre: 'Pizza Hawaiana' },
    { id: 'Pllc', nombre: 'Pollo Champiñones' },
    { id: 'Pm', nombre: 'Pizza de Maduro' },
    { id: 'Pmt', nombre: 'Pizza Mango Tocineta' },
    { id: 'Pmx', nombre: 'Pizza Mexicana' },
    { id: 'Pps', nombre: 'Pizza Paisa' },
    { id: 'Prh', nombre: 'Pizza Ranchera' },
    { id: 'Ptrp', nombre: 'Pizza Tropical' }
  ];

  constructor(private fb: FormBuilder, private http: HttpClient) {
    // Definimos el FormGroup con fecha, hora y el array de pizzas
    this.form = this.fb.group({
      fecha: ['', Validators.required],
      hora: ['', Validators.required],
      pizzas: this.fb.array(
        this.pizzasDisponibles.map(p => this.crearPizzaFormGroup(p))
      )
    });
  }

  ngOnInit(): void {
    this.setFechasValidas();
    this.generarHorasDisponibles();
  }

  private crearPizzaFormGroup(pizza: { id: string; nombre: string }): FormGroup {
    return this.fb.group({
      idSabor: [pizza.id],
      NumeroPorciones: [0]
    });
  }

  get pizzas(): FormArray {
    return this.form.get('pizzas') as FormArray;
  }

  private generarHorasDisponibles() {
    const horas: string[] = [];
    for (let h = 15; h <= 22; h++) {
      horas.push(this.formatearHora(h, 0));
      if (h !== 22) horas.push(this.formatearHora(h, 30));
    }
    this.horasDisponibles = horas;
  }

  private formatearHora(h: number, m: number): string {
    return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
  }

  private setFechasValidas() {
    const hoy = new Date();
    const dia = hoy.getDay();
    // Calcular días hasta el viernes si no estamos ya en viernes/sábado/domingo
    let diasHastaViernes = dia > 5 ? 12 - dia : 5 - dia;
    if ([5, 6, 0].includes(dia)) diasHastaViernes = 0;

    const proxViernes = new Date(hoy);
    proxViernes.setDate(hoy.getDate() + diasHastaViernes);
    // Mínimo: próximo viernes
    this.minFecha = proxViernes.toISOString().slice(0, 10);

    // Máximo: domingo siguiente
    const domingo = new Date(proxViernes);
    domingo.setDate(proxViernes.getDate() + 2);
    this.maxFecha = domingo.toISOString().slice(0, 10);
  }

  private esFechaHoraValida(fecha: string, hora: string): boolean {
    const dt = new Date(`${fecha}T${hora}`);
    if (isNaN(dt.getTime())) return false;
    const d = dt.getDay(), h = dt.getHours(), m = dt.getMinutes();
    return [5, 6, 0].includes(d)        // viernes(5), sábado(6), domingo(0)
      && ((h > 15) || (h === 15 && m >= 0))
      && ((h < 22) || (h === 22 && m <= 30))
      && (m === 0 || m === 30);
  }

  prepararResumen() {
    if (this.form.invalid) {
      Swal.fire('Error', 'Debes seleccionar fecha, hora y al menos una pizza.', 'error');
      return;
    }

    const { fecha, hora, pizzas } = this.form.value;

    if (!this.esFechaHoraValida(fecha, hora)) {
      Swal.fire(
        'Fecha/hora inválida',
        'Solo viernes, sábado o domingo de 15:00 a 22:30 en pasos de 30 min.',
        'error'
      );
      return;
    }

    // Añadimos los nombres y filtramos solo pizzas con >0 porciones
    const seleccionadas = pizzas
      .map((p: any, i: number) => ({
        ...p,
        nombre: this.pizzasDisponibles[i].nombre
      }))
      .filter((p: any) => p.NumeroPorciones > 0);

    if (seleccionadas.length === 0) {
      Swal.fire('Atención', 'Selecciona al menos una pizza.', 'warning');
      return;
    }

    // Calculamos total
    const total = seleccionadas.reduce(
      (sum: number, p: any) => sum + p.NumeroPorciones * 14000,
      0
    );

    // Preparamos objeto para el modal
    this.resumenPedido = {
      FechaHoraEntrega: `${fecha}T${hora}`,
      pizzas: seleccionadas,
      TotalPrecio: total
    };
  }

  confirmarReserva() {
    if (!this.resumenPedido.FechaHoraEntrega) {
      Swal.fire('Error', 'No hay datos para enviar.', 'error');
      return;
    }

    // Petición al backend
    this.http
      .post(`${environment.apiUrl}/reserva`, {
        FechaHoraEntrega: this.resumenPedido.FechaHoraEntrega,
        PrecioTotal: this.resumenPedido.TotalPrecio,
        UsuarioDocumento: localStorage.getItem('documento')
      })
      .subscribe({
        next: () => {
          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Reserva creada',
            showConfirmButton: false,
            timer: 2000
          });
          // Enviamos cada línea de pedido
          this.resumenPedido.pizzas!.forEach((item: any) =>
            this.http.post(`${environment.apiUrl}/api/linea`, item).subscribe()
          );
        },
        error: err => {
          console.error('Error al enviar la reserva', err);
          Swal.fire('Error', 'No se pudo crear la reserva.', 'error');
        }
      });
  }
}