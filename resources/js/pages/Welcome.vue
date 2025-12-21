<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
// import ChatBot from '@/components/ChatBot.vue' // Temporarily hidden

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

// ChatBot is automatically registered in Vue 3 Composition API
import {
    Smartphone,
    Globe,
    Zap,
    MessageCircle,
    Award,
    Users,
    Clock,
    Shield,
    CheckCircle,
    Search,
    FileText,
    Code,
    Rocket,
    ShoppingCart,
    Truck,
    Heart,
    CreditCard,
    GraduationCap,
    Building,
    UtensilsCrossed,
    Quote,
    Star,
    FileLock,
    Lock,
    FileCheck,
    BadgeCheck,
    Sparkles,
    ArrowRight,
    Monitor,
    MessageSquare,
    TrendingUp,
    Package,
    Target,
    Wrench,
    Headphones
} from 'lucide-vue-next'

// Animation state
const floatingIcons = [
    { icon: Sparkles, color: 'from-yellow-400 to-orange-500', delay: 0 },
    { icon: Zap, color: 'from-blue-400 to-cyan-500', delay: 0.5 },
    { icon: Shield, color: 'from-purple-400 to-pink-500', delay: 1 },
]

// Services data
const services = [
    {
        icon: Smartphone,
        title: 'برمجة تطبيقات الهاتف',
        description: 'تطبيقات iOS و Android احترافية بأحدث التقنيات',
    },
    {
        icon: Monitor,
        title: 'برمجة المواقع',
        description: 'مواقع ويب سريعة وعصرية بتصميم متجاوب',
    },
    {
        icon: MessageSquare,
        title: 'شات بوت',
        description: 'حلول ذكية للتواصل الآلي مع عملائك',
    },
    {
        icon: TrendingUp,
        title: 'التسويق الرقمي',
        description: 'استراتيجيات تسويقية فعالة لنمو أعمالك',
    },
]

// Ready Projects data
const readyProjects = [
    {
        title: 'متجر إلكتروني متكامل',
        description: 'نظام متجر إلكتروني بلوحة تحكم ونظام دفع',
        price: '5,000',
        image: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
        features: ['لوحة تحكم', 'نظام دفع', 'إدارة المنتجات', 'تطبيق موبايل'],
    },
    {
        title: 'نظام حجز مواعيد',
        description: 'تطبيق حجز مواعيد للعيادات والصالونات',
        price: '3,500',
        image: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&q=80',
        features: ['تقويم مواعيد', 'إشعارات تلقائية', 'إدارة العملاء', 'تقارير'],
    },
    {
        title: 'منصة تعليمية',
        description: 'نظام LMS لإدارة الدورات والطلاب',
        price: '7,000',
        image: 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&q=80',
        features: ['إدارة الدورات', 'اختبارات', 'شهادات', 'بث مباشر'],
    },
]

// Goals data
const goals = [
    {
        icon: Users,
        number: '500+',
        label: 'عميل راضٍ',
    },
    {
        icon: Sparkles,
        number: '1000+',
        label: 'مشروع منجز',
    },
    {
        icon: TrendingUp,
        number: '98%',
        label: 'نسبة النجاح',
    },
    {
        icon: Target,
        number: '24/7',
        label: 'دعم فني',
    },
]

// About Us Features data
const aboutFeatures = [
    {
        icon: Code,
        title: 'تصميم عصري',
        description: 'واجهات مستخدم جذابة وعصرية',
    },
    {
        icon: Shield,
        title: 'حماية من الاختراق',
        description: 'أمان عالي المستوى لحماية بياناتك',
    },
    {
        icon: CheckCircle,
        title: 'ميزات متكاملة',
        description: 'حلول شاملة لجميع احتياجاتك',
    },
    {
        icon: Wrench,
        title: 'صيانة للثغرات مجانًا',
        description: 'دعم فني ومتابعة مستمرة',
    },
    {
        icon: Code,
        title: 'إنشاء لوحة تحكم لك',
        description: 'إدارة كاملة لموقعك أو تطبيقك',
    },
    {
        icon: Clock,
        title: '24/7 دعم',
        description: 'فريق دعم متاح على مدار الساعة',
    },
]

interface CompanyLogo {
    id: number;
    logo_url: string;
    original_name: string | null;
}

interface Props {
    companyLogos?: CompanyLogo[];
}

