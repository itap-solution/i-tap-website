<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import NavBar from '@/components/NavBar.vue'
import {
    Globe,
    Smartphone,
    TrendingUp,
    Users,
    Target,
    BarChart3,
    Mail,
    Phone,
    ArrowRight,
    CheckCircle,
    Star,
    Award,
    Zap,
    Eye,
    MousePointer,
    Search,
    Share2,
    MessageSquare,
    Camera,
    Video,
    Palette,
    PenTool,
    Play,
    Rocket,
    Shield,
    Clock,
    DollarSign,
    Brain,
    Lightbulb,
    Layers,
    PieChart,
    Activity,
    Target as TargetIcon,
    Megaphone,
    MousePointer2,
    Monitor,
    Smartphone as PhoneIcon,
    Globe2,
    Database,
    Cloud,
    Server,
    Cpu,
    Wifi,
    Lock,
    Unlock,
    Key,
    Settings,
    Cog,
    Wrench,
    Hammer,
    Tool,
    Scissors,
    Paintbrush,
    Palette as PaletteIcon,
    Image,
    FileImage,
    FileText,
    File,
    Download,
    Upload,
    Send,
    MessageCircle,
    MessageSquare as MessageSquareIcon,
    Mail as MailIcon,
    Phone as PhoneIcon2,
    Calendar,
    Clock as ClockIcon,
    Timer,
    Stopwatch,
    Hourglass,
    Bell,
    BellRing,
    AlertCircle,
    AlertTriangle,
    Info,
    HelpCircle,
    QuestionMarkCircle,
    X,
    Plus,
    Minus,
    Divide,
    Equal,
    NotEqual,
    GreaterThan,
    LessThan,
    ChevronUp,
    ChevronDown,
    ChevronLeft,
    ChevronRight,
    ArrowUp,
    ArrowDown,
    ArrowLeft,
    ArrowRight as ArrowRightIcon,
    Move,
    RotateCcw,
    RotateCw,
    RefreshCw,
    RefreshCcw,
    Repeat,
    Shuffle,
    SkipBack,
    SkipForward,
    Play as PlayIcon,
    Pause,
    Square,
    Circle,
    Triangle,
    Hexagon,
    Pentagon,
    Octagon,
    Diamond,
    Heart,
    Smile,
    Frown,
    Meh,
    Laugh,
    Angry,
    Sad,
    Surprised,
    Wink,
    ThumbsUp,
    ThumbsDown,
    Hand,
    Fingerprint,
    User,
    UserCheck,
    UserPlus,
    UserMinus,
    UserX,
    Users as UsersIcon,
    UserCircle,
    UserSquare,
    Crown,
    Medal,
    Trophy,
    Gift,
    Package,
    Box,
    Archive,
    Folder,
    FolderOpen,
    FolderPlus,
    FolderMinus,
    File as FileIcon,
    FileText as FileTextIcon,
    FileImage as FileImageIcon,
    FileVideo,
    FileAudio,
    FilePdf,
    FileWord,
    FileExcel,
    FilePowerpoint,
    FileCode,
    FileJson,
    FileXml,
    FileCss,
    FileHtml,
    FileJs,
    FileTs,
    FileVue,
    FileReact,
    FileAngular,
    FileSvelte,
    FileSolid,
    FileLaravel,
    FilePhp,
    FilePython,
    FileJava,
    FileCsharp,
    FileCpp,
    FileC,
    FileGo,
    FileRust,
    FileSwift,
    FileKotlin,
    FileDart,
    FileFlutter,
    FileNode,
    FileNpm,
    FileYarn,
    FilePnpm,
    FileGit,
    FileGithub,
    FileGitlab,
    FileBitbucket,
    FileDocker,
    FileKubernetes,
    FileTerraform,
    FileAnsible,
    FileJenkins,
    FileTravis,
    FileCircleci,
    FileGitlabci,
    FileGithubActions,
    FileAzure,
    FileAws,
    FileGcp,
    FileDigitalocean,
    FileHeroku,
    FileVercel,
    FileNetlify,
    FileFirebase,
    FileSupabase,
    FilePlanetscale,
    FileMongodb,
    FilePostgresql,
    FileMysql,
    FileRedis,
    FileElasticsearch,
    FileSolr,
    FileNeo4j,
    FileArangodb,
    FileCouchdb,
    FileCassandra,
    FileDynamodb,
    FileScylladb,
    FileInfluxdb,
    FileTimescaledb,
    FileClickhouse,
    FileBigquery,
    FileSnowflake,
    FileRedshift,
    FileAthena,
    FileGlue,
    FileKinesis,
    FileS3,
    FileEfs,
    FileFsx,
    FileEbs,
    FileIops,
    FileThroughput,
    FileLatency,
    FileBandwidth,
    FileThroughput2,
    FileLatency2,
    FileBandwidth2,
    FileThroughput3,
    FileLatency3,
    FileBandwidth3,
    FileThroughput4,
    FileLatency4,
    FileBandwidth4,
    FileThroughput5,
    FileLatency5,
    FileBandwidth5,
    FileThroughput6,
    FileLatency6,
    FileBandwidth6,
    FileThroughput7,
    FileLatency7,
    FileBandwidth7,
    FileThroughput8,
    FileLatency8,
    FileBandwidth8,
    FileThroughput9,
    FileLatency9,
    FileBandwidth9,
    FileThroughput10,
    FileLatency10,
    FileBandwidth10
} from 'lucide-vue-next'

