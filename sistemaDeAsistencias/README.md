# Sistema de Gestión de Asistencias y Alumnos

# Descripción
Este proyecto es una solución integral para la **gestión de alumnos y asistencias** en instituciones educativas. Permite registrar a los estudiantes, gestionar sus notas, controlar sus asistencias (presente o ausente), y consultar su desempeño académico. La interfaz de usuario es simple y fácil de usar, permitiendo que tanto administradores como docentes realicen estas tareas de manera eficiente.

## Tabla de contenidos
-Archivos principales
*index.php: Página de inicio donde los usuarios se autentican (usuario y contraseña). Muestra un mensaje de error si los datos de inicio no son correctos.
*altaAlumnos.php: Página principal donde se gestionan los alumnos. Permite registrar, editar, eliminar y visualizar la información de los estudiantes.
*conexionBD.php: Clase para gestionar la conexión a la base de datos y realizar consultas SQL.
*ingresarAlumnos.html: Formulario HTML para ingresar nuevos alumnos al sistema.
*editarAlumnos.php: Página que permite editar los detalles de un alumno existente.
*borrarAlumnos.php: Página que permite eliminar un alumno de la base de datos.
*notasAlumnos.php: Página que permite modificar las notas de los alumnos.
*estadoAlumno.php: Página que muestra el estado del alumno según sus notas y asistencias.
*asistencias.php: Script PHP para gestionar el registro de asistencia de los alumnos.

# Base de Datos
El sistema utiliza una base de datos MySQL con las siguientes tablas:
*alumnos: Contiene los datos de los alumnos.
***asistencias: Registra la presencia o ausencia de los alumnos.
*instituciones: Información sobre las instituciones educativas.
*usuarios: Almacena los usuarios que accederán al sistema.

# Instalación desde Git
**Clona el repositorio utilizando el siguiente comando (sustituye la URL por la de tu proyecto en GitHub):
git clone https://github.com/tu-usuario/tu-repositorio.git

**Accede al directorio del proyecto:
cd: tu-repositorio
En este punto, deberías tener una copia local del repositorio en tu máquina.

# Configuración
El archivo `conexionBD.php` se encarga de la conexión con la base de datos. Si estás usando un servidor diferente o base de datos con credenciales distintas, asegúrate de modificar las siguientes variables dentro de `conexionBD.php`:

private $host = "localhost"; 
private $usuario = "root";   
private $contraseña = "root";    
private $base_de_datos = "asistencia"; 


# Instrucciones de Uso
1. Configuración Inicial
Asegúrate de tener un servidor web con PHP y una base de datos MySQL configurados. Puedes usar XAMPP, WAMP o cualquier otro servidor local para ejecutarlo.

2. Crear la Base de Datos
Crea la base de datos y las tablas necesarias ejecutando los siguientes comandos SQL:
-Copiar código

CREATE DATABASE sistema_asistencias;
USE sistema_asistencias;

CREATE TABLE alumnos (
    id_alumnos INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    fecha_nacimiento DATE,
    dni VARCHAR(20),
    id_institucion INT,
    nota1 DECIMAL(5,2),
    nota2 DECIMAL(5,2),
    nota3 DECIMAL(5,2)
);

CREATE TABLE asistencias (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT,
    presente BOOLEAN,
    fecha DATE,
    FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumnos)
);

CREATE TABLE instituciones (
    id_institucion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    direccion VARCHAR(255)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    contraseña VARCHAR(255)
);


3. Ejecución
Una vez configurado todo, puedes acceder a la aplicación web desde tu servidor local. Por ejemplo:


