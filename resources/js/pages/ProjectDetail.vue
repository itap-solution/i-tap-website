<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';
import {
    Github,
    ExternalLink,
    ArrowLeft,
    Calendar,
    Users,
    Code2,
    Database,
    Palette,
    Smartphone,
    Globe,
    Award,
    CheckCircle,
    Star
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

// بيانات المشروع (في التطبيق الحقيقي ستأتي من الخادم)
const project = {
    id: 1,
    title: 'Comprehensive E-commerce Platform',
    subtitle: 'Comprehensive e-commerce platform with inventory management, payments, and analytics',
    description: 'A comprehensive e-commerce platform developed using the latest technologies to provide an exceptional shopping experience. The platform includes advanced inventory management, secure payment system, comprehensive analytics dashboard, and smart delivery system.',
    image: '/images/projects/ecommerce.jpg',
    gallery: [
        '/images/projects/ecommerce-1.jpg',
        '/images/projects/ecommerce-2.jpg',
        '/images/projects/ecommerce-3.jpg',
        '/images/projects/ecommerce-4.jpg'
    ],
    technologies: {
        'Frontend': ['Vue.js 3', 'TypeScript', 'Tailwind CSS', 'Pinia'],
        'Backend': ['Laravel 10', 'PHP 8.2', 'MySQL 8.0', 'Redis'],
        'Mobile': ['React Native', 'Expo'],
        'DevOps': ['Docker', 'AWS', 'CI/CD', 'Nginx']
    },
    features: [
        'Advanced product and inventory management system',
        'Secure payment system with card and electronic payment support',
        'Comprehensive analytics and reporting dashboard',
        'Smart delivery system with order tracking',
        'Mobile app for customers and vendors',
        'Customer management and loyalty system',
        'Advanced admin interface for vendors',
        'Product rating and review system'
    ],
    challenges: [
        'Handling high order volumes during peak seasons',
        'Securing payments and protecting customer data',
        'Optimizing database performance',
        'Developing smooth and responsive user interface'
    ],
    solutions: [
        'Implemented advanced caching system using Redis',
        'Applied PCI DSS standards for payment security',
        'Optimized database queries and created indexes',
        'Used responsive design and comprehensive UI testing'
    ],
    results: [
        '300% increase in sales during first 6 months',
        '60% improvement in website loading speed',
        '45% increase in customer retention rate',
        '30% reduction in cart abandonment rate'
    ],
    category: 'E-commerce',
    year: 2024,
    duration: '6 months',
    team: '5 developers',
    github: 'https://github.com/joe/ecommerce',
    live: 'https://ecommerce.example.com',
    demo: 'https://demo.ecommerce.example.com',
    featured: true,
    stats: {
        users: '50,000+',
        orders: '100,000+',
        revenue: '$2M+',
        rating: 4.8
    }
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Portfolio',
        href: '/portfolio',
    },
    {
        title: project.title,
        href: `/projects/${project.id}`,
    },
];

const getTechnologyIcon = (category: string) => {
    const icons = {
        'Frontend': Palette,
        'Backend': Code2,
        'Mobile': Smartphone,
        'DevOps': Globe,
        'Database': Database
    };
    return icons[category] || Code2;
};
</script>

