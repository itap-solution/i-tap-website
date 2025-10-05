<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    Github,
    ExternalLink,
    Download,
    Mail,
    Linkedin,
    Twitter,
    Code2,
    Palette,
    Database,
    Smartphone,
    Globe,
    Award,
    Calendar,
    Users,
    ArrowRight,
    Star,
    CheckCircle,
    Zap,
    Shield,
    TrendingUp,
    Cpu,
    Server,
    Cloud,
    GitBranch,
    Layers,
    Workflow,
    Building2
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Project {
    id: number;
    title: string;
    description: string;
    image: string;
    technologies: string[];
    category: string;
    year: number;
    github?: string;
    live?: string;
    featured: boolean;
    stats?: Record<string, string>;
    created_at: string;
    updated_at: string;
}

interface Props {
    projects: Project[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Portfolio',
        href: '/portfolio',
    },
];

// بيانات المطور
const developer = {
    name: 'Son Joe',
    title: 'Senior Full Stack Engineer & Technical Lead',
    subtitle: 'Enterprise Solutions Architect',
    avatar: '/images/avatar.jpg',
    bio: 'Seasoned technology leader with 8+ years of experience architecting and delivering enterprise-grade applications. Specialized in scalable microservices, cloud-native solutions, and leading high-performing development teams.',
    email: 'joe@example.com',
    location: 'New York, USA',
    experience: '8+ years',
    projects: props.projects.length,
    clients: 25,
    rating: 4.9,
    expertise: ['System Architecture', 'Team Leadership', 'Cloud Infrastructure', 'Performance Optimization']
};

// Advanced Statistics
const stats = [
    { number: props.projects.length + '+', label: 'Enterprise Projects', icon: Building2, color: 'text-blue-600' },
    { number: '25+', label: 'Fortune 500 Clients', icon: Shield, color: 'text-purple-600' },
    { number: '8+', label: 'Years Leadership', icon: TrendingUp, color: 'text-green-600' },
    { number: '99.9%', label: 'Uptime SLA', icon: Zap, color: 'text-orange-600' }
];

// Enterprise Services
const services = [
    {
        icon: Building2,
        title: 'System Architecture',
        description: 'Design and implement scalable, high-performance system architectures for enterprise applications',
        features: ['Microservices Design', 'Cloud-Native Solutions', 'Performance Optimization', 'Security First']
    },
    {
        icon: Workflow,
        title: 'Technical Leadership',
        description: 'Lead development teams and establish engineering best practices and standards',
        features: ['Team Management', 'Code Reviews', 'Mentoring', 'Agile Methodologies']
    },
    {
        icon: Cloud,
        title: 'Cloud Infrastructure',
        description: 'Design and deploy robust cloud infrastructure using modern DevOps practices',
        features: ['AWS/Azure/GCP', 'Kubernetes', 'CI/CD Pipelines', 'Infrastructure as Code']
    },
    {
        icon: Cpu,
        title: 'Performance Engineering',
        description: 'Optimize application performance and scalability for high-traffic environments',
        features: ['Load Testing', 'Database Optimization', 'Caching Strategies', 'Monitoring']
    }
];

// Technical Leadership
const leadership = [
    {
        icon: Users,
        title: 'Team Management',
        description: 'Lead cross-functional teams of 15+ developers across multiple time zones',
        metrics: ['15+ Developers', '3 Time Zones', '95% Retention', '4.8/5 Rating']
    },
    {
        icon: Building2,
        title: 'Architecture Design',
        description: 'Design and implement scalable system architectures for enterprise applications',
        metrics: ['50+ Systems', '99.9% Uptime', 'Microservices', 'Cloud-Native']
    },
    {
        icon: Zap,
        title: 'Performance Optimization',
        description: 'Optimize applications for high performance and scalability',
        metrics: ['<200ms Response', '10M+ Users', '99.99% SLA', 'Auto-Scaling']
    }
];

// Get featured projects from database
const featuredProjects = computed(() => {
    return props.projects.filter(project => project.featured).slice(0, 6);
});
</script>

