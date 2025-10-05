<template>
    <Head title="About Us - iTab" />

    <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <!-- Hero Section -->
        <section class="py-20 px-4 bg-black">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center gap-6 mb-6">
                    <h1 class="text-4xl md:text-6xl font-bold text-white">
                        About
                    </h1>
                    <img src="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png"
                         alt="iTab Logo"
                         class="h-12 md:h-16 w-auto">
                </div>
            </div>
        </section>

        <!-- Company Story -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-8">Our Story</h2>
                        <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
                            <p>
                                Founded in 2016, iTab started as a small team of passionate developers
                                with a vision to revolutionize the software development industry. What began as a startup
                                has grown into a trusted partner for businesses worldwide.
                            </p>
                            <p>
                                Over the years, we've delivered 150+ successful projects, ranging from simple websites
                                to complex enterprise applications. Our commitment to quality, innovation, and customer
                                satisfaction has made us the go-to choice for businesses seeking digital transformation.
                            </p>
                            <p>
                                Today, we continue to push the boundaries of technology, exploring new frontiers in
                                artificial intelligence, machine learning, and cloud computing to deliver solutions
                                that not only meet but exceed our clients' expectations.
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 border border-gray-200">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop"
                                 alt="Team collaboration"
                                 class="w-full h-80 object-cover rounded-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Team Section -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Meet Our Team</h2>
                    <p class="text-xl text-gray-600">The talented individuals behind our success</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="member in teamMembers" :key="member.id"
                         class="text-center p-8 bg-white rounded-3xl border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="relative mx-auto mb-6 w-32 h-32">
                            <img :src="member.image" :alt="member.name"
                                 class="w-full h-full object-cover rounded-full border-4 border-gray-200 group-hover:border-blue-400 transition-colors">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ member.name }}</h3>
                        <p class="text-blue-600 font-medium mb-4">{{ member.position }}</p>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ member.bio }}</p>

                        <!-- Social Links -->
                        <div class="flex justify-center gap-4 mt-6">
                            <a :href="member.linkedin" target="_blank"
                               class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <Linkedin class="w-5 h-5 text-blue-600 group-hover:text-white" />
                            </a>
                            <a :href="member.github" target="_blank"
                               class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                <Github class="w-5 h-5 text-gray-600 group-hover:text-white" />
                            </a>
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

               <!-- Chat Bot -->
               <ChatBot />
           </div>
       </template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import NavBar from '@/components/NavBar.vue'
import ChatBot from '@/components/ChatBot.vue'
import {
    Target,
    Users,
    Award,
    Zap,
    Shield,
    Heart,
    Linkedin,
    Github,
    MessageCircle,
    Eye,
    Mail
} from 'lucide-vue-next'

interface TeamMember {
    id: number
    name: string
    position: string
    bio: string
    image: string
    linkedin: string
    github: string
}

const teamMembers = ref<TeamMember[]>([
    {
        id: 1,
        name: "Alex Johnson",
        position: "CEO & Founder",
        bio: "Visionary leader with 10+ years in software development and business strategy. Passionate about innovation and building world-class teams.",
        image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/alexjohnson",
        github: "https://github.com/alexjohnson"
    },
    {
        id: 2,
        name: "Sarah Chen",
        position: "CTO",
        bio: "Technology expert specializing in scalable architectures and emerging technologies. Leads our technical vision and innovation initiatives.",
        image: "https://images.unsplash.com/photo-1494790108755-2616b612b775?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/sarahchen",
        github: "https://github.com/sarahchen"
    },
    {
        id: 3,
        name: "Michael Rodriguez",
        position: "Lead Full Stack Developer",
        bio: "Full-stack expert with expertise in modern web technologies. Passionate about creating efficient, scalable solutions for complex business problems.",
        image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/michaelrodriguez",
        github: "https://github.com/michaelrodriguez"
    },
    {
        id: 4,
        name: "Emily Davis",
        position: "UI/UX Designer",
        bio: "Creative designer focused on user-centered design and creating beautiful, intuitive interfaces that enhance user experience.",
        image: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/emilydavis",
        github: "https://github.com/emilydavis"
    },
    {
        id: 5,
        name: "David Thompson",
        position: "DevOps Engineer",
        bio: "Infrastructure specialist ensuring reliable, scalable deployments. Expert in cloud technologies and automation processes.",
        image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/davidthompson",
        github: "https://github.com/davidthompson"
    },
    {
        id: 6,
        name: "Lisa Wang",
        position: "Project Manager",
        bio: "Experienced project manager ensuring smooth delivery of complex projects. Expert in agile methodologies and client communication.",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/lisawang",
        github: "https://github.com/lisawang"
    }
])
</script>
