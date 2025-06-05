import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ChartConfiguration } from 'chart.js';
import { NgChartsModule } from 'ng2-charts';
import { CommonModule } from '@angular/common';
import { ChartOptions, ChartType, ChartData } from 'chart.js';
import { environment } from '../../../../environments/environment';


@Component({
  selector: 'app-estadisticas-dashboard',
  standalone: true,
  imports: [CommonModule, NgChartsModule,],
  templateUrl: './estadisticas-dashboard.component.html',
  styleUrls: ['./estadisticas-dashboard.component.css']
})
export class EstadisticasDashboardComponent implements OnInit {
  totalOrdenes = 0;
  totalPorciones = 0;
  promedioPorciones = 0;
  promedioValor = 0;
  totalIngresos = 0;

  ordenesPorDiaChart!: ChartData<'bar'>;
  ordenesPorDiaOptions: ChartOptions = { responsive: true };

  ordenesPorMesChart!: ChartData<'line'>;
  ordenesPorMesOptions: ChartOptions = { responsive: true };

  ventasPorSaborChart!: ChartData<'bar'>;
  ventasPorSaborOptions: ChartOptions = { responsive: true };

  /**topPizzasVendidasChart!: ChartData<'bar'>;
  topPizzasOptions: ChartOptions = {
    responsive: true,
    plugins: {
      legend: { position: 'top' },
      title: {
        display: true,
        text: 'Top Pizzas Vendidas'
      }
    }
  };**/

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.cargarResumen();
    this.cargarOrdenesPorDia();
    this.cargarOrdenesPorMes();
    this.cargarVentasPorSabor();
    /*this.cargarTopPizzasVendidas();*/
  }

  cargarResumen() {
    this.http.get<any>(`${environment.apiUrl}/total-ordenes`).subscribe(r => this.totalOrdenes = r.totalOrdenes);
    this.http.get<any>(`${environment.apiUrl}/total-porciones-vendidas`).subscribe(r => this.totalPorciones = r.total);
    this.http.get<any>(`${environment.apiUrl}/promedio-porcion-orden`).subscribe(r => this.promedioPorciones = r.promedioPorcionesPorOrden);
    this.http.get<any>(`${environment.apiUrl}/promedio-valor-orden`).subscribe(r => this.promedioValor = r.promedio);
    this.http.get<any>(`${environment.apiUrl}/total-ingresos`).subscribe(r => this.totalIngresos = r.totalIngresos);
  }

  cargarOrdenesPorDia() {
    this.http.get<any>(`${environment.apiUrl}/total-ordenes-por-dia`).subscribe(r => {
      const data = r.resultados;
  
      const labels = ['Viernes', 'Sábado', 'Domingo'];
      const dataValues = [data.viernes, data.sabado, data.domingo];
  
      this.ordenesPorDiaOptions = { // 👈 usar this
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: '#ffffff',
              font: {
                size: 14,
                weight: 'bold'
              }
            }
          },
          tooltip: {
            bodyFont: {
              size: 14
            },
            titleFont: {
              size: 16
            }
          },
          title: {
            display: false
          }
        },
        scales: {
          x: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 13
                
              }
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.1)'
            }
          },
          y: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 13,
                
              }
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.1)'
            }
          }
        }
      };
  
      this.ordenesPorDiaChart = {
        labels: labels,
        datasets: [{
          label: 'Órdenes por Día',
          data: dataValues,
          backgroundColor: '#3B82F6'
        }]
      };
    });
  }

  cargarOrdenesPorMes() {
    this.http.get<any>(`${environment.apiUrl}/total-ordenes-por-mes`).subscribe(r => {
      const data = r.ventasPorMes;
  
      const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  
      // Inicializar datos con ceros
      const monthlyData = Array(12).fill(0);
  
      // Reemplazar con los valores reales si existen
      data.forEach((d: any) => {
        monthlyData[d.month - 1] = d.total;
      });
  
      const labels = monthNames;
      const dataValues = monthlyData;
  
      this.ordenesPorMesOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            labels: {
              color: '#ffffff',
              font: {
                size: 14,
                weight: 'bold'
              }
            }
          },
          tooltip: {
            bodyFont: {
              size: 14
            },
            titleFont: {
              size: 16
            }
          },
          title: {
            display: false
          }
        },
        scales: {
          x: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 13
              }
            }
          },
          y: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 13
              }
            }
          }
        }
      };
  
      this.ordenesPorMesChart = {
        labels: labels,
        datasets: [{
          label: 'Ordenes por Mes',
          data: dataValues,
          borderColor: '#10B981',
          fill: true,
          tension: 0.4
        }]
      };
    });
  }


  cargarVentasPorSabor() {
    this.http.get<any>(`${environment.apiUrl}/ventas-por-sabor`).subscribe(r => {
      const data = r.ventasPorSabor;

      this.ventasPorSaborOptions = { // 👈 usar this
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            bodyFont: {
              size: 14
            },
            titleFont: {
              size: 16
            }
          },
          title: {
            display: false
          }
        },
        scales: {
          x: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 11
                
              }
            },
            
          },
          y: {
            ticks: {
              color: '#ffffff',
              font: {
                size: 12,
                
              }
            },
            
          }
        }
      };
      this.ventasPorSaborChart = {
        labels: data.map((d: any) => d.Nombre_Pizza),
        datasets: [{
          
          data: data.map((d: any) => d.totalPorciones),
          backgroundColor: ['#42A5F5', '#66BB6A', '#FFA726', '#FF7043', '#AB47BC']
        }]
      };
    });
  }

  /**cargarTopPizzasVendidas() {
    this.http.get<any>('http://localhost:8000/api/top-pizzas-vendidas').subscribe(data => {
      if (!data || data.length === 0) {
        console.warn('No hay datos de pizzas vendidas.');
        return;
      }
  
      this.topPizzasVendidasChart = {
        labels: data.map((d: any) => d.Nombre_Pizza),
        datasets: [{
          label: 'Top Pizzas Vendidas',
          data: data.map((d: any) => parseInt(d.NumeroPorcionesVendidas)), // 👈 convertimos a número
          backgroundColor: ['#42A5F5', '#66BB6A', '#FFA726', '#FF7043', '#AB47BC']
        }]
      };
    });
  }**/
  
  
}