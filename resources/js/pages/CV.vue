<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Separator } from '@/components/ui/separator';
import {
    Download,
    Mail,
    Phone,
    MapPin,
    Globe,
    Github,
    Linkedin,
    Calendar,
    Building,
    GraduationCap,
    Award,
    Code2,
    Database,
    Palette,
    Smartphone,
    Server,
    Shield,
    Users,
    User,
    Briefcase,
    CheckCircle,
    Code
} from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'CV',
        href: '/cv',
    },
];

// بيانات الشخصية
const personalInfo = {
            name: 'Son Joe',
    title: 'Senior Full Stack Engineer & Technical Lead',
    subtitle: 'Enterprise Solutions Architect',
    email: 'joe@example.com',
    phone: '+1 555 123 4567',
    location: 'New York, USA',
    website: 'https://joe.dev',
    github: 'https://github.com/joe',
    linkedin: 'https://linkedin.com/in/joe',
    avatar: '/images/avatar.jpg'
};

// الخبرات العملية
const experiences = [
    {
        id: 1,
        company: 'TechCorp Solutions',
        position: 'Senior Full Stack Engineer & Technical Lead',
        period: '2022 - Present',
        location: 'New York, USA',
        description: 'Lead architect and technical lead for enterprise-scale applications, managing cross-functional teams and driving technical strategy',
        achievements: [
            'Architected and delivered microservices-based e-commerce platform handling 2M+ daily transactions',
            'Led team of 15+ developers across 3 time zones, achieving 95% team retention rate',
            'Improved system performance by 300% through database optimization and caching strategies',
            'Established CI/CD pipelines reducing deployment time by 80% and achieving 99.9% uptime SLA'
        ],
        technologies: ['Kubernetes', 'Node.js', 'PostgreSQL', 'Redis', 'AWS', 'Docker', 'Terraform']
    },
    {
        id: 2,
        company: 'FinTech Innovations',
        position: 'Senior Backend Engineer',
        period: '2020 - 2022',
        location: 'San Francisco, USA',
        description: 'Developed high-performance financial trading systems and real-time data processing platforms',
        achievements: [
            'Built real-time trading platform processing 100K+ transactions per second with <1ms latency',
            'Implemented event-driven architecture using Apache Kafka, improving system reliability to 99.999%',
            'Designed and optimized database schemas handling $1B+ daily trading volume',
            'Mentored 5 junior developers and established coding standards and best practices'
        ],
        technologies: ['Go', 'Apache Kafka', 'InfluxDB', 'Docker', 'GCP', 'Microservices']
    },
    {
        id: 3,
        company: 'Healthcare Analytics Inc',
        position: 'Full Stack Engineer',
        period: '2018 - 2020',
        location: 'Boston, USA',
        description: 'Developed AI-powered healthcare analytics platform serving 500+ hospitals nationwide',
        achievements: [
            'Built scalable healthcare analytics platform processing data for 10M+ patients',
            'Implemented machine learning models achieving 98.5% accuracy in medical diagnosis',
            'Ensured HIPAA compliance and implemented robust security measures',
            'Optimized database queries reducing response time by 60%'
        ],
        technologies: ['Python', 'TensorFlow', 'MongoDB', 'Kubernetes', 'Azure', 'React']
    }
];

// التعليم
const education = [
    {
        degree: 'Master of Computer Science',
        institution: 'Stanford University',
        period: '2016 - 2018',
        gpa: '3.9/4.0',
        description: 'Specialized in Distributed Systems and Machine Learning'
    },
    {
        degree: 'Bachelor of Computer Science',
        institution: 'MIT',
        period: '2012 - 2016',
        gpa: '3.8/4.0',
        description: 'Focused on Software Engineering and System Architecture'
    }
];

// المهارات التقنية
const technicalSkills = {
    'System Architecture': ['Microservices', 'Event-Driven Architecture', 'Domain-Driven Design', 'API Design', 'Scalability Patterns'],
    'Cloud & DevOps': ['AWS', 'Azure', 'GCP', 'Kubernetes', 'Docker', 'Terraform', 'CI/CD', 'Monitoring'],
    'Backend Development': ['Node.js', 'Go', 'Python', 'Java', 'PostgreSQL', 'MongoDB', 'Redis', 'Kafka'],
    'Frontend Development': ['React', 'Vue.js', 'TypeScript', 'Next.js', 'Tailwind CSS', 'State Management'],
    'Performance & Security': ['Load Testing', 'Database Optimization', 'Caching Strategies', 'Security Best Practices', 'OAuth2'],
    'Leadership & Process': ['Team Leadership', 'Code Reviews', 'Agile Methodologies', 'Technical Mentoring', 'Architecture Reviews']
};

