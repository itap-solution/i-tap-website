<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import NavBar from '@/components/NavBar.vue'
import {
    Code,
    Settings,
    Database,
    Zap,
    Shield,
    CheckCircle,
    ArrowRight,
    Star,
    Award,
    Clock,
    Server
} from 'lucide-vue-next'
</script>

<template>
    <Head title="Software Solutions - iTab" />
    <NavBar textColor="black" backgroundColor="white" />
    <div class="min-h-screen bg-white">
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
                            Custom Software Development
                        </div>
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Enterprise
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Software Solutions
                            </span>
                        </h1>
                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                            We build custom software solutions tailored to your business needs, from enterprise
                            applications to specialized tools that streamline operations.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <Link href="/contact-us" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                Get Started
                                <ArrowRight class="w-5 h-5" />
                            </Link>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl p-8 text-white">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Code class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Custom Development</h3>
                                        <p class="text-blue-100">Tailored to your needs</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Server class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Enterprise Solutions</h3>
                                        <p class="text-blue-100">Scalable & reliable</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Shield class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Secure & Compliant</h3>
                                        <p class="text-blue-100">Industry standards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Software Solutions</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Comprehensive software development services for businesses of all sizes
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Settings class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">ERP Systems</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Enterprise resource planning systems to manage your business operations efficiently
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Resource Management</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Financial Planning</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Supply Chain</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Database class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">CRM Solutions</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Customer relationship management systems to enhance customer engagement
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Lead Management</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Sales Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Analytics & Reports</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Code class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Custom Applications</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Bespoke software solutions designed specifically for your unique business requirements
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Tailored Solutions</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Integration Services</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Maintenance & Support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Build Your Software Solution?</h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Let's discuss your requirements and create a software solution that transforms your business.
                </p>
                <Link href="/contact-us" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center gap-2">
                    Get Free Consultation
                    <ArrowRight class="w-5 h-5" />
                </Link>
            </div>
        </section>
    </div>
</template>

