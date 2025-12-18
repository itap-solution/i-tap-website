<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import NavBar from '@/components/NavBar.vue'
import {
    Globe,
    Code,
    Smartphone,
    Server,
    Database,
    Zap,
    Shield,
    CheckCircle,
    ArrowRight,
    Star,
    Award,
    Clock
} from 'lucide-vue-next'
</script>

<template>
    <Head title="Web Development - iTab" />

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
                            Professional Web Development
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Build Powerful
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Web Applications
                            </span>
                        </h1>

                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                            We create modern, scalable, and high-performance web applications that drive business growth
                            and deliver exceptional user experiences.
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
                                <div class="text-3xl font-bold text-gray-900 mb-2">500+</div>
                                <div class="text-sm text-gray-600">Websites Built</div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <Star class="w-8 h-8 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-2">98%</div>
                                <div class="text-sm text-gray-600">Client Satisfaction</div>
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
                                        <Globe class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Responsive Design</h3>
                                        <p class="text-blue-100">Works on all devices</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Zap class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Fast Performance</h3>
                                        <p class="text-blue-100">Optimized for speed</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Shield class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Secure & Safe</h3>
                                        <p class="text-blue-100">Enterprise-grade security</p>
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
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Web Development Services</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        From simple websites to complex web applications, we build solutions that scale with your business
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Globe class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Custom Websites</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Beautiful, responsive websites tailored to your brand and business needs
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Responsive Design</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>SEO Optimized</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Fast Loading</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Code class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Web Applications</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Scalable web applications built with modern frameworks and best practices
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>React, Vue, Angular</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Laravel, Node.js</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>RESTful APIs</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Database class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">E-commerce Solutions</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Complete online stores with payment integration and inventory management
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Payment Gateways</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Inventory Management</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Order Tracking</span>
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
                    Ready to Build Your Web Solution?
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Let's discuss your project and create a web solution that drives your business forward.
                </p>
                <Link href="/contact-us" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center gap-2">
                    Get Free Consultation
                    <ArrowRight class="w-5 h-5" />
                </Link>
            </div>
        </section>
    </div>
</template>

