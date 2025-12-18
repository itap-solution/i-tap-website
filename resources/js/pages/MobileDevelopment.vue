<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import NavBar from '@/components/NavBar.vue'
import {
    Smartphone,
    Code,
    Zap,
    Shield,
    CheckCircle,
    ArrowRight,
    Star,
    Award,
    Clock,
    Globe
} from 'lucide-vue-next'
</script>

<template>
    <Head title="Mobile App Development - iTab" />

    <NavBar textColor="black" backgroundColor="white" />

    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute top-40 right-10 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                            <Zap class="w-4 h-4" />
                            Native & Cross-Platform Apps
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Build Powerful
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Mobile Applications
                            </span>
                        </h1>

                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                            We develop native iOS, Android, and cross-platform mobile apps that deliver exceptional
                            user experiences and drive business growth.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <Link href="/contact-us" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                Get Started
                                <ArrowRight class="w-5 h-5" />
                            </Link>
                        </div>

                        <div class="grid grid-cols-3 gap-8 pt-8">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <Award class="w-8 h-8 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-2">300+</div>
                                <div class="text-sm text-gray-600">Apps Developed</div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <Star class="w-8 h-8 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-2">4.8+</div>
                                <div class="text-sm text-gray-600">App Store Rating</div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <Clock class="w-8 h-8 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-2">24/7</div>
                                <div class="text-sm text-gray-600">Support</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl p-8 text-white">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Smartphone class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">iOS & Android</h3>
                                        <p class="text-blue-100">Native development</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Code class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Flutter & React Native</h3>
                                        <p class="text-blue-100">Cross-platform solutions</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Shield class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Secure & Scalable</h3>
                                        <p class="text-blue-100">Enterprise-grade apps</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Mobile Development Services</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        From concept to app store, we deliver mobile solutions that users love
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Smartphone class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Native Apps</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            High-performance native iOS and Android applications built with Swift, Kotlin, and Java
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>iOS (Swift/SwiftUI)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Android (Kotlin/Java)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>App Store Optimization</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Code class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Cross-Platform</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Build once, deploy everywhere with Flutter and React Native
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Flutter Development</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>React Native</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Single Codebase</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Globe class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Progressive Web Apps</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Web-based apps that work like native apps on mobile devices
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Offline Support</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Push Notifications</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>App-like Experience</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to Build Your Mobile App?
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Let's turn your app idea into reality with a mobile solution that users will love.
                </p>
                <Link href="/contact-us" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center gap-2">
                    Get Free Consultation
                    <ArrowRight class="w-5 h-5" />
                </Link>
            </div>
        </section>
    </div>
</template>