// Services data
const services = ref([
    {
        icon: Globe,
        title: 'Website Development',
        description: 'Professional websites that convert visitors into customers with modern design and optimal performance',
        features: ['Responsive Design', 'SEO Optimized', 'Fast Loading', 'Mobile Friendly', 'E-commerce Integration'],
        color: 'from-blue-500 to-cyan-500'
    },
    {
        icon: TrendingUp,
        title: 'SEO & Analytics',
        description: 'Boost your online visibility and track performance with advanced analytics and data-driven insights',
        features: ['Keyword Research', 'On-Page SEO', 'Off-Page SEO', 'Google Analytics', 'Performance Tracking'],
        color: 'from-green-500 to-emerald-500'
    },
    {
        icon: Share2,
        title: 'Social Media Marketing',
        description: 'Engage your audience and build brand loyalty across all social platforms with strategic content',
        features: ['Content Strategy', 'Community Management', 'Paid Advertising', 'Influencer Marketing', 'Social Analytics'],
        color: 'from-pink-500 to-rose-500'
    },
    {
        icon: Target,
        title: 'Paid Advertising (PPC)',
        description: 'Drive immediate traffic and conversions with targeted ad campaigns across multiple platforms',
        features: ['Google Ads', 'Facebook Ads', 'LinkedIn Ads', 'Ad Copywriting', 'Landing Page Optimization'],
        color: 'from-orange-500 to-red-500'
    },
    {
        icon: Mail,
        title: 'Email Marketing',
        description: 'Nurture leads and retain customers with effective email campaigns and automation',
        features: ['Audience Segmentation', 'Campaign Automation', 'Newsletter Design', 'A/B Testing', 'Email Analytics'],
        color: 'from-purple-500 to-violet-500'
    },
    {
        icon: BarChart3,
        title: 'Content Marketing',
        description: 'Create valuable content that attracts, engages, and converts your target audience',
        features: ['Blog Posts', 'Articles', 'Infographics', 'Video Content', 'Content Strategy'],
        color: 'from-indigo-500 to-blue-500'
    }
])

// Process steps
const processSteps = ref([
    {
        step: '01',
        title: 'Discovery & Strategy',
        description: 'We analyze your business, goals, and target audience to create a comprehensive digital marketing strategy',
        icon: Search,
        color: 'from-blue-500 to-cyan-500'
    },
    {
        step: '02',
        title: 'Research & Planning',
        description: 'In-depth market research, competitor analysis, and keyword research to build a robust marketing plan',
        icon: Target,
        color: 'from-green-500 to-emerald-500'
    },
    {
        step: '03',
        title: 'Content Creation',
        description: 'Developing compelling content, visuals, and campaigns that resonate with your target audience',
        icon: PenTool,
        color: 'from-purple-500 to-violet-500'
    },
    {
        step: '04',
        title: 'Campaign Launch',
        description: 'Executing campaigns across chosen channels and continuously monitoring performance metrics',
        icon: Rocket,
        color: 'from-orange-500 to-red-500'
    },
    {
        step: '05',
        title: 'Analysis & Reporting',
        description: 'Regular performance analysis, detailed reporting, and actionable insights to refine strategies',
        icon: BarChart3,
        color: 'from-pink-500 to-rose-500'
    },
    {
        step: '06',
        title: 'Optimization',
        description: 'Continuous improvement based on data to ensure sustained growth and maximum ROI',
        icon: TrendingUp,
        color: 'from-indigo-500 to-blue-500'
    }
])

