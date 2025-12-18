<template>
    <Head title="Contact Us - iTab" />

    <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <!-- Hero Section -->
        <section class="py-20 px-4 bg-black">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-6">
                    {{ t('contactTitle') }}
                </h1>
                <p class="text-xl text-white max-w-3xl mx-auto mb-12">
                    {{ t('contactSubtitle') }}
                </p>
            </div>
        </section>

        <!-- Contact Information -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ t('contactInfo') }}</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ t('contactInfoSubtitle') }}
                    </p>
                            </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Email Card -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Mail class="w-8 h-8 text-gray-700" />
                            </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('contactEmailLabel') }}</h3>
                        <div class="space-y-2">
                            <a href="mailto:info@itap-tech.com" class="block text-gray-600 hover:text-blue-600 transition-colors">
                                info@itap-tech.com
                            </a>
                            <a href="mailto:marketing@itap-tech.com" class="block text-gray-600 hover:text-blue-600 transition-colors">
                                marketing@itap-tech.com
                            </a>
                            </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Phone class="w-8 h-8 text-gray-700" />
                                    </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('contactPhoneLabel') }}</h3>
                        <div class="space-y-2">
                            <a href="tel:+201015843432" class="block text-gray-600 hover:text-blue-600 transition-colors">
                                +201015843432
                            </a>
                            <a href="tel:+966535815072" class="block text-gray-600 hover:text-blue-600 transition-colors">
                                +966535815072
                            </a>
                                    </div>
                                </div>

                    <!-- Address Card -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <MapPin class="w-8 h-8 text-gray-700" />
                                    </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('contactAddress') }}</h3>
                        <div class="space-y-1 text-gray-600">
                            <p>123 Tech Street, Canary Wharf</p>
                            <p>London E14 5AB, UK</p>
                                    </div>
                                </div>

                    <!-- Business Hours Card -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Clock class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('contactBusinessHours') }}</h3>
                        <div class="text-gray-600">
                            <p>{{ t('contactBusinessHoursNew') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Branches Section -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">{{ t('contactBranches') }}</h2>
                    <p class="text-xl text-gray-600">{{ t('contactBranchesSubtitle') }}</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- UK Branch -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <div class="mr-4">
                                <span class="text-3xl">🇬🇧</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ t('contactUK') }}</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">{{ t('contactLondon') }}</p>
                                <p class="text-gray-600 text-sm">123 Tech Street, Canary Wharf</p>
                                <p class="text-gray-600 text-sm">London E14 5AB, UK</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="text-gray-500 text-xs">uk@itab.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Egypt Branch -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <div class="mr-4">
                                <span class="text-3xl">🇪🇬</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ t('contactEgypt') }}</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">{{ t('contactCairo') }}</p>
                                <p class="text-gray-600 text-sm">456 Innovation District</p>
                                <p class="text-gray-600 text-sm">New Cairo, Cairo 11835, Egypt</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="text-gray-500 text-xs">egypt@itab.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Saudi Arabia Branch -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <div class="mr-4">
                                <span class="text-3xl">🇸🇦</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ t('contactSaudi') }}</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">{{ t('contactRiyadh') }}</p>
                                <p class="text-gray-600 text-sm">789 Business Center</p>
                                <p class="text-gray-600 text-sm">King Fahd Road, Riyadh 11564, Saudi Arabia</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="text-gray-500 text-xs">saudi@itab.com</p>
                            </div>
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
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'
import {
    Mail,
    Phone,
    MapPin,
    Clock,
    Linkedin,
    Github
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

</script>
