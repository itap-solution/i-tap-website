<template>
    <Head title="About Us - iTab" />

    <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/logo-new-white.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <!-- Hero Section -->
        <section class="py-20 px-4 bg-black">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center gap-6 mb-6">
                    <h1 class="text-4xl md:text-6xl font-bold text-white">
                        {{ t('aboutTitle') }}
                    </h1>
                    <img src="/asset/logo-new-white.png"
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
                        <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-8">{{ t('aboutOurStory') }}</h2>
                        <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
                            <p>
                                {{ t('aboutStory1') }}
                            </p>
                            <p>
                                {{ t('aboutStory2') }}
                            </p>
                            <p>
                                {{ t('aboutStory3') }}
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
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">{{ t('aboutMeetTeam') }}</h2>
                    <p class="text-xl text-gray-600">{{ t('aboutTeamSubtitle') }}</p>
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
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="flex flex-col items-center justify-center space-y-6">
                    <!-- Company Name -->
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-white">{{ t('footerCompany') }}</h3>
                    </div>

                    <!-- Social Media Links -->
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/itab" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200">
                            <Github class="w-6 h-6" />
                        </a>
                        <a href="https://linkedin.com/company/itab" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200">
                            <Linkedin class="w-6 h-6" />
                        </a>
                        <a href="https://twitter.com/itab" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Copyright -->
                    <div class="text-gray-400 text-sm">
                        {{ t('footerCopyright') }}
                    </div>
                </div>
            </div>
        </footer>

        <!-- WhatsApp Button -->
        <a href="https://wa.me/966535815072" target="_blank" rel="noopener noreferrer"
           class="fixed bottom-6 right-6 md:bottom-6 md:right-6 sm:bottom-4 sm:right-4 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 md:p-6 shadow-lg transition-all duration-300 hover:scale-110"
           style="z-index: 9999; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.388 5.983L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.89a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
           </div>
       </template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, watch, computed } from 'vue'
import { Button } from '@/components/ui/button'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'
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

// Language support
const { currentLanguage, setLanguage, t, isRTL } = useLanguage()

// Watch language changes and update HTML dir attribute
watch(currentLanguage, (newLang) => {
    if (newLang === 'ar') {
        document.documentElement.setAttribute('dir', 'rtl')
        document.documentElement.setAttribute('lang', 'ar')
    } else {
        document.documentElement.setAttribute('dir', 'ltr')
        document.documentElement.setAttribute('lang', 'en')
    }
}, { immediate: true })

interface TeamMember {
    id: number
    name: string
    position: string
    bio: string
    image: string
    linkedin: string
    github: string
    positionKey?: string
}

const teamMembersData = [
    {
        id: 1,
        name: "Alex Johnson",
        positionKey: 'aboutCEO',
        bio: "Visionary leader with 10+ years in software development and business strategy. Passionate about innovation and building world-class teams.",
        image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/alexjohnson",
        github: "https://github.com/alexjohnson"
    },
    {
        id: 2,
        name: "Sarah Chen",
        positionKey: 'aboutCTO',
        bio: "Technology expert specializing in scalable architectures and emerging technologies. Leads our technical vision and innovation initiatives.",
        image: "https://images.unsplash.com/photo-1494790108755-2616b612b775?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/sarahchen",
        github: "https://github.com/sarahchen"
    },
    {
        id: 3,
        name: "Michael Rodriguez",
        positionKey: 'aboutLeadDeveloper',
        bio: "Full-stack expert with expertise in modern web technologies. Passionate about creating efficient, scalable solutions for complex business problems.",
        image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/michaelrodriguez",
        github: "https://github.com/michaelrodriguez"
    },
    {
        id: 4,
        name: "Emily Davis",
        positionKey: 'aboutDesigner',
        bio: "Creative designer focused on user-centered design and creating beautiful, intuitive interfaces that enhance user experience.",
        image: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/emilydavis",
        github: "https://github.com/emilydavis"
    },
    {
        id: 5,
        name: "David Thompson",
        positionKey: 'aboutDevOps',
        bio: "Infrastructure specialist ensuring reliable, scalable deployments. Expert in cloud technologies and automation processes.",
        image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/davidthompson",
        github: "https://github.com/davidthompson"
    },
    {
        id: 6,
        name: "Lisa Wang",
        positionKey: 'aboutPM',
        bio: "Experienced project manager ensuring smooth delivery of complex projects. Expert in agile methodologies and client communication.",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&h=400&fit=crop&crop=face",
        linkedin: "https://linkedin.com/in/lisawang",
        github: "https://github.com/lisawang"
    }
]

const teamMembers = computed<TeamMember[]>(() => {
    return teamMembersData.map(member => ({
        ...member,
        position: t(member.positionKey as any)
    }))
})
</script>