// Testimonials
const testimonials = ref([
    {
        name: 'Sarah Johnson',
        company: 'TechStart Inc.',
        position: 'CEO',
        content: 'iTab transformed our digital presence completely. Our website traffic increased by 300% and our conversion rate improved by 150% in just 6 months!',
        rating: 5,
        image: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
        results: ['300% Traffic Increase', '150% Conversion Rate', '6 Months Timeline']
    },
    {
        name: 'Ahmed Hassan',
        company: 'E-commerce Plus',
        position: 'Marketing Director',
        content: 'Their social media strategy helped us reach 50K followers and increased our sales by 200%. The ROI has been incredible!',
        rating: 5,
        image: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
        results: ['50K Followers', '200% Sales Increase', 'High ROI']
    },
    {
        name: 'Maria Rodriguez',
        company: 'Fashion Forward',
        position: 'Founder',
        content: 'The content they created for us is absolutely stunning. Our brand recognition has never been stronger, and our engagement rates are through the roof!',
        rating: 5,
        image: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
        results: ['Strong Brand Recognition', 'High Engagement', 'Stunning Content']
    }
])

// Stats
const stats = ref([
    { number: '500+', label: 'Projects Completed', icon: Award },
    { number: '98%', label: 'Client Satisfaction', icon: Star },
    { number: '250%', label: 'Average ROI Increase', icon: TrendingUp },
    { number: '24/7', label: 'Support Available', icon: Clock }
])

// Technologies
const technologies = ref([
    { name: 'Google Analytics', icon: '📊' },
    { name: 'Facebook Ads', icon: '📱' },
    { name: 'Google Ads', icon: '🔍' },
    { name: 'LinkedIn Marketing', icon: '💼' },
    { name: 'Instagram Ads', icon: '📸' },
    { name: 'Twitter Marketing', icon: '🐦' },
    { name: 'YouTube Ads', icon: '📺' },
    { name: 'TikTok Marketing', icon: '🎵' },
    { name: 'Email Marketing', icon: '📧' },
    { name: 'SEO Tools', icon: '🔧' },
    { name: 'Content Management', icon: '📝' },
    { name: 'Social Media Management', icon: '📱' }
])
</script>

