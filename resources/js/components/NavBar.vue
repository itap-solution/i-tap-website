<template>
    <nav :class="['absolute top-8 left-0 right-0 z-50', backgroundColorClass]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <Link href="/" class="flex items-center">
                        <img :src="logoSrc"
                             alt="iTab Logo"
                             class="h-48 w-auto mt-1">
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <Link href="/"
                              :class="textColorClass + ' hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10'">
                            الرئيسية
                        </Link>

                        <!-- Services Dropdown -->
                        <div class="relative" @mouseenter="isServicesDropdownOpen = true" @mouseleave="isServicesDropdownOpen = false">
                            <button :class="textColorClass + ' hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10 flex items-center gap-1'">
                                الخدمات
                                <ChevronDown class="w-4 h-4 transition-transform duration-200" :class="isServicesDropdownOpen ? 'rotate-180' : ''" />
                            </button>

                            <!-- Dropdown Menu -->
                            <div v-show="isServicesDropdownOpen"
                                 class="absolute top-full left-0 mt-3 w-80 bg-white/98 backdrop-blur-xl border border-gray-200/50 rounded-2xl shadow-2xl z-50 overflow-hidden"
                                 style="box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.05);">

                                <!-- Header -->
                                <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-4 border-b border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-900">خدماتنا</h3>
                                    <p class="text-sm text-gray-600 mt-1">حلول احترافية لعملك</p>
                                </div>

                                <!-- Services List -->
                                <div class="py-3">
                                    <Link v-for="(service, index) in services" :key="service.name" :href="service.href"
                                          class="group flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 hover:text-gray-900 transition-all duration-200 border-l-4 border-transparent hover:border-blue-500">
                                        <div class="flex-1">
                                            <div class="font-medium group-hover:text-blue-600 transition-colors duration-200">
                                                {{ service.name }}
                                            </div>
                                        </div>
                                        <div class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </Link>
                                </div>

                                <!-- Footer -->
                                <div class="bg-gray-50/50 px-6 py-3 border-t border-gray-100">
                                    <Link href="/contact-us" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                                        احصل على استشارة مجانية ←
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <Link href="/about-us"
                              :class="textColorClass + ' hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10'">
                            من نحن
                        </Link>
                        <Link href="/contact-us"
                              :class="textColorClass + ' hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10'">
                            اتصل بنا
                        </Link>
                        
                        <!-- Language Switcher -->
                        <div class="relative" @mouseenter="isLanguageDropdownOpen = true" @mouseleave="isLanguageDropdownOpen = false">
                            <button :class="textColorClass + ' hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10 flex items-center gap-2'">
                                <Globe class="w-4 h-4" />
                                <span class="hidden lg:inline">{{ currentLanguage === 'ar' ? 'العربية' : 'English' }}</span>
                            </button>
                            
                            <!-- Language Dropdown -->
                            <div v-show="isLanguageDropdownOpen"
                                 class="absolute top-full right-0 mt-2 w-48 bg-white/98 backdrop-blur-xl border border-gray-200/50 rounded-xl shadow-lg z-50 overflow-hidden">
                                <div class="py-2">
                                    <button @click="changeLanguage('en')"
                                            :class="['w-full text-left px-4 py-2 text-sm transition-colors duration-200 flex items-center gap-2', currentLanguage === 'en' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50']">
                                        <span class="text-lg">🇺🇸</span>
                                        <span>English</span>
                                        <span v-if="currentLanguage === 'en'" class="ml-auto text-blue-600">✓</span>
                                    </button>
                                    <button @click="changeLanguage('ar')"
                                            :class="['w-full text-left px-4 py-2 text-sm transition-colors duration-200 flex items-center gap-2', currentLanguage === 'ar' ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50']">
                                        <span class="text-lg">🇪🇬</span>
                                        <span>العربية</span>
                                        <span v-if="currentLanguage === 'ar'" class="ml-auto text-blue-600">✓</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="toggleMobileMenu"
                            :class="textColorClass + ' hover:text-gray-300 focus:outline-none focus:text-gray-300 p-2'">
                        <svg v-if="!isMobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg v-else class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div v-show="isMobileMenuOpen" class="md:hidden bg-white/95 backdrop-blur-md border-t border-gray-200 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link href="/"
                      class="text-gray-900 hover:text-gray-700 block px-3 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-gray-100">
                    الرئيسية
                </Link>

                <!-- Services Section for Mobile -->
                <div class="px-3 py-3 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg mx-3 mb-3">
                    <div class="text-gray-900 font-semibold text-base mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        خدماتنا
                    </div>
                    <div class="space-y-2">
                        <Link v-for="service in services" :key="service.name" :href="service.href"
                              class="group flex items-center justify-between text-gray-700 hover:text-gray-900 block px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-white/80 hover:shadow-sm border border-transparent hover:border-blue-200">
                            <span class="group-hover:text-blue-600 transition-colors duration-200">{{ service.name }}</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </Link>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-200">
                        <Link href="/contact-us" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            احصل على استشارة مجانية
                        </Link>
                    </div>
                </div>

                <Link href="/about-us"
                      class="text-gray-900 hover:text-gray-700 block px-3 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-gray-100">
                    من نحن
                </Link>
                <Link href="/contact-us"
                      class="text-gray-900 hover:text-gray-700 block px-3 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-gray-100">
                    اتصل بنا
                </Link>
                
                <!-- Language Switcher Mobile -->
                <div class="px-3 py-2 border-t border-gray-200">
                    <div class="text-gray-900 font-semibold text-sm mb-2">اللغة</div>
                    <div class="flex gap-2">
                        <button @click="changeLanguage('en')"
                                :class="['flex-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-2', currentLanguage === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200']">
                            <span>🇺🇸</span>
                            <span>English</span>
                        </button>
                        <button @click="changeLanguage('ar')"
                                :class="['flex-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-2', currentLanguage === 'ar' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200']">
                            <span>🇪🇬</span>
                            <span>العربية</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref, computed, onMounted, watch } from 'vue'
