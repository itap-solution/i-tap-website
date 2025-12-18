<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import NavBar from '@/components/NavBar.vue'
import {
    MessageCircle,
    Bot,
    Zap,
    Shield,
    CheckCircle,
    ArrowRight,
    Star,
    Award,
    Clock,
    Brain
} from 'lucide-vue-next'
</script>

<template>
    <Head title="Chatbot & Automation - iTab" />
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
                            AI-Powered Solutions
                        </div>
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Intelligent
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Chatbots & Automation
                            </span>
                        </h1>
                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                            Enhance customer engagement and automate business processes with AI-powered chatbots
                            and intelligent automation solutions.
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
                                        <Bot class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">AI Chatbots</h3>
                                        <p class="text-blue-100">24/7 customer support</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Brain class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Smart Automation</h3>
                                        <p class="text-blue-100">Process optimization</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Shield class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Secure & Reliable</h3>
                                        <p class="text-blue-100">Enterprise-grade</p>
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
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Chatbot & Automation Services</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Intelligent solutions to automate workflows and enhance customer experience
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <MessageCircle class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Customer Support Bots</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            AI-powered chatbots that provide instant, accurate responses to customer inquiries
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>24/7 Availability</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Multi-language Support</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Natural Language Processing</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Zap class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Business Automation</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Automate repetitive tasks and workflows to increase efficiency and reduce costs
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Workflow Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Data Processing</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Task Scheduling</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Brain class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">AI Integration</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Integrate advanced AI capabilities into your existing systems and processes
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Machine Learning</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Predictive Analytics</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <CheckCircle class="w-4 h-4 text-green-500" />
                                <span>Smart Recommendations</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Automate Your Business?</h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Let's discuss how chatbots and automation can transform your business operations.
                </p>
                <Link href="/contact-us" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center gap-2">
                    Get Free Consultation
                    <ArrowRight class="w-5 h-5" />
                </Link>
            </div>
        </section>
    </div>
</template>

