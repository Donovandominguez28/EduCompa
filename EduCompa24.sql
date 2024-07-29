-- Crear la base de datos
create database EduCompa2;
use EduCompa2;

-- Crear tablas con entidades fuertes
create table estudiantes (
    carnet int primary key,
    fotoPerfil longblob,
    usuario varchar(100),
    nombreCompleto varchar(100),
    añoBachi int,
    seccion varchar(1),
    especialidad varchar(100),
    email varchar(100) unique,
    contrasena varchar(255),
    rol varchar(100) default 'Estudiante'
);
create table profesor (
    idProfesor int primary key,
    fotoPerfil longblob,
    email varchar(100) unique,
    contrasena varchar(255),
    nombreCompleto varchar(100),
    materiaInpartida varchar(100),
    rol varchar(100) default 'Profesor'
);
create table administrador (
    idAdmin int primary key,
    nombre varchar(100),
    rol varchar(100) default 'Administrador',
    email varchar(100) unique,
    contrasena varchar(100)
);

insert into administrador (idAdmin, nombre, email, contrasena)
values (1, 'Donovan Domínguez', 'admin@gmail.com', 'admin123');

create table biblioteca (
    idBiblioteca int auto_increment primary key,
    idLibro int,
    libroimg longblob,
    titulo varchar(100),
    descripcion varchar(1000),
    link varchar(100)
);
create table podio(
idPodio int auto_increment primary key,
top int,
foto longblob,
nombreApellido varchar(100),
descripcion varchar(1000),
idPodio2 int,
foreign key (idPodio2) references administrador(idAdmin)
);
create table clases (
    idClase int auto_increment primary key,
    imagenClase longblob,
    descripcion varchar(1000),
    materia varchar(100),
    nombreProfesor varchar(100),
    titulo varchar(100)
);
CREATE TABLE contenidoBanner (
    idBanner INT AUTO_INCREMENT PRIMARY KEY,
    idClase6 INT,
    banner LONGBLOB,
    tituloBanner VARCHAR(100),
    descripcionBanner VARCHAR(100),
    FOREIGN KEY (idClase6) REFERENCES clases(idClase)
);
CREATE TABLE contenidoImagen1 (
    idImagen1 INT AUTO_INCREMENT PRIMARY KEY,
    idClase7 INT,
    imagen1 LONGBLOB,
    descripcionImagen1 VARCHAR(100),
    FOREIGN KEY (idClase7) REFERENCES clases(idClase)
);
CREATE TABLE contenidoTarjeta1 (
    idTarjeta1 INT AUTO_INCREMENT PRIMARY KEY,
    idClase8 INT,
    titulo1 VARCHAR(100),
    descripcion1 VARCHAR(100),
    imagen2 LONGBLOB,
    FOREIGN KEY (idClase8) REFERENCES clases(idClase)
);
CREATE TABLE contenidoTarjeta2 (
    idTarjeta2 INT AUTO_INCREMENT PRIMARY KEY,
    idClase9 INT,
    titulo2 VARCHAR(100),
    descripcion2 VARCHAR(100),
    imagen3 LONGBLOB,
    FOREIGN KEY (idClase9) REFERENCES clases(idClase)
);
CREATE TABLE contenidoTarjeta3 (
    idTarjeta3 INT AUTO_INCREMENT PRIMARY KEY,
    idClase10 INT,
    titulo3 VARCHAR(100),
    descripcion3 VARCHAR(100),
    imagen4 LONGBLOB,
    FOREIGN KEY (idClase10) REFERENCES clases(idClase)
);
CREATE TABLE contenidoAdicional (
    idAdicional INT AUTO_INCREMENT PRIMARY KEY,
    idClase11 INT,
    titulo VARCHAR(100),
    descripcion VARCHAR(100),
    FOREIGN KEY (idClase11) REFERENCES clases(idClase)
);

create table contenidoclases (
    idContenido int auto_increment primary key,
     contenido varchar(100),
    multimedia longblob,
    link varchar(100),
    idClase2 int,
    foreign key (idClase2) references clases(idClase)
);

create table chat (
    idChat int auto_increment primary key,
    incoming_msg_id int not null,
    outgoing_msg_id int not null,
    msg varchar(1000) not null
);

create table mural (
    idMural int auto_increment primary key,
    imagenMural longblob,
    titulo varchar(100),
    informacion varchar(1000),
    carnet2 int,
    foreign key (carnet2) references estudiantes(carnet)
);

-- Crear tablas intermedias o relaciones entre tablas
create table estudiantesChat (
    carnet3 int,
    idChat2 int,
    foreign key (carnet3) references estudiantes(carnet),
    foreign key (idChat2) references chat(idChat)
);

create table estudiantesClases (
    carnet4 int,
    idClase3 int,
    foreign key (carnet4) references estudiantes(carnet),
    foreign key (idClase3) references clases(idClase)
);

create table clasesProfesor (
    idClase4 int,
    idProfesor2 int,
	contenido varchar(100),
    multimedia longblob,
    link varchar(100),
    foreign key (idClase4) references clases(idClase),
    foreign key (idProfesor2) references profesor(idProfesor)
);

-- Tabla con el poder absoluto sobre todas las entidades
create table controlTotal (
    idAdmin2 int,
    idBiblioteca2 int,
    idChat3 int,
    idClase5 int,
    carnet5 int,
    idProfesor3 int,
    idMural2 int,
    idPodio3 int,
	foreign key (idAdmin2) references administrador(idAdmin),
    foreign key (idBiblioteca2) references biblioteca(idBiblioteca),
    foreign key (idChat3) references chat(idChat),
    foreign key (idClase5) references clases(idClase),
    foreign key (carnet5) references estudiantes(carnet),
    foreign key (idProfesor3) references profesor(idProfesor),
    foreign key (idMural2) references mural(idMural),
	foreign key (idPodio3) references podio(idPodio)

);