<template>
    <Head title="Portfolio - Son Joe" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
            <!-- Hero Section -->
            <section class="relative py-32 px-4">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/50 to-purple-900/50"></div>
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="relative max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <!-- Developer Information -->
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3 mb-4">
                                    <Badge variant="outline" class="border-blue-400 text-blue-400">
                                        <Shield class="w-3 h-3 mr-1" />
                                        Senior Engineer
                                    </Badge>
                                    <Badge variant="outline" class="border-purple-400 text-purple-400">
                                        <TrendingUp class="w-3 h-3 mr-1" />
                                        Technical Lead
                                    </Badge>
                                </div>
                                <h1 class="text-5xl lg:text-7xl font-bold text-white">
                                    {{ developer.name }}
                                </h1>
                                <h2 class="text-2xl lg:text-3xl text-blue-300 mb-2">
                                    {{ developer.title }}
                                </h2>
                                <h3 class="text-lg text-purple-300 mb-4">
                                    {{ developer.subtitle }}
                                </h3>
                                <p class="text-lg text-slate-200 leading-relaxed max-w-2xl">
                                    {{ developer.bio }}
                                </p>
                            </div>

                            <!-- Expertise Tags -->
                            <div class="flex flex-wrap gap-2">
                                <Badge v-for="skill in developer.expertise" :key="skill" variant="secondary" class="bg-slate-700 text-slate-200">
                                    {{ skill }}
                                </Badge>
                            </div>

                            <!-- Advanced Statistics -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                <div v-for="stat in stats" :key="stat.label" class="text-center">
                                    <component :is="stat.icon" class="w-8 h-8 mx-auto mb-2" :class="stat.color" />
                                    <div class="text-2xl font-bold text-white">{{ stat.number }}</div>
                                    <div class="text-sm text-slate-300">{{ stat.label }}</div>
                                </div>
                            </div>

                            <!-- Contact Buttons -->
                            <div class="flex flex-wrap gap-4">
                                <Button size="lg" class="bg-blue-600 hover:bg-blue-700">
                                    <Mail class="w-4 h-4 mr-2" />
                                    Schedule Consultation
                                </Button>
                                <Button size="lg" variant="outline" class="border-white text-white hover:bg-white hover:text-slate-900">
                                    <Download class="w-4 h-4 mr-2" />
                                    Download Resume
                                </Button>
                            </div>
                        </div>

                        <!-- Professional Avatar -->
                        <div class="relative">
                            <div class="relative w-80 h-80 mx-auto">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full blur-3xl opacity-30"></div>
                                <Avatar class="w-80 h-80 border-8 border-slate-700 shadow-2xl">
                                    <AvatarImage :src="developer.avatar" alt="Son Joe" />
                                    <AvatarFallback class="text-4xl bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                                        {{ developer.name[0] }}
                                    </AvatarFallback>
                                </Avatar>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Leadership Section -->
            <section class="py-20 px-4 bg-slate-800">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-white mb-4">Technical Leadership</h2>
                        <p class="text-lg text-slate-300">Proven track record of leading teams and delivering enterprise solutions</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <Card v-for="item in leadership" :key="item.title" class="bg-slate-700 border-slate-600 hover:bg-slate-600 transition-all duration-300">
                            <CardHeader class="text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <component :is="item.icon" class="w-8 h-8 text-white" />
                                </div>
                                <CardTitle class="text-white">{{ item.title }}</CardTitle>
                            </CardHeader>
                            <CardContent class="text-center">
                                <p class="text-slate-300 mb-4">{{ item.description }}</p>
                                <div class="flex flex-wrap gap-2 justify-center">
                                    <Badge v-for="metric in item.metrics" :key="metric" variant="outline" class="text-xs border-slate-500 text-slate-300">
                                        {{ metric }}
                                    </Badge>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- Enterprise Services -->
            <section class="py-20 px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-white mb-4">Enterprise Services</h2>
                        <p class="text-lg text-slate-300">Comprehensive solutions for enterprise-scale applications</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <Card v-for="service in services" :key="service.title" class="bg-slate-800 border-slate-700 hover:bg-slate-700 transition-all duration-300">
                            <CardHeader class="text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <component :is="service.icon" class="w-8 h-8 text-white" />
                                </div>
                                <CardTitle class="text-white">{{ service.title }}</CardTitle>
                            </CardHeader>
                            <CardContent class="text-center">
                                <p class="text-slate-300 mb-4">{{ service.description }}</p>
                                <div class="space-y-2">
                                    <div v-for="feature in service.features" :key="feature" class="flex items-center gap-2">
                                        <CheckCircle class="w-4 h-4 text-green-400" />
                                        <span class="text-sm text-slate-300">{{ feature }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- Enterprise Projects -->
            <section class="py-20 px-4 bg-slate-800">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-white mb-4">Enterprise Projects</h2>
                        <p class="text-lg text-slate-300">Showcase of enterprise-level applications and solutions</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <Card v-for="project in featuredProjects" :key="project.id" class="bg-slate-700 border-slate-600 hover:bg-slate-600 transition-all duration-300 group">
                            <div class="relative overflow-hidden rounded-t-lg">
                                <img :src="project.image" :alt="project.title" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                                <div class="absolute top-4 left-4">
                                    <Badge v-if="project.featured" class="bg-yellow-500 text-white">
                                        <Star class="w-3 h-3 mr-1" />
                                        Enterprise
                                    </Badge>
                                </div>
                            </div>
                            <CardHeader>
                                <CardTitle class="text-white">{{ project.title }}</CardTitle>
                                <CardDescription class="text-slate-300">{{ project.description }}</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-4">
                                    <!-- Technologies -->
                                    <div class="flex flex-wrap gap-2">
                                        <Badge v-for="tech in project.technologies?.slice(0, 3)" :key="tech" variant="outline" class="text-xs border-slate-500 text-slate-300">
                                            {{ tech }}
                                        </Badge>
                                        <Badge v-if="project.technologies && project.technologies.length > 3" variant="outline" class="text-xs border-slate-500 text-slate-300">
                                            +{{ project.technologies.length - 3 }} more
                                        </Badge>
                                    </div>

                                    <!-- Project Stats -->
                                    <div v-if="project.stats" class="grid grid-cols-2 gap-4">
                                        <div v-for="(value, key) in Object.entries(project.stats).slice(0, 4)" :key="key" class="text-center">
                                            <div class="text-sm font-bold text-white">{{ value[1] }}</div>
                                            <div class="text-xs text-slate-400 capitalize">{{ value[0] }}</div>
                                        </div>
                                    </div>

                                    <!-- Project Links -->
                                    <div class="flex gap-2">
                                        <Button size="sm" variant="outline" class="flex-1 border-slate-500 text-slate-300 hover:bg-slate-600" asChild v-if="project.live">
                                            <a :href="project.live" target="_blank">
                                                <ExternalLink class="w-4 h-4 mr-1" />
                                                Live
                                            </a>
                                        </Button>
                                        <Button size="sm" variant="outline" class="flex-1 border-slate-500 text-slate-300 hover:bg-slate-600" asChild v-if="project.github">
                                            <a :href="project.github" target="_blank">
                                                <Github class="w-4 h-4 mr-1" />
                                                Code
                                            </a>
                                        </Button>
                                        <Button size="sm" variant="outline" class="flex-1 border-slate-500 text-slate-300 hover:bg-slate-600" asChild>
                                            <Link :href="`/projects/${project.id}`">
                                                <ArrowRight class="w-4 h-4 mr-1" />
                                                Details
                                            </Link>
                                        </Button>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <div class="text-center mt-12">
                        <Button size="lg" variant="outline" class="border-white text-white hover:bg-white hover:text-slate-900" asChild>
                            <Link href="/dashboard">
                                <ArrowRight class="w-4 h-4 mr-2" />
                                View All Projects
                            </Link>
                        </Button>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="py-20 px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl font-bold text-white mb-4">Ready to Transform Your Business?</h2>
                    <p class="text-lg text-slate-300 mb-8">Let's discuss how we can build scalable, high-performance solutions for your enterprise</p>

                    <div class="flex flex-wrap justify-center gap-4">
                        <Button size="lg" class="bg-blue-600 hover:bg-blue-700">
                            <Mail class="w-4 h-4 mr-2" />
                            Schedule Consultation
                        </Button>
                        <Button size="lg" variant="outline" class="border-white text-white hover:bg-white hover:text-slate-900">
                            <Download class="w-4 h-4 mr-2" />
                            Download Resume
                        </Button>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-12 grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <Mail class="w-8 h-8 mx-auto mb-4 text-blue-400" />
                            <h3 class="text-white font-semibold mb-2">Email</h3>
                            <p class="text-slate-300">{{ developer.email }}</p>
                        </div>
                        <div class="text-center">
                            <Globe class="w-8 h-8 mx-auto mb-4 text-purple-400" />
                            <h3 class="text-white font-semibold mb-2">Location</h3>
                            <p class="text-slate-300">{{ developer.location }}</p>
                        </div>
                        <div class="text-center">
                            <Users class="w-8 h-8 mx-auto mb-4 text-green-400" />
                            <h3 class="text-white font-semibold mb-2">Experience</h3>
                            <p class="text-slate-300">{{ developer.experience }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="py-12 px-4 border-t border-slate-700">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-slate-400 mb-4 md:mb-0">
                            © 2024 {{ developer.name }}. All rights reserved.
                        </div>
                        <div class="flex gap-4">
                            <Button variant="outline" size="sm" class="border-slate-600 text-slate-400 hover:bg-slate-700" asChild>
                                <a href="https://github.com/joe" target="_blank">
                                    <Github class="w-4 h-4" />
                                </a>
                            </Button>
                            <Button variant="outline" size="sm" class="border-slate-600 text-slate-400 hover:bg-slate-700" asChild>
                                <a href="https://linkedin.com/in/joe" target="_blank">
                                    <Linkedin class="w-4 h-4" />
                                </a>
                            </Button>
                            <Button variant="outline" size="sm" class="border-slate-600 text-slate-400 hover:bg-slate-700" asChild>
                                <a href="https://twitter.com/joe" target="_blank">
                                    <Twitter class="w-4 h-4" />
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.project-card {
    opacity: 0;
    transform: translateY(20px);
}

.project-card.animate-fade-in {
    opacity: 1;
    transform: translateY(0);
}
</style>