import { ChevronDown, Globe } from 'lucide-vue-next'
import { useLanguage } from '@/composables/useLanguage'

interface Props {
    logoSrc?: string
    textColor?: string
    backgroundColor?: string
}

const props = withDefaults(defineProps<Props>(), {
    logoSrc: '/asset/logo-new-white.png',
    textColor: 'white',
    backgroundColor: 'transparent'
})

const isMobileMenuOpen = ref(false)
const isServicesDropdownOpen = ref(false)
const isLanguageDropdownOpen = ref(false)

// Use language composable
const { currentLanguage, setLanguage, t } = useLanguage()

const changeLanguage = (lang: 'ar' | 'en') => {
    setLanguage(lang)
    isLanguageDropdownOpen.value = false
}

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const toggleServicesDropdown = () => {
    isServicesDropdownOpen.value = !isServicesDropdownOpen.value
}

const textColorClass = computed(() => {
    return props.textColor === 'black' ? 'text-gray-900' : 'text-white'
})

const backgroundColorClass = computed(() => {
    return props.backgroundColor === 'black' ? 'bg-black' : 'bg-transparent'
})

const services = [
    { name: 'تطوير المواقع', href: '/services/web-development' },
    { name: 'تطوير التطبيقات', href: '/services/mobile-development' },
    { name: 'الحلول البرمجية', href: '/services/software-solutions' },
    { name: 'المساعد الافتراضي والأتمتة', href: '/services/chatbot-automation' },
    { name: 'الحضور الرقمي والتسويق', href: '/services/digital-marketing' },
    { name: 'خدمات السحابة والـ DevOps', href: '/services/cloud-devops' },
    { name: 'الاستشارات والدعم الفني', href: '/services/consulting' }
]
</script>

<style scoped>
/* Additional styles if needed */
</style>