const props = defineProps<Props>();

// Partners data - use company logos from database if available, otherwise use empty array
const partners = computed(() => {
    if (props.companyLogos && props.companyLogos.length > 0) {
        return props.companyLogos.map(logo => ({
            name: logo.original_name || 'Partner',
            logo: logo.logo_url,
            website: '#'
        }));
    }
    return [];
});
</script>

<template>
    <Head title="iTab - Leading Software Development Company" />

    <!-- Navigation Bar -->
    <NavBar textColor="white" />

    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section id="hero" class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-950 via-blue-900 to-purple-900 overflow-hidden pt-20">
            <!-- Animated Background -->
            <div class="absolute inset-0">
                <!-- Grid Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" :style="{
                        backgroundImage: `
                            linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px)
                        `,
                        backgroundSize: '60px 60px'
                    }"></div>
                </div>

                <!-- Gradient Orbs -->
                <div class="absolute top-20 -left-20 w-96 h-96 rounded-full bg-blue-500/30 blur-3xl animate-orb-1"></div>
                <div class="absolute top-40 -right-20 w-96 h-96 rounded-full bg-purple-500/30 blur-3xl animate-orb-2"></div>
                <div class="absolute bottom-20 left-1/2 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl animate-orb-3"></div>
            </div>

            <div class="container mx-auto px-4 py-20 relative z-10">
                <div class="max-w-5xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Left Content -->
                        <div class="text-white text-center lg:text-right">
                            <div class="animate-fade-in-up">
                                <!-- Badge -->
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6 hover:scale-105 transition-transform cursor-pointer">
                                    <Sparkles class="w-4 h-4 text-yellow-400" />
                                    <span class="text-sm">الحل الأمثل لمشروعك الرقمي</span>
                                </div>

                                <h1 class="mb-6 text-4xl md:text-5xl lg:text-6xl leading-tight">
                                    <span class="block mb-2">تحويل الأفكار</span>
                                    <span class="block bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                        إلى التميز الرقمي
                                    </span>
                                </h1>
                            </div>

                            <p class="mb-10 max-w-2xl mx-auto lg:mx-0 opacity-90 text-lg animate-fade-in-up-delay-1">
                                نصمم ونطور حلول ويب وموبايل مبتكرة تمكن الشركات من النمو والتفاعل والريادة من خلال التكنولوجيا.
                            </p>

                            <div class="flex gap-4 justify-center lg:justify-start flex-wrap animate-fade-in-up-delay-2">
                                <Button size="lg" class="bg-white text-blue-950 hover:bg-gray-100 shadow-2xl group">
                                    ابدأ مشروعك الآن
                                    <ArrowRight class="mr-2 h-5 w-5 group-hover:translate-x-1 transition-transform" />
                                </Button>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-6 mt-12 pt-12 border-t border-white/20 animate-fade-in-up-delay-3">
                                <div 
                                    v-for="stat in [
                                        { number: '500+', label: 'عميل' },
                                        { number: '1000+', label: 'مشروع' },
                                        { number: '98%', label: 'رضا العملاء' },
                                    ]"
                                    :key="stat.label"
                                    class="text-center hover:scale-110 transition-transform cursor-pointer"
                                >
                                    <div class="text-3xl font-bold mb-1">{{ stat.number }}</div>
                                    <div class="text-sm opacity-70">{{ stat.label }}</div>
                                </div>
                        </div>
                    </div>

                        <!-- Right - 3D Card Animation -->
                        <div class="relative hidden lg:block animate-scale-in">
                            <!-- Main Card -->
                            <div class="relative">
                                <div class="relative w-full h-96 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl rounded-3xl border border-white/20 shadow-2xl p-8 overflow-hidden animate-card-float">
                                    <!-- Floating Icons Inside Card -->
                                    <div
                                        v-for="(item, index) in floatingIcons"
                                        :key="index"
                                        :class="`absolute w-16 h-16 rounded-2xl bg-gradient-to-br ${item.color} flex items-center justify-center shadow-lg`"
                                        :style="{
                                            left: `${20 + index * 25}%`,
                                            top: `${20 + index * 20}%`,
                                            animation: `float-icon ${8 + index}s ease-in-out infinite`,
                                            animationDelay: `${item.delay}s`
                                        }"
                                    >
                                        <component :is="item.icon" class="w-8 h-8 text-white" />
                                    </div>

                                    <!-- Code Lines Animation -->
                                    <div class="space-y-3 mt-20">
                                        <div 
                                            v-for="(width, index) in [60, 80, 70, 90, 65]"
                                            :key="index"
                                            class="h-3 bg-gradient-to-r from-blue-400/30 to-purple-400/30 rounded-full code-line"
                                            :style="{
                                                '--target-width': `${width}%`,
                                                '--delay': `${0.5 + index * 0.1}s`,
                                                '--pulse-delay': `${2 + index * 0.1}s`
                                            }"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-scroll-indicator">
                <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center pt-2">
                    <div class="w-1.5 h-3 bg-white rounded-full animate-scroll-dot"></div>
                </div>
            </div>
        </section>

        <!-- Our Services -->
        <section id="services" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">خدماتنا</h2>
                    <p class="opacity-70 text-lg md:text-xl">
                        كل ذلك في مكان واحد<br />
                        مدعوم بالتكنولوجيا
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        v-for="(service, index) in services"
                        :key="service.title"
                        class="service-card"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <Card class="p-6 h-full hover:shadow-lg transition-shadow duration-300 border-2 hover:border-blue-500">
                            <div class="w-14 h-14 rounded-lg flex items-center justify-center mb-4" style="background-color: #4b3da6;">
                                <component :is="service.icon" class="w-7 h-7 text-white" />
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ service.title }}</h3>
                            <p class="opacity-70 text-gray-600">{{ service.description }}</p>
                        </Card>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ready Projects -->
        <section id="projects" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">المشاريع الجاهزة</h2>
                    <p class="opacity-70 max-w-2xl mx-auto text-lg md:text-xl">
                        حلول جاهزة وقابلة للتخصيص بأسعار تنافسية
                    </p>
                    </div>
                    
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div
                        v-for="(project, index) in readyProjects"
                        :key="project.title"
                        class="project-card"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <Card class="p-0 h-full flex flex-col hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                            <!-- Project Image -->
                            <div class="w-full h-48 overflow-hidden bg-gray-200">
                                <img
                                    :src="project.image"
                                    :alt="project.title"
                                    class="w-full h-full object-cover"
                                    @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                                />
                    </div>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ project.title }}</h3>
                                <p class="opacity-70 text-gray-600 mb-4">{{ project.description }}</p>
                            
                            <div class="mb-4">
                                <div class="flex items-baseline gap-1 mb-2">
                                    <span class="text-3xl font-bold text-blue-600">{{ project.price }}</span>
                                    <span class="opacity-70">ريال</span>
                </div>
                </div>

                            <ul class="space-y-2 mb-6 flex-grow">
                                <li 
                                    v-for="feature in project.features"
                                    :key="feature"
                                    class="flex items-center gap-2"
                                >
                                    <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                    </div>
                                    <span class="opacity-70 text-gray-600">{{ feature }}</span>
                                </li>
                            </ul>

                                <Button class="w-full text-white mt-auto" style="background-color: #4b3da6;" onmouseover="this.style.backgroundColor='#3d2d85'" onmouseout="this.style.backgroundColor='#4b3da6'">
                                    اطلب الآن
                                    <ArrowRight class="mr-2 h-4 w-4" />
                                </Button>
                    </div>
                        </Card>
                    </div>
                </div>
            </div>
        </section>

        <!-- App Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="app-section-left animate-slide-in-left">
                        <div class="flex items-center gap-2 mb-4">
                            <Sparkles class="w-6 h-6 text-blue-600" />
                            <span class="text-blue-600 font-medium">تطبيقات احترافية</span>
                </div>

                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            احصل على تطبيقك<br />
                            بتصميم عصري
                        </h2>
                        
                        <p class="mb-6 opacity-70 text-lg text-gray-600">
                            نقوم بتطوير تطبيقات الهاتف والويب باستخدام أحدث التقنيات والأدوات، مع التركيز على تجربة المستخدم والأداء العالي.
                        </p>

                        <ul class="space-y-3 mb-8">
                            <li 
                                v-for="item in [
                                    'تصميم واجهات مستخدم جذابة',
                                    'أداء سريع وموثوق',
                                    'متوافق مع جميع الأجهزة',
                                    'دعم فني متواصل'
                                ]"
                                :key="item"
                                class="flex items-center gap-3"
                            >
                                <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                                    <div class="w-2 h-2 rounded-full bg-white"></div>
                        </div>
                                <span class="text-gray-700">{{ item }}</span>
                            </li>
                        </ul>

                        <Button size="lg" class="text-white hover:opacity-90 transition-opacity" style="background-color: #4b3da6;">
                            <Smartphone class="ml-2 h-5 w-5" />
                            ابدأ تطبيقك الآن
                        </Button>
                    </div>
                    
                    <div class="relative app-section-right animate-slide-in-right">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img
                                src="/asset/mob.png"
                                alt="Mobile App Development"
                                class="w-full h-auto"
                                @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                            />
                    </div>
                    
                        <!-- Decorative Elements -->
                        <div class="absolute -z-10 -top-6 -right-6 w-40 h-40 rounded-full bg-gradient-to-br from-blue-400 to-purple-400 opacity-20 blur-3xl"></div>
                        <div class="absolute -z-10 -bottom-6 -left-6 w-40 h-40 rounded-full bg-gradient-to-br from-purple-400 to-blue-400 opacity-20 blur-3xl"></div>
                        </div>
                    </div>
            </div>
        </section>

        <!-- Website Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="relative order-2 lg:order-1 website-section-left animate-slide-in-left">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img
                                src="/asset/website.png"
                                alt="Web Design"
                                class="w-full h-auto"
                                @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                            />
                        </div>

                        <!-- Decorative Elements -->
                        <div class="absolute -z-10 -top-6 -left-6 w-40 h-40 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 opacity-20 blur-3xl"></div>
                    </div>
                    
                    <div class="order-1 lg:order-2 website-section-right animate-slide-in-right">
                        <div class="flex items-center gap-2 mb-4">
                            <Globe class="w-6 h-6 text-gray-900" />
                            <span class="text-gray-900 font-medium">مواقع احترافية</span>
                        </div>

                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            فرصتك للحصول<br />
                            على موقع متكامل
                        </h2>
                        
                        <p class="mb-6 opacity-70 text-lg text-gray-600">
                            نبني مواقع ويب عصرية ومتجاوبة مع جميع الأجهزة، مع التركيز على السرعة والأمان وتجربة المستخدم المتميزة.
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div 
                                v-for="item in [
                                    { label: 'تصميم متجاوب', value: '100%' },
                                    { label: 'أداء عالي', value: 'A+' },
                                    { label: 'أمان قوي', value: 'SSL' },
                                    { label: 'SEO محسن', value: '⭐' },
                                ]"
                                :key="item.label"
                                class="p-4 bg-gray-50 rounded-lg"
                            >
                                <div class="text-2xl font-bold text-gray-900 mb-1">{{ item.value }}</div>
                                <div class="opacity-70 text-gray-600">{{ item.label }}</div>
                            </div>
                            </div>

                        <Button size="lg" class="text-white hover:opacity-90 transition-opacity" style="background-color: #4b3da6;">
                            اطلب موقعك الآن
                            <ArrowRight class="mr-2 h-5 w-5" />
                        </Button>
                </div>
                </div>
            </div>
        </section>

        <!-- Goals Section -->
        <section class="py-20 bg-gradient-to-br from-blue-950 via-blue-900 to-purple-900 text-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" :style="{
                    backgroundImage: 'radial-gradient(circle at 1px 1px, white 1px, transparent 0)',
                    backgroundSize: '40px 40px'
                }"></div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16 animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">هدفنا لعام 2026</h2>
                    <p class="opacity-90 max-w-2xl mx-auto text-lg">
                        نسعى لتحقيق التميز والريادة في مجال التكنولوجيا وتقديم أفضل الحلول البرمجية لعملائنا
                    </p>
                            </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
                    <div
                        v-for="(goal, index) in goals"
                        :key="goal.label"
                        class="text-center goal-item"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div class="w-20 h-20 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center mx-auto mb-4 border border-white/20">
                            <component :is="goal.icon" class="w-10 h-10 text-white" />
                        </div>
                        <div class="text-4xl font-bold mb-2">{{ goal.number }}</div>
                        <div class="opacity-80">{{ goal.label }}</div>
                </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        فرصتك لنقل فكرتك إلى الإنترنت وتطويرها
                    </h2>
                    <p class="opacity-70 text-lg">
                        مجموعة شباب ذوي خبرات في أهم المجالات التقنية، عملنا على مئات المشاريع التقنية، منصة إكتمل هي المكان الصحيح لنقل فكرتك إلى الإنترنت وإدارتها وإيصالها إلى أكبر عدد من الناس بأحدث الوسائل.
                    </p>
                        </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    <div
                        v-for="(feature, index) in aboutFeatures"
                        :key="feature.title"
                        class="about-feature-card"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <Card class="p-6 h-full hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #4b3da6;">
                                <component :is="feature.icon" class="w-6 h-6 text-white" />
                    </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ feature.title }}</h3>
                            <p class="opacity-70 text-gray-600">{{ feature.description }}</p>
                        </Card>
                </div>
                </div>
            </div>
        </section>

                <!-- Legacy Services Grid (Hidden) -->
        <section class="py-20 px-4 bg-white hidden">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link href="/services/mobile-development" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Smartphone class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceMobile') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceMobileDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-600">iOS & Android Development</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span class="text-gray-600">Cross-platform Solutions</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span class="text-gray-600">App Store Optimization</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/web-development" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Globe class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceWeb') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceWebDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Progressive Web Apps</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Enterprise Solutions</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Cloud Integration</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/chatbot-automation" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Zap class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceAI') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceAIDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Machine Learning Models</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Process Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Data Analytics</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/cloud-devops" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceCloud') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceCloudDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>AWS & Azure Deployment</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Docker & Kubernetes</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>CI/CD Pipelines</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/consulting" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceConsulting') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceConsultingDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Technology Strategy</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Digital Transformation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Performance Optimization</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/chatbot-automation" class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <MessageCircle class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceChatbot') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceChatbotDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Customer Support Bots</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Sales Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Multi-language Support</span>
                            </li>
                        </ul>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('whyChooseUsTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('whyChooseUsSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Award class="w-8 h-8 text-gray-700" />
                                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsExpert') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsExpertDesc') }}
                        </p>
                                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Clock class="w-8 h-8 text-gray-700" />
                                    </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsDelivery') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsDeliveryDesc') }}
                        </p>
                                </div>

                    <!-- Feature 3 -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Shield class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsSecure') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsSecureDesc') }}
                        </p>
                                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Users class="w-8 h-8 text-gray-700" />
                                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsClient') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsClientDesc') }}
                        </p>
                                        </div>
                                    </div>

                <!-- Additional Features Grid -->
                <div class="grid md:grid-cols-3 gap-6 mt-12">
                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                        </div>
                                    <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsQA') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsQADesc') }}</p>
                                            </div>
                                    </div>

                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsSupport') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsSupportDesc') }}</p>
                                        </div>
                                    </div>

                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                                            </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsScalable') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsScalableDesc') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </section>

        <!-- How We Work (Process) -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('howWeWorkTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('howWeWorkSubtitle') }}
                    </p>
                        </div>

                <!-- Process Steps -->
                <div class="relative">
                    <!-- Connection Line (Desktop) -->
                    <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 bg-gray-300 transform -translate-y-1/2" style="top: 50%;"></div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                        <!-- Step 1 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Search class="w-8 h-8 text-gray-700" />
                    </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                1
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkDiscovery') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkDiscoveryDesc') }}
                            </p>
                </div>

                        <!-- Step 2 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <FileText class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                2
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkPlanning') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkPlanningDesc') }}
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Code class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                3
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkDevelopment') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkDevelopmentDesc') }}
                            </p>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Rocket class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                4
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkLaunch') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkLaunchDesc') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Process Benefits -->
                <div class="mt-16 grid md:grid-cols-3 gap-6">
                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-blue-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkTransparent') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkTransparentDesc') }}</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-purple-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkAgile') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkAgileDesc') }}</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-green-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkQuality') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkQualityDesc') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Industries We Serve -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('industriesTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('industriesSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- E-commerce -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <ShoppingCart class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryEcommerce') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryEcommerceDesc') }}
                        </p>
                    </div>

                    <!-- Logistics -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Truck class="w-8 h-8 text-gray-700" />
                    </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryLogistics') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryLogisticsDesc') }}
                        </p>
                        </div>

                    <!-- Healthcare -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Heart class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryHealthcare') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryHealthcareDesc') }}
                        </p>
                    </div>

                    <!-- Fintech -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <CreditCard class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryFintech') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryFintechDesc') }}
                        </p>
                    </div>

                    <!-- Education -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <GraduationCap class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryEducation') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryEducationDesc') }}
                        </p>
                    </div>

                    <!-- Real Estate -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Building class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryRealEstate') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryRealEstateDesc') }}
                        </p>
                    </div>

                    <!-- Cloud Kitchen -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group md:col-span-2 lg:col-span-1">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <UtensilsCrossed class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryCloudKitchen') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryCloudKitchenDesc') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('testimonialsTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('testimonialsSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "iTab delivered an exceptional e-commerce platform that exceeded our expectations. Their team's expertise and attention to detail made all the difference."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                    <div>
                                <h4 class="font-semibold text-gray-900">John Doe</h4>
                                <p class="text-sm text-gray-500">CEO, TechStore</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "The healthcare management system they built for us has transformed our operations. Professional, reliable, and always responsive to our needs."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                SM
                            </div>
                    <div>
                                <h4 class="font-semibold text-gray-900">Sarah Miller</h4>
                                <p class="text-sm text-gray-500">Director, HealthCare Plus</p>
                            </div>
                    </div>
                </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Outstanding work on our logistics platform. The team understood our complex requirements and delivered a solution that streamlined our entire supply chain."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                MA
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Michael Anderson</h4>
                                <p class="text-sm text-gray-500">CTO, FastLogistics</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Their fintech solution helped us launch our digital wallet in record time. The security measures and user experience are top-notch."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                EW
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Emily Wilson</h4>
                                <p class="text-sm text-gray-500">Founder, PayTech</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "The educational platform they developed has revolutionized how we deliver courses. Our students love the intuitive interface and seamless experience."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                RT
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Robert Taylor</h4>
                                <p class="text-sm text-gray-500">Principal, EduTech Academy</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Working with iTab was a game-changer. Their cloud kitchen management system increased our order efficiency by 40%. Highly recommended!"
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                LJ
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Lisa Johnson</h4>
                                <p class="text-sm text-gray-500">Owner, CloudKitchen Pro</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Partners Section -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('partnersTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('partnersSubtitle') }}
                    </p>
                        </div>

                <!-- Partners Grid -->
                <div v-if="partners.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-8 md:gap-12">
                    <div 
                        v-for="partner in partners" 
                        :key="partner.logo"
                        class="group flex items-center justify-center p-6 transition-all duration-300 hover:scale-110"
                    >
                        <img 
                            :src="partner.logo"
                            :alt="`${partner.name} logo`"
                            class="max-h-32 max-w-full object-contain opacity-80 group-hover:opacity-100 transition-all duration-300"
                            loading="lazy"
                        >
                        </div>
                    </div>
                <!-- Empty State -->
                <div v-else class="text-center py-12 text-gray-500">
                    <p>No company logos available yet.</p>
                </div>
                            
                <!-- Trust Badge -->
                <div class="text-center mt-12">
                    <div class="inline-flex items-center gap-2 bg-gray-100 backdrop-blur-sm rounded-full px-6 py-3 border border-gray-200">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-700 text-xs font-medium">{{ t('partnersTrusted') }}</span>
            </div>
                    </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="flex flex-col items-center justify-center space-y-6">
                    <!-- Company Logo -->
                    <div class="text-center">
                        <Link href="/" class="flex items-center justify-center">
                            <img src="/asset/logo-new-white.png"
                                 alt="iTab Logo"
                                 class="h-16 w-auto">
                        </Link>
                    </div>

                    <!-- Social Media Links -->
                    <div class="flex items-center gap-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/profile.php?id=61585174361896" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-blue-500 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/itap_solution/" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-pink-500 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>

                        <!-- TikTok -->
                        <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-black transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/company/itap-solution" target="_blank" rel="noopener noreferrer"
                           class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
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

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

/* Hero Animations */
@keyframes orb-1 {
    0%, 100% { 
        transform: scale(1) translate(0, 0); 
    }
    50% { 
        transform: scale(1.2) translate(50px, 30px); 
    }
}

@keyframes orb-2 {
    0%, 100% { 
        transform: scale(1) translate(0, 0); 
    }
    50% { 
        transform: scale(1.3) translate(-50px, -30px); 
    }
}

@keyframes orb-3 {
    0%, 100% { 
        transform: scale(1) rotate(0deg); 
    }
    50% { 
        transform: scale(1.4) rotate(180deg); 
    }
    100% {
        transform: scale(1) rotate(360deg);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes card-float {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(-20px); 
    }
}

@keyframes float-icon {
    0%, 100% { 
        transform: translate(0, 0) rotate(0deg);
        opacity: 1;
    }
    33% { 
        transform: translate(20px, -20px) rotate(120deg);
        opacity: 0.9;
    }
    66% { 
        transform: translate(-20px, 20px) rotate(240deg);
        opacity: 0.9;
    }
}

.code-line {
    width: 0%;
    animation: code-line-expand 1.5s ease-out forwards, code-line-pulse 3s ease-in-out infinite;
    animation-delay: var(--delay, 0.5s), var(--pulse-delay, 2s);
}

@keyframes code-line-expand {
    from {
        width: 0%;
    }
    to {
        width: var(--target-width, 60%);
    }
}

@keyframes code-line-pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.6;
    }
}

