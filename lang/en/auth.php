<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    // Custom labels
    'login' => 'Log in',
    'register' => 'Register',
    'email' => 'Email',
    'password_label' => 'Password',
    'remember_me' => 'Remember me',
    'forgot_password' => 'Forgot your password?',
    'name' => 'Name',
    'confirm_password' => 'Confirm Password',
    'already_registered' => 'Already registered?',
    'logout' => 'Log Out',

    // Registration
    'register_as_adopter' => 'Register as Adopter',
    'register_as_shelter' => 'Register as Shelter',
    'register_adopter_account' => 'Register Adopter Account',
    'register_shelter_account' => 'Register Shelter Account',
    'verify_email' => [
        'message' => "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.",
        'link_sent' => 'A new verification link has been sent to the email address you provided during registration.',
        'resend' => 'Resend Verification Email',
    ],
    'register' => [
        'account_title' => 'Account Information',
        'shelter_title' => 'Shelter Information',
        'note_title' => 'Note:',
        'note_message' => "Your shelter registration will be reviewed by our admin team. You'll be able to post pets once your account is verified.",
    ],
];