// المشاريع المميزة
const featuredProjects = [
    {
        title: 'Enterprise E-commerce Platform',
        description: 'Scalable microservices-based platform handling 2M+ daily transactions with 99.9% uptime',
        technologies: ['Kubernetes', 'Node.js', 'PostgreSQL', 'Redis', 'AWS'],
        impact: '300% increase in system performance and 50% reduction in infrastructure costs',
        year: 2024
    },
    {
        title: 'Real-time Financial Trading System',
        description: 'High-frequency trading platform processing 100K+ transactions per second with <1ms latency',
        technologies: ['Go', 'Apache Kafka', 'InfluxDB', 'Docker', 'GCP'],
        impact: '99.999% system reliability and $1B+ daily trading volume',
        year: 2023
    },
    {
        title: 'Healthcare Analytics Platform',
        description: 'AI-powered healthcare analytics platform serving 500+ hospitals with 98.5% accuracy',
        technologies: ['Python', 'TensorFlow', 'MongoDB', 'Kubernetes', 'Azure'],
        impact: '10M+ patients served with HIPAA-compliant data processing',
        year: 2022
    }
];

// الشهادات
const certifications = [
    {
        name: 'AWS Solutions Architect Professional',
        issuer: 'Amazon Web Services',
        year: 2023,
        credential: 'AWS-SAP'
    },
    {
        name: 'Google Cloud Professional Cloud Architect',
        issuer: 'Google Cloud',
        year: 2022,
        credential: 'GCP-PCA'
    },
    {
        name: 'Certified Kubernetes Administrator',
        issuer: 'Cloud Native Computing Foundation',
        year: 2021,
        credential: 'CKA'
    },
    {
        name: 'Microsoft Azure Solutions Architect Expert',
        issuer: 'Microsoft',
        year: 2021,
        credential: 'AZ-305'
    }
];

// اللغات
const languages = [
    { name: 'English', level: 'Native' },
    { name: 'Spanish', level: 'Advanced' },
    { name: 'French', level: 'Intermediate' }
];

// Technical Leadership
const leadership = [
    {
        title: 'Team Management',
        description: 'Led 15+ developer teams across multiple time zones',
        metrics: ['15+ Developers', '3 Time Zones', '95% Retention Rate']
    },
    {
        title: 'Architecture Design',
        description: 'Designed scalable architectures for enterprise applications',
        metrics: ['50+ Systems', 'Microservices', 'Cloud-Native']
    },
    {
        title: 'Performance Optimization',
        description: 'Improved system performance by 300% on average',
        metrics: ['300% Improvement', '99.9% Uptime', '<100ms Response']
    }
];

const downloadCV = () => {
    // هنا يمكن إضافة منطق تحميل السي في
    console.log('Downloading CV...');
};

// دالة للحصول على أيقونة الفئة
const getCategoryIcon = (category: string) => {
    const icons: Record<string, any> = {
        'System Architecture': Code2,
        'Cloud & DevOps': Server,
        'Backend Development': Database,
        'Frontend Development': Palette,
        'Performance & Security': Shield,
        'Leadership & Process': Users
    };
    return icons[category] || Code2;
};
</script>