<template>
    <Head title="Digital Presence & Marketing - iTab" />

    <!-- Navigation -->
    <NavBar textColor="black" backgroundColor="white" />

    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative pt-20 pb-32 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute top-40 right-10 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
                <div class="absolute -bottom-20 left-1/3 w-80 h-80 bg-cyan-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 4s;"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                            <Zap class="w-4 h-4" />
                            Digital Marketing Excellence
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                            Transform Your
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Digital Presence
                            </span>
                        </h1>

                        <p class="text-xl md:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                            We help businesses grow online with data-driven strategies, creative campaigns,
                            and cutting-edge digital solutions that deliver real results.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                Get Started Today
                                <ArrowRight class="w-5 h-5" />
                            </button>
                            <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-semibold text-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center justify-center gap-2">
                                <Play class="w-5 h-5" />
                                Watch Demo
                            </button>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-8 pt-8">
                            <div v-for="stat in stats" :key="stat.label" class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <component :is="stat.icon" class="w-8 h-8 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-2">{{ stat.number }}</div>
                                <div class="text-sm text-gray-600">{{ stat.label }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl p-8 text-white">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Globe class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Website Development</h3>
                                        <p class="text-blue-100">Modern, responsive websites</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <TrendingUp class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">SEO & Analytics</h3>
                                        <p class="text-blue-100">Data-driven optimization</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Share2 class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Social Media</h3>
                                        <p class="text-blue-100">Engaging content strategy</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <Target class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">Paid Advertising</h3>
                                        <p class="text-blue-100">Targeted campaigns</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                            <Star class="w-12 h-12 text-yellow-800" />
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-green-400 rounded-full flex items-center justify-center animate-pulse">
                            <CheckCircle class="w-10 h-10 text-green-800" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Our Digital Marketing Services
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        We offer a complete range of digital marketing services to help your business
                        thrive in the digital landscape and achieve sustainable growth.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="service in services" :key="service.title"
                         class="group bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-2xl hover:border-blue-200 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-gradient-to-r rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" :class="service.color">
                            <component :is="service.icon" class="w-8 h-8 text-white" />
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                            {{ service.title }}
                        </h3>

                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ service.description }}
                        </p>

                        <ul class="space-y-3">
                            <li v-for="feature in service.features" :key="feature"
                                class="flex items-center gap-3 text-sm text-gray-600">
                                <CheckCircle class="w-4 h-4 text-green-500 flex-shrink-0" />
                                {{ feature }}
                            </li>
                        </ul>

                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <button class="w-full bg-gray-50 hover:bg-gray-100 text-gray-700 py-3 rounded-xl font-medium transition-colors duration-200 group-hover:bg-blue-50 group-hover:text-blue-600">
                                Learn More
                                <ArrowRight class="w-4 h-4 inline ml-2 group-hover:translate-x-1 transition-transform" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Our Proven Process
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        We follow a systematic approach to ensure your digital marketing success
                        and deliver measurable results.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="(step, index) in processSteps" :key="step.step"
                         class="relative group">
                        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r rounded-xl flex items-center justify-center" :class="step.color">
                                    <component :is="step.icon" class="w-6 h-6 text-white" />
                                </div>
                                <div class="text-3xl font-bold text-gray-300">{{ step.step }}</div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-4">
                                {{ step.title }}
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                {{ step.description }}
                            </p>
                        </div>

                        <!-- Connection Line -->
                        <div v-if="index < processSteps.length - 1"
                             class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 transform -translate-y-1/2"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technologies Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Technologies We Use
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        We leverage the latest tools and technologies to deliver exceptional results
                        for your digital marketing campaigns.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    <div v-for="tech in technologies" :key="tech.name"
                         class="group bg-gray-50 hover:bg-blue-50 rounded-xl p-6 text-center transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <div class="text-4xl mb-3">{{ tech.icon }}</div>
                        <div class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors">
                            {{ tech.name }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-gradient-to-br from-blue-50 to-purple-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        What Our Clients Say
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Don't just take our word for it. Here's what our satisfied clients have to say
                        about their digital marketing success with us.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div v-for="testimonial in testimonials" :key="testimonial.name"
                         class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <div class="flex items-center mb-6">
                            <img :src="testimonial.image" :alt="testimonial.name"
                                 class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ testimonial.name }}</h4>
                                <p class="text-sm text-gray-600">{{ testimonial.position }}</p>
                                <p class="text-sm text-blue-600 font-medium">{{ testimonial.company }}</p>
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <div class="flex">
                                <Star v-for="i in testimonial.rating" :key="i"
                                      class="w-5 h-5 text-yellow-400 fill-current" />
                            </div>
                        </div>

                        <p class="text-gray-600 leading-relaxed mb-6 italic">
                            "{{ testimonial.content }}"
                        </p>

                        <div class="space-y-2">
                            <div v-for="result in testimonial.results" :key="result"
                                 class="flex items-center gap-2 text-sm text-green-600">
                                <CheckCircle class="w-4 h-4" />
                                {{ result }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to Transform Your Digital Presence?
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-12">
                    Let's work together to create a digital marketing strategy that drives real results
                    for your business. Get started with a free consultation today.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <Mail class="w-5 h-5" />
                        Get Free Consultation
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center justify-center gap-2">
                        <Phone class="w-5 h-5" />
                        Call Now: +1 (555) 123-4567
                    </button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="md:col-span-2">
                        <h3 class="text-2xl font-bold mb-4">iTab Digital Marketing</h3>
                        <p class="text-gray-300 mb-6 max-w-md">
                            We help businesses build strong digital presence and drive growth through
                            innovative marketing strategies and cutting-edge technology.
                        </p>
                        <div class="flex gap-4">
                            <button class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <Globe class="w-5 h-5" />
                            </button>
                            <button class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <Share2 class="w-5 h-5" />
                            </button>
                            <button class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <MessageSquare class="w-5 h-5" />
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-4">Services</h4>
                        <ul class="space-y-2 text-gray-300">
                            <li>Website Development</li>
                            <li>SEO & Analytics</li>
                            <li>Social Media Marketing</li>
                            <li>Paid Advertising</li>
                            <li>Email Marketing</li>
                            <li>Content Marketing</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-4">Contact</h4>
                        <div class="space-y-2 text-gray-300">
                            <p>Email: marketing@itab.com</p>
                            <p>Phone: +1 (555) 123-4567</p>
                            <p>Address: 123 Digital St, Tech City</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 iTab Digital Marketing. All rights reserved.</p>
                </div>
            </div>
        </footer>
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
</style>
