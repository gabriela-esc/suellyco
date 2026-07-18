
# Suellyco

Suellyco es una aplicación web que busca ayudar a los usuarios a desarrollar hábitos de estudio o trabajo más organizados. 

A diferencia de otras herramientas web centradas exclusivamente en la productividad, Suellyco busca ofrecer una experiencia más equilibrada. Incorpora funciones como gestión de tareas y subtareas, organización de sesiones de estudio mediante la técnica Pomodoro y el control de páginas web que representen una distracción. Todo ello a través de una interfaz de diseño minimalista cuyo objetivo es transmitir tranquilidad y favorecer una experiencia más agradable y menos estresante. 

## Demo online

La aplicación está disponible en: https://suellyco.infinityfreeapp.com

Desde ahí podrás registrarte, iniciar sesión y utilizar las funcionalidades directamente desde tu navegador.

>La aplicación se encuentra en desarrollo activo. Algunas funciones pueden cambiar o ampliarse en futuras versiones.

## Capturas
A continuación se incluyen capturas de las principales pantallas de la aplicación.

### Página de inicio

<img width="1298" height="682" alt="Captura de pantalla 2026-06-10 183556" src="https://github.com/user-attachments/assets/25e83c1d-3311-48e7-87b2-4e54e9fd06c5" />

### Gestión de tareas

<img width="1298" height="682" alt="Captura de pantalla 2026-06-10 183743" src="https://github.com/user-attachments/assets/589e8380-926f-4c4f-bc93-fc9db0b08752" />

### Distracciones

<img width="1296" height="656" alt="Captura de pantalla 2026-06-10 183830" src="https://github.com/user-attachments/assets/62f0a4e0-e844-472e-ba9d-1347948ef749" />

### Sesión de estudio

<img width="1291" height="676" alt="Captura de pantalla 2026-06-10 192207" src="https://github.com/user-attachments/assets/d7d1393b-c5fa-42d7-b0d3-fa563fe0a7f3" />

### Métricas

<img width="1293" height="650" alt="Captura de pantalla 2026-06-10 183922" src="https://github.com/user-attachments/assets/2e583968-74fa-463a-8320-e6758bdccb21" />

### Resgistro e inicio de sesión

<img width="1297" height="679" alt="Captura de pantalla 2026-06-10 193536" src="https://github.com/user-attachments/assets/a5cef91d-6265-4091-b63f-f2d64cdca08e" />

<img width="1298" height="678" alt="Captura de pantalla 2026-06-10 183952" src="https://github.com/user-attachments/assets/6acacb07-81ee-4145-9d09-31ec74910657" />

## Funcionalidades

- Creación de tareas y subtareas: Permite crear listas de tareas generales y dividirlas en subtareas más pequeñas y ejecutables. La creación de este apartado está basada en la técnica **Work Breakdown Structure (WBS)** que consiste en descomponer una tarea grande o general en tareas más pequeñas.

Los usuarios pueden:
- Crear listas de tareas.
- Añadir subtareas asociadas.
- Marcar subtareas como completadas.
- Eliminar tareas y listas.

  
- Sesión de Estudio: Esta es la página principal del proyecto. Su objetivo es permitirle al usuario planificar periodos de concentración organizados en bloques de estudio y descanso, inspirados en la técnica Pomodoro. 

Cada sesión puede incluir:
- Nombre personalizado.
- Duración de los periodos de estudio y descanso.
- Número de bloques.
- Lista de tareas asociada.
- Temporizador con indicador de progreso.
- Música o sonidos ambientales.
- Controles para pausar, reanudar y finalizar la sesión. 
  
- Distracciones: Permite registrar y gestionar páginas web que el usuario considera que le distraen.

  Actualmente es posible:
- Añadir el nombre y la URL de un sitio.
- Activar o desactivar sitios registrados.
- Eliminar sitios de la lista.

> El bloqueo real de páginas web todavía se encuentra en desarrollo. Para implementarlo sería necesaria una extensión del navegador o una solución equivalente.
  
- Métricas: Muestra información sobre el progreso del usuario, incluyendo:

- Tiempo estudiado durante el día, la semana, el mes y en total.
- Número de sesiones realizadas.
- Tareas completadas.
- Porcentaje de progreso de las listas de tareas.
- Historial de sesiones y su duración.

> El objetivo de esta sesión que los usuarios sobreexigentes o perfeccionistas que no suelen ver progreso al procrastinar puedan ver el más mínimo progreso, añadiendo motivación.
  
- Registro/Inicio de Sesión: Permite el registro y el inicio de sesión para poder acceder a todas las funcionalidades de la aplicación. El registro es necesario para poder guardar el progreso y hacer uso de varias funcionalidades.  

## Tecnologías utilizadas
- PHP: Desarrollo de la lógica e implementación del patrón Modelo-Vista-Controlador (MVC).
- MySQL: Almacenamiento y gestor de datos de usuarios, tareas y sesiones de estudio.
- HTML5: Definición de la estructura de todas las páginas de la aplicación.
- CSS3: Implementación para la identidad visual del sitio. 
- JavaScript: Lenguaje para añadir interactividad al sitio.
- Bootstrap: Componentes y utilidades de la interfaz. 
- phpMyAdmin: Herramienta para administrar la base de datos.

## Herramientas de desarrollo
- XAMPP: Entorno de desarrollo local. Servicios necesarios para ejecutar la aplicación y pruebas.
- Visual Studio Code: Entorno de desarrollo.
- Apache JMeter: Realización de ensayos de carga y rendimiento sobre la aplicación. 

## Instalación local

Antes de empezar la instalación y para la correcta ejecución de la aplicación en tu ordenador local, deberás tener instalado en tu dispositivo local los siguientes programas: XAMPP y Git.

### 1. Clonar el repositorio
Abre una terminal y clona el proyecto dentro de la carpeta 'htdocs' de XAMPP:

```bash
cd C:\xampp\htdocs
git clone https://github.com/gabriela-esc/suellyco.git
```

### 2. Iniciar los servicios
Abre el panel de control de XAMPP e inicia Apache y MySQL

### 3. Crear la base de datos
Abre phpMyAdmin en:

```text
http://localhost/phpmyadmin
```

Crea una base de datos llamada:

```text
suellyco
```

### 4. Importar la estructura de la base de datos
Selecciona la base de datos `suellyco`, abre la pestaña **Importar** y selecciona el archivo:

```text
base_datos/suellyco.sql
```

Después, confirma la importación.

### 5. Comprobar la conexión
La configuración local se encuentra en:

```text
config/conexion.php
```

Por defecto, el proyecto utiliza esta configuración para XAMPP:

```php
$host = 'localhost';
$base_datos = 'suellyco';
$usuario = 'root';
$contrasena = '';
```

En una instalación estándar de XAMPP no debería ser necesario modificarla.

### 6. Abrir la aplicación
Accede desde el navegador a:

```text
http://localhost/suellyco/
```

Desde ahí podrás registrarte, iniciar sesión y utilizar la aplicación.
