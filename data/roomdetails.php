<?php
    $rooms = [
    'villas' => [
        'NauticalNookVilla' => (object)[
            'category' => 'Villa',
            'image' => 'NauticalNookVilla.png', // Replace with actual image path
            'capacity' => '2 adults and up to 2 children',
            'rating' => 5,
            'price' => 15500,
            'features' => [
                'Private entrance',
                'outdoor living space',
                'personal concierge service',
                'gourmet kitchenette'
            ],
            'facilities' => [
                'Wi-Fi',
                'private beach access',
                'personal concierge',
                'outdoor pool'
            ]
        ],
        'BeachcomberBungalow' => (object)[
            'category' => 'Villa',
            'image' => 'BeachcomberBungalow.png', // Replace with actual image path
            'capacity' => '2 adults and up to 2 children',
            'rating' => 5,
            'price' => 13000,
            'features' => [
                'Private entrance',
                'outdoor living space',
                'personal concierge service',
                'gourmet kitchenette'
            ],
            'facilities' => [
                'Wi-Fi',
                'private beach access',
                'personal concierge',
                'outdoor pool'
            ]
        ]        
        ],
    'suites' => [
        'PearlPenthouse' => (object)[
            'category' => 'Suite',
            'image' => 'PearlPenthouse.png', // Replace with actual image path
            'capacity' => '2 adults, option for additional children',
            'rating' => 5,
            'price' => 12500,
            'features' => [
                'Spacious living area',
                'deluxe bathroom with spa-like amenities',
                'room service menu',
                'daily newspaper delivery'
            ],
            'facilities' => [
                'Wi-Fi',
                '24-hour room service',
                'spa services',
                'outdoor pool'
            ]
        ],
        'SeabreezeSuite' => (object)[
            'category' => 'Suite',
            'image' => 'SeabreezeSuite.PNG', // Replace with actual image path
            'capacity' => '2 adults, option for additional children',
            'rating' => 5,
            'price' => 10000,
            'features' => [
                'Spacious living area',
                'deluxe bathroom with spa-like amenities',
                'room service menu',
                'daily newspaper delivery'
            ],
            'facilities' => [
                'Wi-Fi',
                '24-hour room service',
                'spa services',
                'outdoor pool'
            ]
        ]
    ],

    'familyRooms' => [
        'WaveWhispererFamilySuite' => (object)[
            'category' => 'Family Suite',
            'image' => 'WaveWhispererFamilySuite.png', // Replace with actual image path
            'capacity' => '2 adults and 2 children',
            'rating' => 5,
            'price' => 11000,
            'features' => [
                'Kid-friendly furnishings',
                'game console',
                'snacks and drinks',
                'child care services upon request'
            ],
            'facilities' => [
                'Wi-Fi',
                'kids’ club',
                'shuttle service',
                'laundry service'
            ]
        ],
        'TidalTreasureFamilyRoom' => (object)[
            'category' => 'Family Room',
            'image' => 'TidalTreasureFamilyRoom.png', // Replace with actual image path
            'capacity' => '2 adults and 2 children',
            'rating' => 5,
            'price' => 9500,
            'features' => [
                'Kid-friendly furnishings',
                'game console',
                'snacks and drinks',
                'child care services upon request'
            ],
            'facilities' => [
                'Wi-Fi',
                'kids’ club',
                'shuttle service',
                'laundry service'
            ]
        ]
    ],

    'deluxeRooms' => [
        'SandySanctuaryDeluxe' => (object)[
            'category' => 'Deluxe Room',
            'image' => 'SandySanctuaryDeluxe.png', // Replace with actual image path
            'capacity' => '2 adults, option for 1 child',
            'rating' => 4,
            'price' => 9000,
            'features' => [
                'Private balcony',
                'luxury linens',
                'minibar',
                'high-speed internet',
                'premium bath products'
            ],
            'facilities' => [
                'Wi-Fi',
                'room service',
                'concierge service',
                'fitness center access'
            ]
        ],
        'OceanviewOasis' => (object)[
            'category' => 'Deluxe Room',
            'image' => 'OceanviewOasis.png', // Replace with actual image path
            'capacity' => '2 adults, option for 1 child',
            'rating' => 4,
            'price' => 7000,
            'features' => [
                'Private balcony',
                'luxury linens',
                'minibar',
                'high-speed internet',
                'premium bath products'
            ],
            'facilities' => [
                'Wi-Fi',
                'room service',
                'concierge service',
                'fitness center access'
            ]
        ]
    ],       

    'standardRooms' => [
        'MarinersStandard' => (object)[
            'category' => 'Standard Room',
            'image' => 'MarinersStandard.png', // Replace with actual image path
            'capacity' => '1-2 adults',
            'rating' => 3,
            'price' => 6500,
            'features' => [
                'Comfortable bedding',
                'climate control',
                'flat-screen TV',
                'in-room coffee maker',
                'complimentary toiletries'
            ],
            'facilities' => [
                'Wi-Fi',
                'room service',
                'daily housekeeping'
            ]
        ],
        'CoralChamber' => (object)[
            'category' => 'Standard Room',
            'image' => 'CoralChamber.png', // Replace with actual image path
            'capacity' => '1-2 adults',
            'rating' => 3,
            'price' => 5000,
            'features' => [
                'Comfortable bedding',
                'climate control',
                'flat-screen TV',
                'in-room coffee maker',
                'complimentary toiletries'
            ],
            'facilities' => [
                'Wi-Fi',
                'room service',
                'daily housekeeping'
            ]
            ]
        ],
    'luxurySuites' => [
     'CoralDreamsSuite' => (object)[
        'category' => 'Luxury Suite',
        'image' => 'CoralDreamsSuite.png', // Replace with actual image path
        'capacity' => '2 adults and up to 3 children',
        'rating' => 5,
        'price' => 18000,
        'features' => [
            'Private balcony with ocean view',
            'spacious living area',
            'premium bedding',
            'personalized concierge service',
            'complimentary breakfast'
        ],
        'facilities' => [
            'Wi-Fi',
            '24-hour room service',
            'private beach access',
            'fitness center',
            'infinity pool'
        ]
    ],
    'SunsetSplendorSuite' => (object)[
        'category' => 'Luxury Suite',
        'image' => 'SunsetSplendorSuite.png', // Replace with actual image path
        'capacity' => '2 adults and up to 3 children',
        'rating' => 5,
        'price' => 20000,
        'features' => [
            'Panoramic views of the sunset',
            'separate living and sleeping areas',
            'marble bathroom with Jacuzzi',
            'personalized concierge service',
            'private terrace'
        ],
        'facilities' => [
            'Wi-Fi',
            '24-hour room service',
            'private beach access',
            'fitness center',
            'infinity pool'
        ]
    ]
],
   
];

?>