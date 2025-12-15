<?php

return [
    'index' => [
        'title' => 'Browse Animal Shelters',
        'subtitle' => 'Discover verified shelters and support their mission to help animals in need',
        'search_label' => 'Search by name or location',
        'search_placeholder' => 'Enter shelter name or location...',
        'search_button' => 'Search',
        'clear' => 'Clear',
        'showing' => 'Showing :count shelter(s)',
        'matching' => 'matching ":term"',
        'no_shelters_found' => 'No Shelters Found',
        'no_shelters_description_search' => "We couldn't find any shelters matching \" :term \". Try a different search term.",
        'no_shelters_description_none' => 'There are no registered shelters at the moment.',
        'view_all' => 'View All Shelters',
        'browse_pets_instead' => 'Browse Pets Instead',
        'no_description' => 'No description available',
        'available' => 'Available',
        'view_details' => 'View Details',
    ],

    'show' => [
        'back' => 'Back to Browse Shelters',
        'available_pets' => 'Available Pets (:count)',
        'no_pets' => 'No pets available',
        'verified' => 'Verified Shelter',
        'labels' => [
            'address' => 'Address',
            'contact' => 'Contact',
            'website' => 'Website',
        ],
    ],
    'status' => [
        'verified' => 'Verified',
        'pending' => 'Pending',
    ],
    'admin' => [
        'title' => 'Shelter Verification',
        'subtitle' => 'Review and approve shelter registrations',
        'tabs' => [
            'all' => 'All Shelters',
            'pending' => 'Pending',
            'verified' => 'Verified',
        ],
        'table' => [
            'shelter' => 'Shelter',
            'contact' => 'Contact',
            'registered' => 'Registered',
            'status' => 'Status',
            'actions' => 'Actions',
        ],
        'empty' => [
            'pending' => 'No Pending Shelters',
            'verified' => 'No Verified Shelters',
            'none' => 'No Shelters Found',
            'pending_desc' => 'All shelter registrations have been processed.',
            'default_desc' => 'Waiting for new shelter registrations.',
        ],
        'approve' => 'Approve',
    ],
];
