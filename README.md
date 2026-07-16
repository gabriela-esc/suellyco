
# Suellyco

Suellyco es una aplicación web que busca ayudar a los usuarios a desarollar hábitos de estudio o trabajo más organizados. 

A diferencia de otras herramientas web centradas exclusivamente en la productividad, Suellyco busca ofrecer una experiencia más equilibrada. Incorpora funciones como gestión de tareas y subtareas, organización de sesiones de estudio mediante la técnica Pomodoro y el control de páginas web que representen una distracción. Todo ello a través de una interfaz de diseño minimalista cuyo objetivo es transmitir tranquilidad y favorecer una experiencia más agradable y menos estresante. 

## Capturas
A continuación se incluyen capturas de las principales pantallas de la aplicación.

<img width="1298" height="682" alt="Captura de pantalla 2026-06-10 183556" src="https://github.com/user-attachments/assets/25e83c1d-3311-48e7-87b2-4e54e9fd06c5" />
<img width="1298" height="682" alt="Captura de pantalla 2026-06-10 183743" src="https://github.com/user-attachments/assets/589e8380-926f-4c4f-bc93-fc9db0b08752" />
<img width="1296" height="656" alt="Captura de pantalla 2026-06-10 183830" src="https://github.com/user-attachments/assets/62f0a4e0-e844-472e-ba9d-1347948ef749" />
<img width="1291" height="676" alt="Captura de pantalla 2026-06-10 192207" src="https://github.com/user-attachments/assets/d7d1393b-c5fa-42d7-b0d3-fa563fe0a7f3" />
<img width="1293" height="650" alt="Captura de pantalla 2026-06-10 183922" src="https://github.com/user-attachments/assets/2e583968-74fa-463a-8320-e6758bdccb21" />
<img width="1297" height="679" alt="Captura de pantalla 2026-06-10 193536" src="https://github.com/user-attachments/assets/a5cef91d-6265-4091-b63f-f2d64cdca08e" />
<img width="1298" height="678" alt="Captura de pantalla 2026-06-10 183952" src="https://github.com/user-attachments/assets/6acacb07-81ee-4145-9d09-31ec74910657" />

## Funcionalidades

- Creación de tareas y subtareas: La creación de este apartado está basada en la técnica Work Breakdown Structure (WBS) que consiste en descomponer una tarea grande o general en tareas más pequeñas o ejecutables. En esta página el usuario tiene a disposición un recuadro a la izquierda que le permite añadir "Listas de tareas" que representan tareas generales y un recuadro a la derecha que le permite asociar subtareas a esa Lista de tareas. Además se pueden marcar las subtareas como hechas y se pueden eliminar tanto subtareas como Listas de tareas.
  
- Sesión de Estudio: Esta es la página principal del proyecto. Su obejtivo es permitirle al usuario planificar periodos de concentración organizados en bloques de estudio y descanso, inspirados en la técnica Pomodoro. Se compone de un temporizador repartido en bloques de estudio y descando con una barra que indica el progreso en porcentaje, un apartado para la lista de tareas que se quieren completar durante la sesión (y que ha sido previamente creada en la página de tareas) y un espacio donde aparece un reproductor de música que puede ser una playlist propia de spotify o alguna de las listas predeterminadas. Finalmente, incluye botones para pausar, reanudar o finalizar la sesión. 
  
- Distracciones: En esta página podrás ingresar el nombre del sitio web que deseés bloquear durante el tiempo que necesites, así como la url del propio sitio. Luego, tienes un apartado para gestionar los sitios bloqueados, donde podrás desactivar/activar el bloqueo o eliminarlos. Esta página aún no cuenta con la herramienta necesaria para bloquear sitios web de manera funcional, de momento se encuentra en desarrollo. 
  
- Métricas: Se puede ver el historial del progreso hecho. Se incluyen datos como tiempo estudiado hoy, esta semana, este mes o en total, el número de sesiones de estudio realizadas a la semana y al mes, las tareas completadas, un progreso en porcentaje según las listas de tareas existentes y finalmente un historial que indica el día en que hubo una sesión de estudio activa y su duración. El objetivo de esta sesión que los usuarios sobre exigentes o perfeccionistas que no suelen ver progreso al procastinar puedan ver el más minimo progreso, añadiendo motivación.
  
- Registro/Inicio de Sesión: Aquí podrás registrarte para poder acceder a todas las funcionalidades de la aplicación e iniciar sesión en caso de cerrarla. El registro es necesario para poder guardar el progreso y hacer uso de varias funcionalidades.  

## Tecnologías utilizadas

- PHP: Lenguaje principal para el desarrollo de la lógica. Permitió implementar el patrón Modelo-Vista-Controlador (MVC).
- MySQL: Sistema gestor de bases de datos relacional.
- phpMyAdmin: Herramienta para administrar la base de datos.
- HTML5: Definición de la estructura de todas las páginas de la aplicación.
- CSS3: Implementación para la identidad visual del sitio. 
- JavaScript: Lenguaje para añadir interactividad al sitio. Principalmente usado en la sesión de estudio y la navegación. 
- Bootstrap
- XAMPP: Entorno de desarrollo local, que proporcionó los servicios necesarios para ejecutar la aplicación y pruebas.
- Visual Studio Code: Entorno de desarrollo.
- Apache JMeter: Herramienta para realizar ensayos de carga y rendimiento sobre la aplicación. 

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/gabriela-esc/suellyco.git
