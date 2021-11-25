<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Мовні ресурси назв стрічок (Strings)
    |--------------------------------------------------------------------------
    |
    | Наступні мовні ресурси використовуються в назвах
    | стрічокк (Strings) всієї вашої програми.
    | Ви можете вільно змінювати ці мовні ресурси відповідно до вимог
    | вашої програми.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Ви впевнені, що хочете видалити цього користувача назавжди? Якщо в додатку, є посилання на цього користувача, можливо це призведе до помилок. Дійте на свій розсуд!',
                'if_confirmed_off' => '(Якщо чекбокс \'Підтверджено\' неактивний)',
                'no_deactivated' => 'Немає деактивованих користувачів.',
                'no_deleted' => 'Немає вилучених користувачів.',
                'restore_user_confirm' => 'Відновити цього коричтувача?',
            ],
        ],
        'dashboard' => [
            'title' => 'Системна панель',
            'welcome' => 'Ласкаво просимо',
        ],
        'general' => [
            'all_rights_reserved' => 'Всі права захищені.',
            'are_you_sure' => 'Ви впевнені?',
            'boilerplate_link' => 'Laravel 5 Boilerplate',
            'continue' => 'Продовжити',
            'member_since' => 'Користувач з',
            'minutes' => 'хвилин',
            'search_placeholder' => 'Пошук...',
            'timeout' => 'Ви автоматично виведені із системи з міркувань безпеки, так як Ви були активні протягом',
            'see_all' => [
                'messages' => 'Перегляд всіх повідомлень',
                'notifications' => 'Переглянути все',
                'tasks' => 'Переглянути всі задачі',
            ],
            'status' => [
                'offline' => 'Офлайн',
                'online' => 'Онлайн',
            ],
            'you_have' => [
                'messages' => '{0} У Вас немає повідомлень|{1} У Вас 1 повідомлення|[2,Inf] У Вас :number повідомлень',
                'notifications' => '{0} У Вас немає сповіщень|{1} У Вас є 1 сповіщеня|[2,Inf] У Вас :number сповіщень',
                'tasks' => '{0} У Вас немає завдань|{1} У Вас 1 завдання|[2,Inf] У Вас :number завдань',
            ],
        ],
        'search' => [
            'empty' => 'Введіть слово для пошуку.',
            'incomplete' => 'Ви повинні підключити або створити свою систему пошуку для цього додатка.',
            'results' => 'Результати пошуку :query',
            'title' => 'Результати пошуку',
        ],
        'welcome' => 'Ласкаво просимо до Інформаційної панелі',
    ],
    'emails' => [
        'auth' => [
            'account_confirmed' => 'Ваш обліковий запис підтверджено.',
            'error' => 'Ой!',
            'greeting' => 'Вітання!',
            'regards' => 'З повагою,',
            'trouble_clicking_button' => 'Якщо у вас виникли проблеми з натисканням ":action_text" кнопки, скопіюйте і вставте URL нижче в адресний рядок браузера:',
            'thank_you_for_using_app' => 'Дякуємо за використання нашого додатку!',
            'password_reset_subject' => 'Зміна пароля',
            'password_cause_of_email' => 'Ви отримали цей лист, тому що ми отримали запит на зміну пароля для Вашого облікового запису.',
            'password_if_not_requested' => 'Якщо ви не давали запит на зміну пароля, ігноруйте це повідомлення і ніяких додаткових дій робити не потрібно.',
            'reset_password' => 'Клацніть для зміни пароля',
            'click_to_confirm' => 'Клацніть тут, щоб підтвердити ваш обліковий запис:',
        ],
        'contact' => [
            'email_body_title' => 'У вас нове повідомлення з форми зворотного зв\'язку. Подробиці нижче:',
            'subject' => 'Нове :app_name повідомлення форми зворотного зв\'язку!',
        ],
    ],
    'frontend' => [
        'test' => 'Тест',
        'tests' => [
            'based_on' => [
                'permission' => 'Система доступу додатку на прикладі застосування дозволу (ів) в -',
                'role' => 'Система доступу додатку на прикладі застосування ролі (ей) в -',
            ],
            'js_injected_from_controller' => 'Javascript Injected from a Controller',
            'using_access_helper' => [
                'array_permissions' => 'Access Helper з масивом назв дозволів або їх ID\'s, де користувач має всі права.',
                'array_permissions_not' => 'Access Helper з масивом назв дозволів або їх ID\'s, де користувач не володіє всіма правами.',
                'array_roles' => 'Access Helper з масивом імен ролей або їх ID\'s, де користувач має всі права.',
                'array_roles_not' => 'Access Helper з масивом імен ролей або їх ID\'s, де користувач не володіє всіма правами.',
                'permission_id' => 'Access Helper з ID назви дозволу',
                'permission_name' => 'Access Helper з назвою в дозволі',
                'role_id' => 'Access Helper з ID ролі',
                'role_name' => 'Access Helper з ім\'ям ролі',
            ],
            'using_blade_extensions' => 'Використання Blade Розширень',
            'view_console_it_works' => 'Повідомлення console, ви повинні бачити \'це працює!\' що йде від FrontendController@index',
            'you_can_see_because' => 'Ви бачите це, тому що у вас роль \':role\'!',
            'you_can_see_because_permission' => 'Ви бачите це, тому що у вас є дозвіл \':permission\'!',
        ],
        'general' => [
            'joined' => 'З нами',
        ],

        'user' => [
            'change_email_notice' => 'При зміні вашого нового E-mail, він буде перезаписаний, і ви повинні знову підтвердити свій новий E-mail.',
            'email_changed_notice' => 'Ви повинні підтвердити Ваш новий E-mail, перш ніж ви зможете увійти знову.',
            'password_updated' => 'Пароль змінено.',
            'profile_updated' => 'Провіль змінено.',
        ],
        'welcome_to' => 'Вітаємо у програмі :place',
    ],
];
