<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
		'send_to_transport'=> 'Send to Transport',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Active Users',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'User Actions',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
            'sellers' => [
                'active' => 'Active Seller',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create Seller',
                'deactivated' => 'Deactivated Seller',
                'deleted' => 'Deleted Seller',
                'edit' => 'Edit Seller',
                'management' => 'Edit Profile',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'seller_actions' => 'Seller Actions',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Sellers',
                    'no_deleted' => 'No Deleted Sellers',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'Seller total|Sellers total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View Seller',
            ],
        ],


        'trading' => [
            'offers' => [
                'create' => 'Create Offer',
                'edit' => 'Edit Offer',
                'table' => [
                    'id' => 'ID',
                    'product' => 'Product',
					          'name'=>'Name',
                    'variety' => 'Variety',
                    'size' => 'Size',
                    'size_from' => 'Size From',
                    'size_to' => 'Size To',
                    'packing' => 'Packing',
                    'quantity' => 'Quantity',
                    'color' => 'Flesh Color',
                    'location' => 'Location',
                    'location_from' => 'Location From',
                    'location_to' => 'Location To',
                    'price' => 'Price',
					          'type'=>'Type',
					          'desc'=>'Description',
                    'price_from' => 'Price From',
                    'price_to' => 'Price To',
                    'status' => 'Status',
                    'date' => 'Created on',
                    'total' => 'offer total|offers total',
                ],
            ],

            'products' => [
                'create' => 'Create Product',
                'edit' => 'Edit Product',
                'table' => [
                    'id' => 'ID',
                    'product' => 'Product',
                    'variety' => 'Variety',
                    'size' => 'Size',
                    'size_from' => 'Size From',
                    'size_to' => 'Size To',
                    'packing' => 'Packing',
                    'quantity' => 'Quantity',
                    'color' => 'Flesh Color',
                    'location' => 'Location',
                    'location_from' => 'Location From',
                    'location_to' => 'Location To',
                    'price' => 'Price',
                    'status' => 'Status',
                    'date' => 'Created on',
                    'total' => 'offer total|offers total',
                    'product_image' => 'Product Image',
                    'stock_image' => 'Stock Image',
                    'type' => 'Type',
                ],
            ],

            'requests' => [
                'create' => 'Create Request',
                'edit' => 'Edit Request',
                'table' => [
                    'id' => 'ID',
                    'product' => 'Product',
                    'seller' => 'Seller',
                    'buyer' => 'Buyer',
                    'variety' => 'Variety',
                    'size' => 'Size',
                    'size_from' => 'Size From',
                    'size_to' => 'Size To',
                    'packing' => 'Packing',
                    'quantity' => 'Quantity',
                    'color' => 'Flesh Color',
                    'location' => 'Location',
                    'location_from' => 'Location From',
                    'location_to' => 'Location To',
                    'price' => 'Price',
					          'name' => 'Name',
                    'price_from' => 'Price From',
                    'price_to' => 'Price',
                    'status' => 'Status',
                    'date' => 'Created on',
                    'total' => 'offer total|offers total',
                ],
            ],


        ],

        'templates'=>[
            'id' => 'ID',
            'header_title_en' => 'Header Title EN',
            'header_title_de' => 'Header Title DE',
            'header_title_pl' => 'Header Title PL',
            'footer_title_en' => 'Footer Title EN',
            'footer_title_de' => 'Footer Title DE',
            'footer_title_pl' => 'Footer Title PL',
            'title' => 'Title',
            'subject' => 'Subject',
            'shortcodes' => 'Available Shortcodes',
            'email_content' => 'Email Content',
            'email_content_de' => 'Email Content (DE)',
            'email_content_pl' => 'Email Content (PL)',
            'sms_content' => 'SMS/Whatsapp Content',
            'sms_content_de' => 'SMS/Whatsapp Content (DE)',
            'sms_content_pl' => 'SMS/Whatsapp Content (PL)',
            'whatsapp_content' => 'Whatsapp Content',
            'sent' => 'Sent Total',
            'status' => 'Status',
        ],


    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'ZALOGUJ SIĘ',
            'login_button' => 'Zaloguj się',
            'login_with' => 'Zaloguj się z :social_media',
            'register_box_title' => 'ZAREJESTRUJ SIĘ',
            'register_button' => 'Zarejestruj się',
            'remember_me' => 'Zapamiętaj mnie',
        ],

        'contact' => [
            'box_title' => 'Kontakt',
            'button' => 'Wyślij',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Twoje hasło wygasło.',
            'forgot_password' => 'Nie pamiętasz hasła?',
            'reset_password_box_title' => 'Zresetuj hasło',
            'reset_password_button' => 'Zresetuj hasło',
            'update_password_button' => 'Aktualizować hasło',
            'send_password_reset_link_button' => 'Wyślij link resetowania hasła',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Zmień hasło',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'phone' => 'Phone',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'update_information' => 'Update Information',
                'sms' => 'SMS',
                'whatsapp' => 'Whatsapp',
            ],
        ],
    ],
];
