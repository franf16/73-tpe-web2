### Implementado

- [x] Autoload de database (parámetros de configuración en ./config/config.php)

### Problemas

- [ ] no funciona 'between' en $params[ 'where' ] (si el tercer parametro es string lo encierra en '')

### Solucionado

- [x] definido redirect de post y delete.
    - [ ] como no hay ruta para mostrar un usuario, cuando se crea redirecciona a una ruta inexistente (¿metodo abstracto para definir el redirect?)
    - [ ] si se elimina el usuario con el que se esta logeado no cierra la sesión (probe a sobrescribir postElement pero el redirect hace que no llegue.. definiendo el redirect se solucionaría)

### Ideas

- [x] para url semantica hacer /:ID/:NOMBRE y /:ID que redirecciona a /:ID/nombre
- [x] para js/css carpeta static/js, css, ..
- [ ] para imagenes carpeta upload/
- [x] smarty (chmod o+w templates_c/)
- [x] en adminController guardar los modelos (no los controladores)
- [ ] Un controlador abstracto de la aplicación con metodos que traen datos que podrián necesitar los demás controladores
- [x] mezclar addElement y editElement del Controller
- [ ] Implementar recuperación de clave de usuario (se envía un email con una clave temporal)

### Datos

```
noticia (
    id: int,
    titulo: varchar(100),
    descripcion: varchar(255),
    texto: text,
    fecha: datetime,
    id_seccion: int,
    visualizaciones: int
)
seccion (
    id: int,
    nombre: varchar(32).
    descripcion: varchar(255)
)
usuario (
    id: int,
    username: varchar(16),
    email: varchar(64),
    password: varchar(255)
)
```

### Referencias

- [ Símbolos html ](https://www.toptal.com/designers/htmlarrows/)