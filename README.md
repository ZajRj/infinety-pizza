# Infinety Pizza - Evaluación Técnica v2.0 

Este repositorio contiene la solución a la **Evaluación Técnica v2.0 de Infinety**, consistente en el desarrollo de una aplicación integral de gestión de pizzas artesanales. El proyecto demuestra el uso de arquitectura limpia, patrones de diseño modernos y las mejores prácticas del ecosistema Laravel.

## Resumen del Proyecto

**Infinitey Pizza** es una plataforma de comercio electrónico premium que gestiona el ciclo de vida completo de un pedido artesanal. Desde la exploración de productos con ingredientes detallados hasta el procesamiento en segundo plano de confirmaciones y un panel administrativo con indicadores clave de negocio.

## Stack Tecnológico

- **Framework**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Livewire 4, AlpineJS
- **Panel Administrativo**: Filament v4
- **Estilizado**: Tailwind CSS
- **Colas y Notificaciones**: Database Queue Driver + SMTP (Log) Mailer.
- **Base de Datos**: MySQL (con soporte para Soft Deletes).

### Justificación de elección: Livewire
Se ha seleccionado **Livewire** para el frontend del cliente por su integración nativa y fluida con **Filament**, permitiendo mantener un stack tecnológico unificado (**TALL stack**). Esto facilita la reutilización de componentes de UI, simplifica el manejo del estado reactivo sin la complejidad de una SPA tradicional y optimiza los tiempos de desarrollo manteniendo un alto nivel de interactividad y rendimiento.

## Módulos y Requisitos Cumplidos

### 1. Base de Datos y Modelos
- **Migraciones**: Estructura completa para `users`, `pizzas`, `ingredients`, `categories` y `orders`.
- **Relaciones**: Uso extensivo de Eloquent (`BelongsTo`, `HasMany`, `BelongsToMany`).
- **Eliminación Lógica**: Implementado `SoftDeletes` en los modelos de `Pizza`, `Ingredient` y `Category`.
- **Estados de Pedido**: Gestión de estados mediante el enum `OrderStatus` (Pending, Confirmed, Completed, Cancelled).

### 2. Autenticación y Seguridad
- Implementado mediante **Laravel Fortify**.
- Flujo completo: Registro, Login, Logout y **Verificación de Email**.
- Rutas de checkout y perfil protegidas por middleware `auth`.
- Acceso al Panel Administrativo restringido a usuarios con `is_admin = true`.

### 3. Flujo de Pedidos (Eventos y Colas)
- **Validación**: La creación de pedidos pasa por una capa de servicio (`OrderService`) con validación estricta.
- **Evento**: Disparo de `OrderCreated` tras la persistencia.
- **Listener/Job**: `SendOrderConfirmationEmail` (implementando `ShouldQueue`) delega el envío a la cola.
- **Mailable**: Envío de correo `OrderConfirmation` con detalles de pizza e ingredientes.

### 4. Observadores de Modelo
- **OrderObserver**: Registrado en `AppServiceProvider`.
- **Log de Creación**: Registra automáticamente cada nuevo pedido en los logs de Laravel.
- **Lógica de Cancelación**: Detecta cambios de estado a `CANCELLED` y dispara el evento `OrderCancelled`.

### 5. Panel Administrativo (Filament)
- **Gestión CRUD**: Control total sobre ingredientes, pizzas (con imágenes) y pedidos.
- **Dashboard**: Indicadores en tiempo real:
    - Pedidos del día.
    - Pizza más solicitada (Most Sold Pizza).
    - Total de usuarios registrados.

### 6. Frontend y UX
- **Catálogo**: Listado con imágenes premium, ingredientes y paginación personalizada.
- **Caché**: Optimización de consultas frecuentes (menú y categorías) mediante `Cache::remember`.
- **Historial**: Los usuarios pueden consultar sus últimos pedidos y estados desde su perfil.

## Pruebas y Calidad (Bonus)
- **Feature Tests**: Suite completa para verificar la creación de pedidos y el filtrado del menú.
- **Factories**: Generación de datos de prueba robustos para `Pizza`, `Category` y `User`.

## Instalación y Puesta en Marcha

Para ejecutar este proyecto en un entorno local (como **Laragon**, **XAMPP** o similar), siga estos pasos:

1. **Clonar el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd infinety-pizza
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   npm install
   ```

3. **Configurar el entorno**:
   - Cree su archivo `.env` a partir del ejemplo: `cp .env.example .env`.
   - Configure su base de datos local en el `.env` (usualmente `DB_HOST=127.0.0.1` y `DB_USERNAME=root` en Laragon).
   - Genere la clave de seguridad:
     ```bash
     php artisan key:generate
     ```

4. **Preparar la base de datos**:
   - Cree la base de datos en su gestor local (ej. `infinety_pizza`).
   - Ejecute las migraciones y los seeders para cargar datos de prueba:
     ```bash
     php artisan migrate --seed
     ```

5. **Compilar Assets**:
   Inicie el servidor de Vite para el frontend:
   ```bash
   npm run dev
   ```

6. **Acceso al Proyecto**:
   - Si utiliza **Laragon**, el proyecto estará disponible en `http://infinety-pizza.test`.
   - También puede usar el comando: `php artisan serve`.

7. **Colas de Trabajo (Importante)**:
   Para el envío de correos de confirmación en segundo plano, mantenga un proceso de colas activo:
   ```bash
   php artisan queue:work
   ```

## Credenciales de Prueba (Admin)

- **Usuario**: `developer@mail.com`
- **Contraseña**: `developer` (o la definida en el seeder).

## Uso de IA y Asistencia (Antigravity)

Se ha utilizado **Antigravity** como agente de IA avanzado para potenciar el desarrollo del proyecto, aplicando un criterio técnico riguroso en cada paso:

- **Automatización de Tareas Repetitivas**: Antigravity asistió en la generación de *boilerplate*, migraciones complejas y la creación de *factories*, permitiendo centrar el esfuerzo humano en las decisiones arquitectónicas y la lógica de negocio.
- **Generación de Activos con IA**: Todas las imágenes de pizzas presentes en el catálogo y seeders han sido generadas mediante IA (DALL-E/Stability AI) a través de las herramientas de Antigravity. Esto evita el uso de *placeholders* genéricos y refuerza la estética premium y artesanal del proyecto.
- **Mantenimiento de Contexto y Skills**: Se utilizaron *skills* y un manejo de contexto estructurado para asegurar que cada sugerencia de la IA fuera coherente con los patrones de diseño establecidos y el tono de marca.

---
