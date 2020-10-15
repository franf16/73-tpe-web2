## TPE

### Consigna

Desarrollar un sitio web dinámico que permita visualizar una lista de ​items ​con categorías​. 
Éstos deben poder ser administrados por un usuario administrador.

#### Datos

Debe contar con una base de datos acorde al tipo de página a implementar. La base de datos debe tener al menos una relación 1-N. Por ejemplo, debe haber una categoría, ​ y un nivel de ​ítem que es agrupado en la categoría.

Ejemplos:

- Comercial: Debe contar con las tablas Producto y Categoría. Un producto puede pertenecer sólo a una categoría.
- Novedades: debe contar con las tablas Noticia y Sección. Una noticia puede pertenecer sólo auna sección.

#### Requerimientos funcionales

##### Acceso público

Debe existir al menos 2 paginas donde se muestre el contenido dinámicamente generado desde la base de datos. 
Estas secciones pueden ser accedidas de ​manera pública​, no es necesario loguearse.

- Listado de items​:                ​Se debe poder visualizar todos los items
- Detalle de item:​                 Se debe poder navegar y visualizar cada item particularmente
- Listado de categorías:           ​Se debe poder visualizar todas las categorías
- Listado de items x categoria​:    Se debe poder visualizar los items agrupados por categorías.

> **Importante**: En cada item siempre se debe mostrar el nombre de la categoría​ a la que pertenece.

##### Acceso administrador de datos

Debe haber una página de ​administración ​de datos, la cual es accedida solo a usuarios administradores del sitio.

- El usuario administrador debe loguearse con ​usuario ​y ​contraseña.
- El usuario debe poder ​desloguearse​ (logout)
- Solo los usuarios logueados ​pueden modificar las categorías y los items​.

Se debe crear servicios de ABM (alta/baja/modificación) para administrar los datos:

1. Administrar *Items* (entidad del lado N de la relación).
2. Administrar *Categorías* (entidad del lado 1 de la relación)

Operaciones:
- Lista de Items (Noticias/Productos/...)
- Agregar Items (Noticias/Productos/...)
- Eliminar Items (Noticias/Productos/...)
- Editar Items (Noticias/Productos/...)

> **Importante**: Al agregar Items (Noticias/Productos/...) se debe poder elegir la categoría a la que pertenecen utilizando un select que muestre el nombre de la misma.

##### Requerimientos Técnicos (no funcionales)

- Todos los HTML deben mostrarse utilizando un motor de plantillas (Smarty).
- Todas las acciones realizadas en la página deben estar manejadas utilizando el patrón MVC
- Las URL deben ser amigables.
- El sitio debe incluir un archivo sql para instalar la base de datos.