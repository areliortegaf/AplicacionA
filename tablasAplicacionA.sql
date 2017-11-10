

create table usuarios
(
  id int not null auto_increment primary key,
  correo varchar(80) not null,
  contrasena varchar(30) not null
); 


create table detalle_usuarios
(
  id int not null auto_increment primary key,
  nombre varchar(80) not null,
  apellido varchar(80) not null,
  titulo varchar(80) not null,
  descripcion varchar(500) not null,
  url_foto varchar(80) not null,
  fk_id_usuarios int not null
); 


ALTER TABLE detalle_usuarios

ADD CONSTRAINT fk_id_usuarios
FOREIGN KEY (fk_id_usuarios) REFERENCES usuarios(id)
ON UPDATE CASCADE
ON DELETE CASCADE;


create table amigos
(
  id int not null auto_increment primary key,
  id_amistad varchar(80) not null,
  fk_id_usuarios int not null
) 

ALTER TABLE amigos

ADD CONSTRAINT fk_id_amigos
FOREIGN KEY (fk_id_usuarios) REFERENCES usuarios(id)
ON UPDATE CASCADE
ON DELETE CASCADE;