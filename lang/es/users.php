<?php

return [
    'title' => 'Usuarios',
    'single' => 'Usuario',
    'navigation_group' => 'Ajustes',
    
    'fields' => [
        'name' => 'Nombre',
        'email' => 'Correo Electrónico',
        'phone_number' => 'Teléfono',
        'dni' => 'DNI/Cédula',
        'password' => 'Contraseña',
        'is_admin' => 'Administrador',
        'address' => 'Dirección',
        'email_verified_at' => 'Verificado el',
        'created_at' => 'Creado el',
    ],

    'sections' => [
        'personal_info' => 'Información Personal',
        'personal_info_desc' => 'Identidad básica y detalles de contacto.',
        'account_security' => 'Seguridad de la Cuenta',
        'account_security_desc' => 'Gestionar contraseñas y niveles de acceso.',
        'artisanal_details' => 'Detalles Artesanales',
        'artisanal_details_desc' => 'Información extendida del perfil.',
    ],

    'helpers' => [
        'password_edit' => 'Dejar en blanco para mantener la contraseña actual.',
        'admin_access' => 'Otorga acceso al panel de administración.',
    ],
    
    'filters' => [
        'is_admin' => 'Solo Administradores',
    ],
];
