-- ver registros (READ)
SELECT columna1, columna2, etc FROM tabla;
SELEcT * FROM tabla;

-- meter registros (CREATE)
INSERT INTO tabla VALUES (valor1, valor2, valor3, etc, enOrden)
INSERT INTO tabla (columna1, columna2, columna3) VALUES ('valor1', 'valor2', 'valor3')

-- editar registros (UPDATE)
UPDATE tabla SET columna1=valor1, columna2=valor2 WHERE columnaID=ID;

-- borrar registro (DELETE)
DELETE FROM tabla WHERE columnaID=ID;



--cuando un usuario va a entrar a la aplicacion que actividades puede realizar


--crear usuario(nombre apellidoPaterno, apellidoMaterno, correoElecronico, telefono, contrasena, nombreUsuario, sexo, bloqueado, pais, nivelUsuario)
INSERT INTO usuario VALUES(nombre, apellidoPaterno, apellidoMaterno, correoElectronico, telefono, contrasena, nombreUsuario, sexo, pais, nivelUsuario);

--iniciar sesion(nombreUsuario, contrasena)
SELECT nombreUsuario, contrasena FROM usuarios;

--#ver un libro(titulo de libro, autor, editorial, portada, categoria, formato)
SELECT 
    libro.tituloLibro,
    libro.portada,
    autor.nombre,
    editorial.nombreEditorial,
    categoria.nombreCategoria,
    formato.nombre, 
FROM libro
LEFT JOIN formato ON libro.Formato_idFormatos = formato.idFormatos
LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor


--#detalles del libro(isbn, numero de paginas, sinopsis, ano de edicion, idioma, formato, categoria, universidad,autor, editorial, pais, portada)
--SELECT isbn, numeroPaginas, sinopsis, añoEdicion, idioma, formato, categoria, universidad,autor, editorial, pais, portada FROM libro;
SELECT 
    libro.isbn,
    libro.numeroPaginas,
    libro.sinopsis,
    libro.portada,
    libro.añoEdicion,
    idioma.nombreIdioma,
    formato.nombre,
    categoria.nombreCategoria,
    autor.nombre,
    editorial.nombreEditorial,
    pais.nombrePais,
    FROM libro
    LEFT JOIN  idioma ON libro.Idioma_idIdioma = idioma.idIdioma
    LEFT JOIN formato ON libro.Formato_idFormatos = formato.idFormatos
    LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
    LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
    LEFT JOIN pais ON libro.Pais_idPais = pais.idPais
    LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
    LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor



--#filtrar libros(titulo de libro, idioma, autor, categoria, formato,editorial)
--SELECT titulo de libro, idioma, autor, categoria, formato, editorial FROM  libro;
SELECT
    libro.tituloLibro,
    idioma.nombreIdioma,
    autor.nombre,
    categoria.nombreCategoria,
    formato.nombre,
    editorial.nombreEditorial,
    FROM libro
    LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
    LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
    LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
    LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
    LEFT JOIN formato ON libro.Formato_idFormatos = formato.idFormatos
    LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial


--#ordenar libros(titulo de libro, categoria, formato, autor, editorial,idioma)
--SELECT titulo de libro, categoria, formato, autor. editorial, idioma FROM libro;
SELECT
    libro.tituloLibro,
    categoria.nombreCategoria,
    formato.nombre,
    autor.nombre,
    editorial.nombreEditorial,
    idioma.nombreIdioma,
    FROM libro
    LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
    LEFT JOIN formato ON libro.Formato_idFormatos = formato.idFormatos
    LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
    LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
    LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
    LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma



-subir libros(titulo de libro, editorial, formato, idioma categoria,autor, portada, numero de paginas, isbn,editorial, ano de edicion, sinopsis, )
INSERT INTO libro VALUES titulo de libro, editorial, formato,idioma categoria, autor, portada, numero de paginas, isbn, editorial, ano de edicion, sinopsis;


--*****eliminar libros solo los suyos (nombreUsuario,contrasena, nivelUsuario,tituloLibro,isbn, categoria)
SELECT nombreUsuario, contrasena, nivelUsuario FROM usuario;
DELETE FROM libro WHERE idLibro=tituloLibro


pedir prestamo de libros(nombre, apellidoPaterno, appellidoMaterno, nombreUsuario, contrasena,tituloLibro,formato,)

prestar libros (tituloLibro,portada, disponibilidad, categoria, idioma, formato, nombreUsuario, contrasena)
------------------------UPDATE libro SET tituloLibro=
-- ver perfil
SELECT
    usuario.nombre,
    usuario.apellidoPaterno,
    usuario.apellidoMaterno,
    usuario.correroElectronico,
    usuario.telefono,
    usuario.nombreUsuario,
    usuario.sexo,
    pais.nombrePais,
    nivelusuario.nombre
FROM usuario
    LEFT JOIN pais ON usuario.pais=pais.idPais
    LEFT JOIN nivelusuario ON usuario.nivelUsuario=nivelusuario.idNivelUsuario


--editar perfil
(nombre, apellidoPaterno, apellidoMaterno, nombreUsuario, sexo, pais, titulo libro)

cerrar sesion(nombreUsuario)
recuperar contrasena(nombreUsuario, nombre, apellidoPaterno, apellidoMaterno, correoElecronico, telefono)
--levantar reporte de un libro#
(tituloLibro, autor, categoria,idioma, portada, formato, nombreUsuario)

--administrador
#subir libros(nombreUsuario nombre, apellidoPaterno, apellidoMaterno, tituloLibro, autor,isbn, añoEdicion, numero dempaginas, sinopsis, portada, pais, categoria, formato, idioma)

eliminar libros(nombreUsuario, tituloLibro, isbn, formato, categoria, portada)
bloquear usuarios(nombreUsuario, nombre, apellidoPaterno, apellidoMaterno, correoElecronico)