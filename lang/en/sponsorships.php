<?php

return [
    'create' => [
        'title' => 'Sponsor Shelter',
        'back_to_shelter' => 'Back to Shelter Profile',
        'cancel' => 'Cancel',
        'submit' => 'Sponsor',
            'subtitle' => 'Your donation helps care for all animals at this shelter',
            'donation_amount' => 'Donation Amount',
            'or_enter_custom' => 'Or enter custom amount (Minimum Rp :min) *',
            'enter_amount_placeholder' => 'Enter amount (e.g., 50000)',
            'minimum_donation' => 'Minimum donation: Rp :min',
            'message_optional' => 'Message (Optional)',
            'leave_message' => 'Leave a message for the shelter',
            'message_visible_note' => 'Your message will be visible to the shelter',
            'privacy' => 'Privacy',
            'make_anonymous' => 'Make my donation anonymous',
                'secure_payment' => 'Secure payment powered by Midtrans',
                'processing' => 'Processing...',
                'pending_alert' => 'Payment is pending. Please complete your payment.',
                'failed_alert' => 'Payment failed. Please try again.',
        'note_privacy' => 'Your name will be hidden from public donation lists, but the shelter will still be able to see donor details.',
    ],
    'success' => [
        'thank_you' => 'Thank you for your sponsorship!',
        'browse_pets' => 'Browse Pets',
    ],
    'failed' => [
        'failed' => 'Payment Failed',
        'back_to_shelter' => 'Back to Shelter',
        'try_again' => 'Try Again',
        'status_failed' => 'Failed',
        'common_reasons' => [
            'title' => 'Common reasons for payment failure:',
            'insufficient' => 'Insufficient balance',
            'cancelled' => 'Payment cancelled',
            'declined' => 'Card declined',
            'timeout' => 'Session timeout',
        ],
    ],
];
