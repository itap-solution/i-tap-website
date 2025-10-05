<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'project_name' => 'Enterprise E-commerce Platform',
                'project_price' => 50000.00,
                'project_discount' => 10.00,
                'project_image' => '/images/projects/ecommerce.jpg',
                'project_description' => 'Scalable microservices-based platform handling 2M+ daily transactions with 99.9% uptime',
                'technologies' => ['Kubernetes', 'Node.js', 'PostgreSQL', 'Redis', 'AWS'],
                'category' => 'Enterprise',
                'year' => 2024,
                'github' => 'https://github.com/joe/ecommerce',
                'live' => 'https://ecommerce.example.com',
                'featured' => true,
                'stats' => [
                    'users' => '2M+',
                    'revenue' => '$50M+',
                    'uptime' => '99.99%',
                    'performance' => '200ms'
                ]
            ],
            [
                'project_name' => 'Financial Trading System',
                'project_price' => 75000.00,
                'project_discount' => 15.00,
                'project_image' => '/images/projects/trading.jpg',
                'project_description' => 'Real-time trading platform processing 100K+ transactions per second with <1ms latency',
                'technologies' => ['Go', 'Apache Kafka', 'InfluxDB', 'Docker', 'GCP'],
                'category' => 'FinTech',
                'year' => 2023,
                'github' => 'https://github.com/joe/trading',
                'live' => 'https://trading.example.com',
                'featured' => true,
                'stats' => [
                    'transactions' => '100K/sec',
                    'latency' => '<1ms',
                    'reliability' => '99.999%',
                    'volume' => '$1B+'
                ]
            ],
            [
                'project_name' => 'Healthcare Analytics Platform',
                'project_price' => 35000.00,
                'project_discount' => 5.00,
                'project_image' => '/images/projects/healthcare.jpg',
                'project_description' => 'AI-powered healthcare analytics platform serving 500+ hospitals with 98.5% accuracy',
                'technologies' => ['Python', 'TensorFlow', 'MongoDB', 'Kubernetes', 'Azure'],
                'category' => 'Healthcare',
                'year' => 2023,
                'github' => 'https://github.com/joe/healthcare',
                'live' => 'https://healthcare.example.com',
                'featured' => false,
                'stats' => [
                    'hospitals' => '500+',
                    'patients' => '10M+',
                    'accuracy' => '98.5%',
                    'compliance' => 'HIPAA'
                ]
            ],
            [
                'project_name' => 'IoT Smart City Platform',
                'project_price' => 60000.00,
                'project_discount' => 20.00,
                'project_image' => '/images/projects/iot.jpg',
                'project_description' => 'Comprehensive IoT platform managing 50K+ connected devices across smart city infrastructure',
                'technologies' => ['Python', 'MQTT', 'InfluxDB', 'Kubernetes', 'AWS IoT'],
                'category' => 'IoT',
                'year' => 2024,
                'github' => 'https://github.com/joe/iot-platform',
                'live' => 'https://iot.example.com',
                'featured' => true,
                'stats' => [
                    'devices' => '50K+',
                    'data_points' => '1M+/day',
                    'efficiency' => '85%',
                    'coverage' => '100%'
                ]
            ],
            [
                'project_name' => 'Mobile Banking App',
                'project_price' => 25000.00,
                'project_discount' => 0.00,
                'project_image' => '/images/projects/banking.jpg',
                'project_description' => 'Secure mobile banking application serving 1M+ users with real-time transaction processing',
                'technologies' => ['React Native', 'Node.js', 'PostgreSQL', 'Redis', 'AWS'],
                'category' => 'FinTech',
                'year' => 2023,
                'github' => 'https://github.com/joe/banking-app',
                'live' => 'https://banking.example.com',
                'featured' => false,
                'stats' => [
                    'users' => '1M+',
                    'transactions' => '500K/day',
                    'security' => '99.99%',
                    'uptime' => '99.95%'
                ]
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