<template>
    <Head title="CV - Son Joe" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
            <div class="max-w-4xl mx-auto px-4">
                <!-- Header -->
                <div class="text-center mb-8">
                    <Avatar class="w-32 h-32 border-4 border-white shadow-lg">
                        <AvatarImage src="/images/avatar.jpg" alt="Son Joe" />
                        <AvatarFallback class="text-4xl bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                            SJ
                        </AvatarFallback>
                    </Avatar>

                    <h1 class="text-3xl font-bold text-slate-900 mb-2">
                        Son Joe
                    </h1>
                    <h2 class="text-xl text-blue-600 mb-2">
                        DevOps Engineer & Full Stack Developer
                    </h2>
                    <h3 class="text-lg text-purple-600 mb-4">
                        Cloud Infrastructure & Automation Specialist
                    </h3>

                    <!-- Contact Information -->
                    <div class="flex flex-wrap justify-center gap-6 text-sm">
                        <div class="flex items-center gap-2">
                            <Mail class="w-4 h-4 text-gray-500" />
                            <span class="text-slate-600">{{ personalInfo.email }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <Phone class="w-4 h-4 text-gray-500" />
                            <span class="text-slate-600">{{ personalInfo.phone }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <MapPin class="w-4 h-4 text-gray-500" />
                            <span class="text-slate-600">{{ personalInfo.location }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <Globe class="w-4 h-4 text-gray-500" />
                            <span class="text-slate-600">{{ personalInfo.website }}</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Left Column -->
                    <div class="md:col-span-2 space-y-8">
                        <!-- Professional Summary -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-slate-900">
                                    <User class="w-5 h-5" />
                                    Professional Summary
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p class="text-blue-600 font-medium">
                                    Seasoned DevOps engineer with 8+ years of experience
                                </p>
                                <p class="text-slate-600 mb-3">
                                    Specialized in architecting and automating enterprise-grade infrastructure,
                                    cloud-native solutions, CI/CD pipelines, container orchestration, and leading
                                    high-performing development teams. Proven track record of delivering scalable,
                                    secure, and efficient solutions for Fortune 500 companies.
                                </p>
                                <div class="space-y-2">
                                    <div class="flex items-start gap-2 text-sm text-slate-600">
                                        <CheckCircle class="w-4 h-4 text-green-500 mt-0.5" />
                                        <span>Led teams of 15+ developers across multiple time zones</span>
                                    </div>
                                    <div class="flex items-start gap-2 text-sm text-slate-600">
                                        <CheckCircle class="w-4 h-4 text-green-500 mt-0.5" />
                                        <span>Reduced deployment time by 80% through CI/CD automation</span>
                                    </div>
                                    <div class="flex items-start gap-2 text-sm text-slate-600">
                                        <CheckCircle class="w-4 h-4 text-green-500 mt-0.5" />
                                        <span>Achieved 99.9% uptime SLA for critical applications</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Work Experience -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-slate-900">
                                    <Briefcase class="w-5 h-5" />
                                    Work Experience
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-6">
                                    <div v-for="experience in experiences" :key="experience.id" class="border-l-4 border-blue-500 pl-4">
                                        <p class="text-blue-600 font-medium">
                                            {{ experience.position }} at {{ experience.company }}
                                        </p>
                                        <p class="text-slate-600 mb-2">
                                            {{ experience.period }} | {{ experience.location }}
                                        </p>
                                        <ul class="space-y-1 text-sm text-slate-600">
                                            <li v-for="achievement in experience.achievements" :key="achievement" class="flex items-start gap-2">
                                                <CheckCircle class="w-3 h-3 text-green-500 mt-1 flex-shrink-0" />
                                                <span>{{ achievement }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Featured Projects -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <h3 class="font-semibold text-slate-900 flex items-center gap-2">
                                    <Award class="w-5 h-5" />
                                    Featured Projects
                                </h3>
                            </CardHeader>
                            <CardContent>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div v-for="project in featuredProjects" :key="project.title" class="border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-900">{{ project.title }}</h4>
                                        <p class="text-slate-600">
                                            {{ project.description }}
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <Badge v-for="tech in project.technologies" :key="tech" variant="outline" class="text-xs">
                                                {{ tech }}
                                            </Badge>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Technical Skills -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-slate-900">
                                    <Code class="w-5 h-5" />
                                    Technical Skills
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-4">
                                    <div v-for="(skills, category) in technicalSkills" :key="category">
                                        <h4 class="font-semibold text-slate-900 mb-2">{{ category }}</h4>
                                        <div class="flex flex-wrap gap-1">
                                            <Badge v-for="skill in skills" :key="skill" variant="outline" class="text-xs">
                                                {{ skill }}
                                            </Badge>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Languages -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-slate-900">
                                    <Globe class="w-5 h-5" />
                                    Languages
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-2">
                                    <div v-for="lang in languages" :key="lang.name" class="flex justify-between items-center">
                                        <span class="font-medium text-slate-900">{{ lang.name }}</span>
                                        <span class="text-sm text-slate-600">{{ lang.level }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Certifications -->
                        <Card class="bg-white border-gray-200 shadow-sm">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-slate-900">
                                    <Award class="w-5 h-5" />
                                    Certifications
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-3">
                                    <div v-for="cert in certifications" :key="cert.name" class="border-l-4 border-green-500 pl-3">
                                        <p class="font-semibold text-slate-900">{{ cert.name }}</p>
                                        <p class="text-sm text-slate-600">{{ cert.issuer }}</p>
                                        <p class="text-sm text-green-600 font-medium">{{ cert.year }}</p>
                                    </div>
                                </div>
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