@keyframes badge-float-1 {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(-10px); 
    }
}

@keyframes badge-float-2 {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(10px); 
    }
}

@keyframes scroll-indicator {
    0%, 100% { 
        transform: translate(-50%, 0); 
    }
    50% { 
        transform: translate(-50%, 10px); 
    }
}

@keyframes scroll-dot {
    0%, 100% { 
        transform: translateY(0);
        opacity: 1;
    }
    50% { 
        transform: translateY(12px);
        opacity: 0.3;
    }
}

.animate-orb-1 {
    animation: orb-1 8s ease-in-out infinite;
}

.animate-orb-2 {
    animation: orb-2 10s ease-in-out infinite;
}

.animate-orb-3 {
    animation: orb-3 12s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.animate-fade-in-up-delay-1 {
    animation: fade-in-up 0.8s ease-out 0.2s forwards;
    opacity: 0;
}

.animate-fade-in-up-delay-2 {
    animation: fade-in-up 0.8s ease-out 0.4s forwards;
    opacity: 0;
}

.animate-fade-in-up-delay-3 {
    animation: fade-in-up 0.8s ease-out 0.6s forwards;
    opacity: 0;
}

.animate-scale-in {
    animation: scale-in 1s ease-out 0.3s forwards;
    opacity: 0;
}

.animate-card-float {
    animation: card-float 4s ease-in-out infinite;
}

.animate-badge-float-1 {
    animation: badge-float-1 3s ease-in-out infinite;
}

.animate-badge-float-2 {
    animation: badge-float-2 3s ease-in-out 1.5s infinite;
}

.animate-scroll-indicator {
    animation: scroll-indicator 2s ease-in-out infinite;
}

.animate-scroll-dot {
    animation: scroll-dot 2s ease-in-out infinite;
}

/* Services Animations */
.service-card {
    opacity: 0;
    transform: translateY(30px);
    animation: service-fade-in-up 0.6s ease-out forwards;
}

@keyframes service-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Projects Animations */
.project-card {
    opacity: 0;
    transform: translateY(30px);
    animation: project-fade-in-up 0.6s ease-out forwards;
}

@keyframes project-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* App Section Animations */
.app-section-left {
    opacity: 0;
    transform: translateX(-30px);
    animation: slide-in-left 0.8s ease-out forwards;
}

.app-section-right {
    opacity: 0;
    transform: translateX(30px);
    animation: slide-in-right 0.8s ease-out forwards;
}

@keyframes slide-in-left {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-in-right {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in-left {
    opacity: 0;
    transform: translateX(-30px);
    animation: slide-in-left 0.8s ease-out forwards;
}

.animate-slide-in-right {
    opacity: 0;
    transform: translateX(30px);
    animation: slide-in-right 0.8s ease-out forwards;
}

.website-section-left,
.website-section-right {
    animation-delay: 0.2s;
}

/* Goals Animations */
.goal-item {
    opacity: 0;
    transform: scale(0.8);
    animation: goal-scale-in 0.6s ease-out forwards;
}

@keyframes goal-scale-in {
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* About Features Animations */
.about-feature-card {
    opacity: 0;
    transform: translateY(30px);
    animation: feature-fade-in-up 0.6s ease-out forwards;
}

@keyframes feature-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar for the modal */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

</style>
