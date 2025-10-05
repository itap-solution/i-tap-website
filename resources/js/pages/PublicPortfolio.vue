<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import {
    Github,
    ExternalLink,
    Mail,
    Calendar,
    Code2,
    Star,
    ArrowRight,
    Globe,
    Smartphone,
    Linkedin
} from 'lucide-vue-next';

interface Project {
    id: number;
    project_name: string;
    project_description: string;
    project_image: string;
    technologies: string[];
    category: string;
    year: number;
    github?: string;
    live?: string;
    featured: boolean;
    project_price?: number;
    project_discount?: number;
    stats?: Record<string, string>;
    created_at: string;
    updated_at: string;
}

interface Props {
    projects: Project[];
}

const props = defineProps<Props>();

// Get all projects
const allProjects = computed(() => {
    return props.projects;
});

const getTechIcon = (tech: string): string => {
    const techIcons: { [key: string]: string } = {
        'Flutter': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg',
        'Firebase': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg',
        'Node.js': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
        'React': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
        'Laravel': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg',
        'Vue.js': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg',
        'Python': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg',
        'JavaScript': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg',
        'TypeScript': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg',
        'PHP': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg',
        'MySQL': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
        'PostgreSQL': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg',
        'AWS': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original.svg',
        'Docker': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg',
        'Git': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg'
    };

    return techIcons[tech] || 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/devicon/devicon-original.svg';
};

