# Progreso
### Nuevo:
1. Medicamentos personales por usuario.
2. Checkbox de recibir alertas.
3. Proceso para aletar sobre medicamentos expirados.
4. Colores rojo para la expiración de los medicamentos.
5. Corregir order de los medicamentos.

### Faltantes:
1. No correos duplicados.
2. Error al recuperar clave de usuario que no existe.

## ¿Cómo ejecutar?
1. Configurar tus credenciales en un archivo con nombre `.env`
2. Ejecutar:
```bash
docker compose build &&\
docker compose up -d
```