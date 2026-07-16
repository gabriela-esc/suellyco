/*create database if not exists suellyco
character set utf8mb4
collate utf8mb4_unicode_ci;

use suellyco;*/

create table usuarios (
    id int auto_increment PRIMARY KEY,
    nombre varchar(100) not null,
    genero VARCHAR(20) NULL,
    correo varchar(150) not null unique,
    contrasena varchar(255) not null,
    fecha_creacion timestamp default current_timestamp
);

create table preferencias_usuario (
    id int auto_increment PRIMARY KEY,
    usuario_id int not null,
    minutos_estudio int default 25,
    minutos_descanso int default 5,
    sonido_favorito varchar(100) default 'biblioteca',

    FOREIGN KEY (usuario_id)
    references usuarios(id)
    on delete cascade
);

create table listas_tareas (
    id int auto_increment PRIMARY KEY,
    usuario_id int not null,
    nombre varchar(150) not null,
    descripcion text null,
    fecha_creacion timestamp default current_timestamp,

    FOREIGN KEY (usuario_id)
    references usuarios(id)
    on delete cascade
);

create table tareas (
    id int auto_increment PRIMARY KEY,
    lista_id int not null,
    nombre varchar(150) not null,
    descripcion text null,
    completada tinyint(1) default 0,
    fecha_creacion timestamp default current_timestamp,
    fecha_completada datetime null,

    FOREIGN KEY (lista_id)
    references listas_tareas(id)
    on delete cascade
);

create table sitios_bloqueados (
    id int auto_increment PRIMARY KEY,
    usuario_id int not null,
    nombre varchar(100) not null,
    url varchar(255) not null,
    activo tinyint(1) default 1,
    fecha_creacion timestamp default current_timestamp,

    FOREIGN KEY (usuario_id)
    references usuarios(id)
    on delete cascade
);

create table sesiones_estudio (
    id int auto_increment PRIMARY KEY,
    usuario_id int not null,
    lista_id int null,
    estado enum('activa', 'completada', 'cancelada') default 'activa',
    minutos_estudio int not null,
    minutos_descanso int default 5,
    sonido varchar(100) default 'biblioteca',
    fecha_inicio datetime default current_timestamp,
    fecha_fin datetime null,
    segundos_totales int default 0,

    FOREIGN KEY (usuario_id)
    references usuarios(id)
    on delete cascade,

    FOREIGN KEY (lista_id)
    references listas_tareas(id)
    on delete set null
);

create table sesiones_tareas (
    id int auto_increment PRIMARY KEY,
    sesion_id int not null,
    tarea_id int not null,
    completada tinyint(1) default 0,
    fecha_completada datetime null,

    FOREIGN KEY (sesion_id)
    references sesiones_estudio(id)
    on delete cascade,

    FOREIGN KEY (tarea_id)
    references tareas(id)
    on delete cascade
);