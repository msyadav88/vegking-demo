<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off' => '(If confirmed is off)',
                'no_deactivated' => 'There are no deactivated users.',
                'no_deleted' => 'There are no deleted users.',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],

        'dashboard' => [
            'title' => 'Dashboard',
            'welcome' => 'Welcome',
        ],
        'translations' => [
            'title' => 'Translations',
            'welcome' => 'Welcome',
        ],

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure' => 'Are you sure you want to do this?',
            'boilerplate_link' => 'Laravel 5 Boilerplate',
            'continue' => 'Continue',
            'member_since' => 'Member since',
            'minutes' => ' minutes',
            'search_placeholder' => 'Search...',
            'timeout' => 'You were automatically logged out for security reasons since you had no activity in ',

            'see_all' => [
                'messages' => 'See all messages',
                'notifications' => 'View all',
                'tasks' => 'View all tasks',
            ],

            'status' => [
                'online' => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages' => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks' => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty' => 'Please enter a search term.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title' => 'Search Results',
            'results' => 'Search Results for :query',
        ],

        'welcome' => 'Welcome to the Dashboard',
        'import_buyer' => ['title' => 'Import Buyer'],
        'import_seller' => ['title' => 'Import Sellers'],
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'Twoje konto zosta??o potwierdzone.',
            'error' => 'Whoops!',
            'greeting' => 'Dzie?? dobry!',
            'regards' => 'pozdrowienia,',
            'trouble_clicking_button' => 'Je??li masz problem z klikni??ciem przycisku ???Resetuj has??o???, skopiuj i wklej poni??szy adres URL w przegl??darce internetowej:',
            'thank_you_for_using_app' => 'Dzi??kujemy za skorzystanie z naszej aplikacji!',

            'password_reset_subject' => 'Zresetuj has??o',
            'password_cause_of_email' => 'Otrzymujesz tego e-maila, poniewa?? otrzymali??my pro??b?? o zresetowanie has??a do Twojego konta.',
            'password_if_not_requested' => 'Je??li nie za????da??e?? resetowania has??a, nie musisz podejmowa?? ??adnych dalszych dzia??a??.',
            'reset_password' => 'Kliknij tutaj, aby zresetowa?? has??o',

            'click_to_confirm' => 'Kliknij tutaj, aby potwierdzi?? swoje konto:',
            'thankyou_for_registration' => 'Sprzedaj swoje zapasy jednym klikni??ciem',
            'new_user_registered' => 'We have a new seller',
            'phonenumber' => '44 203290 2939'
        ],

        'contact' => [
            'email_body_title' => 'You have a new contact form request: Below are the details:',
            'subject' => 'A new contact form submission!',
            'acknowledgement_title' => 'Thank you to be in touch with us. Below are your contact details:',
            'acknowledgement_subject' => 'Thank you to be in touch with us',
            'email_verification_link' => 'Please click here to verify your email',
        ],
    ],

    'frontend' => [
        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined' => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'If you change your e-mail you will be logged out until you confirm your new e-mail address.',
            'email_changed_notice' => 'You must confirm your new e-mail address before you can log in again.',
            'profile_updated' => 'Profile successfully updated.',
            'password_updated' => 'Password successfully updated.',
        ],

        'welcome_to' => 'Welcome to :place',
    ],
];
