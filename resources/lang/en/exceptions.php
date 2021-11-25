<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists' => 'That role already exists. Please choose a different name.',
                'cant_delete_admin' => 'You can not delete the Administrator role.',
                'create_error' => 'There was a problem creating this role. Please try again.',
                'delete_error' => 'There was a problem deleting this role. Please try again.',
                'has_users' => 'You can not delete a role with associated users.',
                'needs_permission' => 'You must select at least one permission for this role.',
                'not_found' => 'That role does not exist.',
                'update_error' => 'There was a problem updating this role. Please try again.',
            ],

            'users' => [
                'already_confirmed' => 'This user is already confirmed.',
                'cant_confirm' => 'There was a problem confirming the user account.',
                'cant_deactivate_self' => 'You can not do that to yourself.',
                'cant_delete_admin' => 'You can not delete the super administrator.',
                'cant_delete_self' => 'You can not delete yourself.',
                'cant_delete_own_session' => 'You can not delete your own session.',
                'cant_restore' => 'This user is not deleted so it can not be restored.',
                'cant_unconfirm_admin' => 'You can not un-confirm the super administrator.',
                'cant_unconfirm_self' => 'You can not un-confirm yourself.',
                'create_error' => 'There was a problem creating this user. Please try again.',
                'delete_error' => 'There was a problem deleting this user. Please try again.',
                'delete_first' => 'This user must be deleted first before it can be destroyed permanently.',
                'email_error' => 'That email address belongs to a different user.',
                'mark_error' => 'There was a problem updating this user. Please try again.',
                'not_confirmed' => 'This user is not confirmed.',
                'not_found' => 'That user does not exist.',
                'restore_error' => 'There was a problem restoring this user. Please try again.',
                'role_needed_create' => 'You must choose at lease one role.',
                'role_needed' => 'You must choose at least one role.',
                'social_delete_error' => 'There was a problem removing the social account from the user.',
                'update_error' => 'There was a problem updating this user. Please try again.',
                'update_password_error' => 'There was a problem changing this users password. Please try again.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => '',
                'confirm' => 'Please verify your email',
                'created_confirm' => 'Your account was successfully created. We have sent you an e-mail to confirm your account.',
                'created_pending' => 'Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.',
                'mismatch' => 'Your confirmation code does not match.',
                'not_found' => 'That confirmation code does not exist.',
                'pending' => 'Your account is currently pending approval.',
                'resend' => 'Your email is not verified. Please check your email to click the verify link, or <a href=":url">click here</a> to resend the verification e-mail.',
                'success' => 'Your email has been successfully verified!',
                'resent' => 'A new email verification has been sent to your email address.',
            ],
            'whatsapp_verification' => [
                'already_confirmed' => 'Your whatsapp number is already confirmed.',
                'confirm' => 'Confirm your account!',
                'created_confirm' => 'Your account was successfully created. We have sent you an e-mail to confirm your account.',
                'created_pending' => 'Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.',
                'mismatch' => 'Your verification code does not match.',
                'not_found' => 'That verification code does not exist.',
                'resend' => 'Your whatsapp number is not verified. Please check your whatsapp to click the verify link, or <a href=":url">click here</a> to resend the verification whatsapp.',
                'success' => 'Your whatsapp has been successfully verified!',
                'resent' => 'A new verification link has been sent to your whatsapp.',
            ],

            'deactivated' => 'Your account has been deactivated.',
            'email_taken' => 'That e-mail address is already taken.',

            'password' => [
                'change_mismatch' => 'That is not your old password.',
                'reset_problem' => 'There was a problem resetting your password. Please resend the password reset email.',
            ],

            'registration_disabled' => 'Registration is currently closed.',
        ],
    ],
];