<template>
    <Head :title="`${project.title} - Portfolio`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800">
            <!-- Header -->
            <div class="relative h-96 overflow-hidden">
                <img
                    :src="project.image"
                    :alt="project.title"
                    class="w-full h-full object-cover"
                />
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 w-full">
                                                    <div class="flex items-center gap-4 mb-4">
                                <Button variant="outline" size="sm" asChild>
                                    <Link href="/portfolio">
                                        <ArrowLeft class="w-4 h-4 mr-2" />
                                        Back to Portfolio
                                    </Link>
                                </Button>
                            <Badge v-if="project.featured" class="bg-yellow-500 text-white">
                                <Star class="w-3 h-3 mr-1" />
                                Featured Project
                            </Badge>
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4">
                            {{ project.title }}
                        </h1>
                        <p class="text-xl text-white/90 max-w-3xl">
                            {{ project.subtitle }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 py-12">
                <!-- الإحصائيات السريعة -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                    <Card class="text-center">
                        <CardContent class="p-6">
                            <Users class="w-8 h-8 mx-auto mb-2 text-blue-600" />
                            <div class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ project.stats.users }}
                            </div>
                            <div class="text-sm text-slate-500">مستخدم نشط</div>
                        </CardContent>
                    </Card>
                    <Card class="text-center">
                        <CardContent class="p-6">
                            <Award class="w-8 h-8 mx-auto mb-2 text-green-600" />
                            <div class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ project.stats.orders }}
                            </div>
                            <div class="text-sm text-slate-500">طلب مكتمل</div>
                        </CardContent>
                    </Card>
                    <Card class="text-center">
                        <CardContent class="p-6">
                            <CheckCircle class="w-8 h-8 mx-auto mb-2 text-purple-600" />
                            <div class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ project.stats.revenue }}
                            </div>
                            <div class="text-sm text-slate-500">إيرادات</div>
                        </CardContent>
                    </Card>
                    <Card class="text-center">
                        <CardContent class="p-6">
                            <Star class="w-8 h-8 mx-auto mb-2 text-yellow-600" />
                            <div class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ project.stats.rating }}
                            </div>
                            <div class="text-sm text-slate-500">تقييم</div>
                        </CardContent>
                    </Card>
                </div>

                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- المحتوى الرئيسي -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- الوصف -->
                        <Card>
                            <CardHeader>
                                <CardTitle>وصف المشروع</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                                    {{ project.description }}
                                </p>
                            </CardContent>
                        </Card>

                        <!-- معرض الصور -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Image Gallery</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="grid grid-cols-2 gap-4">
                                    <img
                                        v-for="(image, index) in project.gallery"
                                        :key="index"
                                        :src="image"
                                        :alt="`${project.title} - صورة ${index + 1}`"
                                        class="w-full h-48 object-cover rounded-lg hover:scale-105 transition-transform duration-300 cursor-pointer"
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        <!-- المميزات -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Key Features</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div v-for="feature in project.features" :key="feature" class="flex items-start gap-3">
                                        <CheckCircle class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" />
                                        <span class="text-slate-600 dark:text-slate-300">{{ feature }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- التحديات والحلول -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Challenges & Solutions</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-6">
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">Challenges:</h3>
                                    <ul class="space-y-2">
                                        <li v-for="challenge in project.challenges" :key="challenge"
                                            class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                                            <div class="w-2 h-2 bg-red-500 rounded-full mt-2 flex-shrink-0"></div>
                                            {{ challenge }}
                                        </li>
                                    </ul>
                                </div>
                                <Separator />
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">Solutions:</h3>
                                    <ul class="space-y-2">
                                        <li v-for="solution in project.solutions" :key="solution"
                                            class="flex items-start gap-3 text-slate-600 dark:text-slate-300">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                                            {{ solution }}
                                        </li>
                                    </ul>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- النتائج -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Achieved Results</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div v-for="result in project.results" :key="result" class="flex items-start gap-3">
                                        <Award class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" />
                                        <span class="text-slate-600 dark:text-slate-300">{{ result }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- الشريط الجانبي -->
                    <div class="space-y-6">
                        <!-- معلومات المشروع -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Project Information</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Category:</span>
                                    <Badge>{{ project.category }}</Badge>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Year:</span>
                                    <span class="text-slate-900 dark:text-white">{{ project.year }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Duration:</span>
                                    <span class="text-slate-900 dark:text-white">{{ project.duration }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Team:</span>
                                    <span class="text-slate-900 dark:text-white">{{ project.team }}</span>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- التقنيات المستخدمة -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Technologies Used</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <div v-for="(techs, category) in project.technologies" :key="category" class="space-y-2">
                                    <h3 class="font-medium text-slate-900 dark:text-white flex items-center gap-2">
                                        <component :is="getTechnologyIcon(category)" class="w-4 h-4" />
                                        {{ category }}
                                    </h3>
                                    <div class="flex flex-wrap gap-2">
                                        <Badge v-for="tech in techs" :key="tech" variant="outline" class="text-xs">
                                            {{ tech }}
                                        </Badge>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- الروابط -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Project Links</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-3">
                                <Button class="w-full" asChild>
                                    <a :href="project.live" target="_blank">
                                        <ExternalLink class="w-4 h-4 mr-2" />
                                        View Live Site
                                    </a>
                                </Button>
                                <Button variant="outline" class="w-full" asChild>
                                    <a :href="project.github" target="_blank">
                                        <Github class="w-4 h-4 mr-2" />
                                        Source Code
                                    </a>
                                </Button>
                                <Button variant="outline" class="w-full" asChild>
                                    <a :href="project.demo" target="_blank">
                                        <Globe class="w-4 h-4 mr-2" />
                                        View Demo
                                    </a>
                                </Button>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* تحسينات إضافية للتصميم */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style>
