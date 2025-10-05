<template>
    <Head title="Contact Us - iTab" />

    <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <!-- Hero Section -->
        <section class="py-20 px-4 bg-black">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-6">
                    Get In Touch
                </h1>
                <p class="text-xl text-white max-w-3xl mx-auto mb-12">
                    Ready to transform your business with cutting-edge technology?
                    Let's discuss your project and bring your vision to life.
                </p>
            </div>
        </section>

        <!-- Contact Form & Info -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 border border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a Message</h2>
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <Label for="firstName" class="text-gray-700">First Name</Label>
                                    <Input v-model="form.firstName" id="firstName" required
                                           class="mt-2 bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500"
                                           placeholder="John" />
                                </div>
                                <div>
                                    <Label for="lastName" class="text-gray-700">Last Name</Label>
                                    <Input v-model="form.lastName" id="lastName" required
                                           class="mt-2 bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500"
                                           placeholder="Doe" />
                                </div>
                            </div>

                            <div>
                                <Label for="email" class="text-gray-700">Email Address</Label>
                                <Input v-model="form.email" id="email" type="email" required
                                       class="mt-2 bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500"
                                       placeholder="john@example.com" />
                            </div>

                            <div>
                                <Label for="phone" class="text-gray-700">Phone Number</Label>
                                <Input v-model="form.phone" id="phone"
                                       class="mt-2 bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500"
                                       placeholder="+1 (555) 123-4567" />
                            </div>

                            <div>
                                <Label for="company" class="text-gray-700">Company</Label>
                                <Input v-model="form.company" id="company"
                                       class="mt-2 bg-white border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500"
                                       placeholder="Your Company" />
                            </div>

                            <div>
                                <Label for="projectType" class="text-gray-700">Project Type</Label>
                                <select v-model="form.projectType" id="projectType" required
                                        class="mt-2 w-full px-3 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:border-blue-500 focus:outline-none">
                                    <option value="" class="bg-white text-gray-500">Select a project type</option>
                                    <option value="web-development" class="bg-white text-gray-900">Web Development</option>
                                    <option value="mobile-app" class="bg-white text-gray-900">Mobile App</option>
                                    <option value="system-purchase" class="bg-white text-gray-900">System Purchase</option>
                                    <option value="consultation" class="bg-white text-gray-900">Consultation</option>
                                    <option value="other" class="bg-white text-gray-900">Other</option>
                                </select>
                            </div>

                            <div>
                                <Label for="budget" class="text-gray-700">Budget Range</Label>
                                <select v-model="form.budget" id="budget"
                                        class="mt-2 w-full px-3 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:border-blue-500 focus:outline-none">
                                    <option value="" class="bg-white text-gray-500">Select budget range</option>
                                    <option value="under-5k" class="bg-white text-gray-900">Under $5,000</option>
                                    <option value="5k-15k" class="bg-white text-gray-900">$5,000 - $15,000</option>
                                    <option value="15k-50k" class="bg-white text-gray-900">$15,000 - $50,000</option>
                                    <option value="50k-plus" class="bg-white text-gray-900">$50,000+</option>
                                    <option value="discuss" class="bg-white text-gray-900">Let's Discuss</option>
                                </select>
                            </div>

                            <div>
                                <Label for="message" class="text-gray-700">Message</Label>
                                <Textarea v-model="form.message" id="message" rows="5" required
                                          class="mt-2 bg-white border border-gray-300 text-gray-900 placeholder-gray-500 focus:border-blue-500 resize-none"
                                          placeholder="Tell us about your project requirements..." />
                            </div>

                            <Button type="submit" :disabled="isSubmitting"
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 text-lg">
                                <Send class="w-5 h-5 mr-2" />
                                {{ isSubmitting ? 'Sending...' : 'Send Message' }}
                            </Button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl p-8 border border-gray-200">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <Mail class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                        <p class="text-gray-600">contact@itab.com</p>
                                        <p class="text-gray-600">sales@itab.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <Phone class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                                        <p class="text-gray-600">+1 (555) 123-4567</p>
                                        <p class="text-gray-600">+1 (555) 987-6543</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <MapPin class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Address</h4>
                                        <p class="text-gray-600">123 Tech Street</p>
                                        <p class="text-gray-600">Innovation District</p>
                                        <p class="text-gray-600">San Francisco, CA 94105</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <Clock class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Business Hours</h4>
                                        <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM PST</p>
                                        <p class="text-gray-600">Saturday: 10:00 AM - 4:00 PM PST</p>
                                        <p class="text-gray-600">Sunday: Closed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-gradient-to-br from-gray-50 to-purple-50 rounded-3xl p-8 border border-gray-200">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Follow Us</h3>
                            <div class="flex gap-4">
                                <a href="https://linkedin.com/company/itab" target="_blank"
                                   class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <Linkedin class="w-6 h-6 text-blue-600 hover:text-white" />
                                </a>
                                <a href="https://github.com/itab" target="_blank"
                                   class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-gray-800 transition-colors">
                                    <Github class="w-6 h-6 text-gray-600 hover:text-white" />
                                </a>
                                <a href="https://twitter.com/itab" target="_blank"
                                   class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <Twitter class="w-6 h-6 text-blue-600 hover:text-white" />
                                </a>
                                <a href="https://instagram.com/itab" target="_blank"
                                   class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center hover:bg-pink-500 transition-colors">
                                    <Instagram class="w-6 h-6 text-pink-600 hover:text-white" />
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Branches Section -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Our Branches</h2>
                    <p class="text-xl text-gray-600">Visit us at any of our global locations</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- UK Branch -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <div class="mr-4">
                                <span class="text-3xl">🇬🇧</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">United Kingdom</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">London Office</p>
                                <p class="text-gray-600 text-sm">123 Tech Street, Canary Wharf</p>
                                <p class="text-gray-600 text-sm">London E14 5AB, UK</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="font-medium text-blue-600 text-sm">+44 20 7123 4567</p>
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
                            <h3 class="text-xl font-bold text-gray-900">Egypt</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Cairo Office</p>
                                <p class="text-gray-600 text-sm">456 Innovation District</p>
                                <p class="text-gray-600 text-sm">New Cairo, Cairo 11835, Egypt</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="font-medium text-blue-600 text-sm">+20 2 1234 5678</p>
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
                            <h3 class="text-xl font-bold text-gray-900">Saudi Arabia</h3>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Riyadh Office</p>
                                <p class="text-gray-600 text-sm">789 Business Center</p>
                                <p class="text-gray-600 text-sm">King Fahd Road, Riyadh 11564, Saudi Arabia</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <p class="font-medium text-blue-600 text-sm">+966 11 234 5678</p>
                                <p class="text-gray-500 text-xs">saudi@itab.com</p>
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

               <!-- Chat Bot -->
               <ChatBot />
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, reactive } from 'vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import NavBar from '@/components/NavBar.vue'
import ChatBot from '@/components/ChatBot.vue'
import {
    Mail,
    Phone,
    MapPin,
    Clock,
    Linkedin,
    Github,
    Twitter,
    Instagram,
    ShoppingCart,
    Eye,
    MessageCircle,
    Send
} from 'lucide-vue-next'


const form = reactive({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    company: '',
    projectType: '',
    budget: '',
    message: ''
})

const isSubmitting = ref(false)


const submitForm = async () => {
    isSubmitting.value = true

    // Simulate form submission
    setTimeout(() => {
        // Create mailto link with form data
        const subject = `New Contact Form Submission from ${form.firstName} ${form.lastName}`
        const body = `Name: ${form.firstName} ${form.lastName}
Email: ${form.email}
Phone: ${form.phone}
Company: ${form.company}
Project Type: ${form.projectType}
Budget: ${form.budget}

Message:
${form.message}`

        const mailtoLink = `mailto:contact@itab.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
        window.open(mailtoLink, '_self')

        isSubmitting.value = false

        // Reset form
        Object.keys(form).forEach(key => {
            form[key as keyof typeof form] = ''
        })

        alert('Thank you for your message! We will get back to you soon.')
    }, 1000)
}

</script>