const contactForProject = (project: Project) => {
    const subject = `Inquiry about ${project.project_name} - Project Information`
    const body = `Hello iTab,

I am interested in learning more about your project "${project.project_name}".

Project Details:
- Title: ${project.project_name}
- Category: ${project.category}
- Technologies: ${project.technologies?.join(', ') || 'N/A'}
- Year: ${project.year}

Could you please provide more information about this project?

Best regards,`

    const mailtoLink = `mailto:contact@itab.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
    window.open(mailtoLink, '_self')
};
</script>

<template>
    <Head title="Portfolio - iTab" />

    <PublicLayout>
        <!-- Hero Section -->
        <section class="relative py-32 px-4 bg-black">
            <div class="relative max-w-7xl mx-auto text-center">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold bg-gradient-to-r from-blue-400 via-purple-400 to-cyan-400 bg-clip-text text-transparent mb-6">
                    Our Projects
                </h1>
                <p class="text-xl md:text-2xl text-white font-light mb-8 max-w-3xl mx-auto">
                    Discover our latest projects and innovative solutions that showcase our expertise in modern web and mobile development
                </p>
            </div>
        </section>


        <!-- All Projects -->
        <section id="projects" class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="project in allProjects" :key="project.id"
                         class="group cursor-pointer h-full" @click="contactForProject(project)">
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-1 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-500 group-hover:scale-105 h-full">
                            <div class="bg-white rounded-3xl p-6 h-full flex flex-col">
                                <!-- Project Image -->
                                <div class="relative aspect-video bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-2xl overflow-hidden mb-6">
                                    <img :src="project.project_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'"
                                         :alt="project.project_name"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4">
                                        <div class="bg-white/10 backdrop-blur-sm rounded-full p-2">
                                            <ExternalLink class="w-4 h-4 text-white" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Info -->
                                <div class="flex flex-col flex-grow space-y-4">
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                            {{ project.project_name }}
                                        </h3>
                                        <p class="text-gray-600 leading-relaxed line-clamp-3 min-h-[4.5rem]">{{ project.project_description }}</p>
                                    </div>

                                    <!-- Tech Stack -->
                                    <div class="flex flex-wrap gap-3">
                                        <div v-for="tech in project.technologies?.slice(0, 3)" :key="tech"
                                             class="flex items-center gap-2 text-gray-600 text-sm">
                                            <img :src="getTechIcon(tech)" :alt="tech" class="w-5 h-5" />
                                            <span>{{ tech }}</span>
                                        </div>
                                        <div v-if="project.technologies && project.technologies.length > 3"
                                             class="flex items-center gap-1 text-blue-600 text-sm">
                                            <span class="text-xs">+{{ project.technologies.length - 3 }} more</span>
                                        </div>
                                    </div>

                                    <!-- Project Meta -->
                                    <div class="pt-4 border-t border-gray-200 space-y-3 mt-auto">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500">{{ project.year }}</span>
                                            <div class="flex items-center gap-2 text-blue-600 group-hover:text-blue-700 transition-colors">
                                                <span class="text-sm font-medium">View Project</span>
                                                <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


       <!-- Footer -->
       <footer class="bg-gray-900 text-white">
           <div class="max-w-7xl mx-auto px-4 py-16">
               <!-- Main Footer Content -->
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                   <!-- Company Info -->
                   <div class="lg:col-span-2">
                       <div class="flex items-center mb-6">
                           <img src="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png"
                                alt="iTab Logo"
                                class="h-56 w-auto -ml-8">
                       </div>
                       <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                           Leading software development company specializing in cutting-edge web and mobile applications.
                           We transform innovative ideas into digital excellence.
                       </p>
                       <div class="flex gap-4">
                           <Button variant="outline" size="sm" class="border-gray-600 text-gray-300 hover:bg-gray-800 hover:text-white hover:border-gray-500" asChild>
                               <a href="https://github.com/itab" target="_blank">
                                   <Github class="w-4 h-4" />
                               </a>
                           </Button>
                           <Button variant="outline" size="sm" class="border-gray-600 text-gray-300 hover:bg-gray-800 hover:text-white hover:border-gray-500" asChild>
                               <a href="https://linkedin.com/company/itab" target="_blank">
                                   <Linkedin class="w-4 h-4" />
                               </a>
                           </Button>
                           <Button variant="outline" size="sm" class="border-gray-600 text-gray-300 hover:bg-gray-800 hover:text-white hover:border-gray-500" asChild>
                               <a href="https://twitter.com/itab" target="_blank">
                                   <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                       <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                   </svg>
                               </a>
                           </Button>
                       </div>
                   </div>

                   <!-- Quick Links -->
                   <div>
                       <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                       <ul class="space-y-3">
                           <li><Link href="/" class="text-gray-300 hover:text-white transition-colors">Home</Link></li>
                           <li><Link href="/portfolio" class="text-gray-300 hover:text-white transition-colors">Projects</Link></li>
                           <li><Link href="/about-us" class="text-gray-300 hover:text-white transition-colors">About Us</Link></li>
                           <li><Link href="/contact-us" class="text-gray-300 hover:text-white transition-colors">Contact</Link></li>
                       </ul>
                   </div>

                   <!-- Services -->
                   <div>
                       <h4 class="text-lg font-semibold mb-6">Services</h4>
                       <ul class="space-y-3">
                           <li><span class="text-gray-300">Web Development</span></li>
                           <li><span class="text-gray-300">Mobile Apps</span></li>
                           <li><span class="text-gray-300">AI Solutions</span></li>
                           <li><span class="text-gray-300">Cloud Services</span></li>
                           <li><span class="text-gray-300">Consulting</span></li>
                       </ul>
                   </div>
               </div>

               <!-- Contact Info -->
               <div class="border-t border-gray-800 pt-8 mb-8">
                   <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                       <div class="flex items-center space-x-3">
                           <Mail class="w-5 h-5 text-blue-400" />
                           <div>
                               <p class="text-sm text-gray-400">Email</p>
                               <a href="mailto:contact@itab.com" class="text-white hover:text-blue-400 transition-colors">contact@itab.com</a>
                           </div>
                       </div>
                       <div class="flex items-center space-x-3">
                           <Mail class="w-5 h-5 text-blue-400" />
                           <div>
                               <p class="text-sm text-gray-400">Sales</p>
                               <a href="mailto:sales@itab.com" class="text-white hover:text-blue-400 transition-colors">sales@itab.com</a>
                           </div>
                       </div>
                       <div class="flex items-center space-x-3">
                           <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                           </svg>
                           <div>
                               <p class="text-sm text-gray-400">Location</p>
                               <span class="text-white">Global Remote</span>
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Bottom Bar -->
               <div class="border-t border-gray-800 pt-8">
                   <div class="flex flex-col md:flex-row justify-between items-center">
                       <div class="text-gray-400 text-sm mb-4 md:mb-0">
                           © 2024 iTab. All rights reserved.
                       </div>
                       <div class="flex items-center space-x-6 text-sm">
                           <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                           <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                           <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                       </div>
                   </div>
               </div>
           </div>
       </footer>
    </PublicLayout>
</template>
