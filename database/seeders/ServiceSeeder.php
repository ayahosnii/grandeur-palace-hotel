<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Babysitting',
                'description' => 'Professional babysitting services for your convenience. Our experienced staff will take care of your children while you enjoy your stay.',
                'price' => 20.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Laundry Service',
                'description' => 'High-quality laundry and dry cleaning services. We ensure your clothes are cleaned, pressed, and returned to you in perfect condition.',
                'price' => 15.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Hire a Driver',
                'description' => 'Hire a reliable and experienced driver to take you to your desired destinations. Sit back, relax, and let us handle the driving.',
                'price' => 30.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Room Service',
                'description' => 'Enjoy a variety of delicious meals and snacks delivered directly to your room. Our room service is available 24/7 for your convenience.',
                'price' => 10.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Concierge Desk',
                'description' => 'Our knowledgeable concierge staff is here to assist you with booking tours, making reservations, and providing recommendations for local attractions.',
                'price' => 0.00, // No additional cost for concierge services
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Fitness Center',
                'description' => 'Stay active and fit during your stay in our well-equipped fitness center. We offer a range of exercise machines and free weights.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Swimming Pool',
                'description' => 'Take a refreshing dip in our beautiful swimming pool. It\'s the perfect place to relax and unwind on a hot day.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Spa Services',
                'description' => 'Indulge in our spa services and treatments, including massages, facials, and body scrubs. Leave feeling rejuvenated and relaxed.',
                'price' => 50.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Business Center',
                'description' => 'Our fully equipped business center provides computers, printers, and office supplies for your professional needs.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Airport Shuttle Service',
                'description' => 'Let us take care of your transportation to and from the airport. Our shuttle service ensures a hassle-free journey.',
                'price' => 25.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Pet-Friendly Accommodations',
                'description' => 'We welcome your furry friends! Our pet-friendly accommodations ensure a comfortable stay for both you and your pets.',
                'price' => 10.00, // Per night per pet
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Valet Parking',
                'description' => 'Enjoy the convenience of valet parking services. Our attendants will take care of your vehicle with care and professionalism.',
                'price' => 15.00,
                'display_on_homepage' => 0,
            ],
            [
                'name' => '24-Hour Front Desk',
                'description' => 'Our friendly staff is available 24/7 to assist you with any inquiries, requests, or concerns you may have during your stay.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Housekeeping Services',
                'description' => 'We offer daily housekeeping services to ensure your room is clean, tidy, and well-maintained throughout your stay.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'In-Room Amenities',
                'description' => 'Our rooms are equipped with a minibar, in-room safe, and coffee maker for your convenience and comfort.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Special Packages',
                'description' => 'Explore our special packages for weddings, honeymoons, and romantic getaways. Enhance your stay with these tailored experiences.',
                'price' => 0.00, // Prices vary based on the package
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Accessibility Features',
                'description' => 'Our hotel is designed to be accessible to all guests. We offer accessible facilities and services to meet your needs.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Dining Options',
                'description' => 'Savor the flavors of our on-site restaurants, cafes, and bars, offering a wide range of cuisines to suit your taste buds.',
                'price' => 0.00, // Prices vary based on the restaurant
                'display_on_homepage' => 0,
            ],
            [
                'name' => 'Luggage Storage',
                'description' => 'Store your luggage securely with us before check-in or after check-out, allowing you to explore the city without the burden of your bags.',
                'price' => 0.00, // Included in the room rate
                'display_on_homepage' => 0,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

