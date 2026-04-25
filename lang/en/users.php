<?php

return [
    'title' => 'Users',
    'single' => 'User',
    'navigation_group' => 'Settings',
    
    'fields' => [
        'name' => 'Name',
        'email' => 'Email Address',
        'phone_number' => 'Phone Number',
        'dni' => 'DNI/ID Number',
        'password' => 'Password',
        'is_admin' => 'Administrator',
        'address' => 'Address',
        'email_verified_at' => 'Verified At',
        'created_at' => 'Created At',
    ],

    'sections' => [
        'personal_info' => 'Personal Information',
        'personal_info_desc' => 'Basic identity and contact details.',
        'account_security' => 'Account Security',
        'account_security_desc' => 'Manage passwords and access levels.',
        'artisanal_details' => 'Artisanal Details',
        'artisanal_details_desc' => 'Extended profile information.',
    ],

    'helpers' => [
        'password_edit' => 'Leave blank to keep current password.',
        'admin_access' => 'Grants access to the administrative dashboard.',
    ],

    'filters' => [
        'is_admin' => 'Administrators Only',
    ],
];
