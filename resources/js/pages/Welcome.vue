<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'
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
    BadgeCheck
} from 'lucide-vue-next'

// Metaball Animation
let metaballCanvas: HTMLCanvasElement | null = null;
let metaballGl: WebGLRenderingContext | null = null;
let metaballProgram: WebGLProgram | null = null;
let metaballAnimationId: number | null = null;

const numMetaballs = 30;
const metaballs: Array<{x: number, y: number, vx: number, vy: number, r: number}> = [];

function initMetaballAnimation() {
  metaballCanvas = document.getElementById('metaball-canvas') as HTMLCanvasElement;
  if (!metaballCanvas) return;

  const width = metaballCanvas.width = window.innerWidth;
  const height = metaballCanvas.height = window.innerHeight;

  metaballGl = metaballCanvas.getContext('webgl');
  if (!metaballGl) return;

  // Initialize metaballs
  for (let i = 0; i < numMetaballs; i++) {
    const radius = Math.random() * 60 + 10;
    metaballs.push({
      x: Math.random() * (width - 2 * radius) + radius,
      y: Math.random() * (height - 2 * radius) + radius,
      vx: (Math.random() - 0.5) * 3,
      vy: (Math.random() - 0.5) * 3,
      r: radius * 0.75
    });
  }

  const vertexShaderSrc = `
    attribute vec2 position;
    void main() {
      gl_Position = vec4(position, 0.0, 1.0);
    }
  `;

  const fragmentShaderSrc = `
    precision highp float;
    const float WIDTH = ${width}.0;
    const float HEIGHT = ${height}.0;
    uniform vec3 metaballs[${numMetaballs}];

    void main(){
      float x = gl_FragCoord.x;
      float y = gl_FragCoord.y;

      float sum = 0.0;
      for (int i = 0; i < ${numMetaballs}; i++) {
        vec3 metaball = metaballs[i];
        float dx = metaball.x - x;
        float dy = metaball.y - y;
        float radius = metaball.z;

        sum += (radius * radius) / (dx * dx + dy * dy);
      }

      if (sum >= 0.99) {
        gl_FragColor = vec4(mix(vec3(x / WIDTH, y / HEIGHT, 1.0), vec3(0, 0, 0), max(0.0, 1.0 - (sum - 0.99) * 100.0)), 1.0);
        return;
      }

      gl_FragColor = vec4(0.0, 0.0, 0.0, 1.0);
    }
  `;

  const vertexShader = compileShader(vertexShaderSrc, metaballGl.VERTEX_SHADER);
  const fragmentShader = compileShader(fragmentShaderSrc, metaballGl.FRAGMENT_SHADER);

  metaballProgram = metaballGl.createProgram();
  if (!metaballProgram) return;

  metaballGl.attachShader(metaballProgram, vertexShader);
  metaballGl.attachShader(metaballProgram, fragmentShader);
  metaballGl.linkProgram(metaballProgram);
  metaballGl.useProgram(metaballProgram);

  const vertexData = new Float32Array([
    -1.0,  1.0,
    -1.0, -1.0,
     1.0,  1.0,
     1.0, -1.0,
  ]);

  const vertexDataBuffer = metaballGl.createBuffer();
  metaballGl.bindBuffer(metaballGl.ARRAY_BUFFER, vertexDataBuffer);
  metaballGl.bufferData(metaballGl.ARRAY_BUFFER, vertexData, metaballGl.STATIC_DRAW);

  const positionHandle = getAttribLocation(metaballProgram, 'position');
  metaballGl.enableVertexAttribArray(positionHandle);
  metaballGl.vertexAttribPointer(positionHandle, 2, metaballGl.FLOAT, false, 2 * 4, 0);

  const metaballsHandle = getUniformLocation(metaballProgram, 'metaballs');

  function loop() {
    if (!metaballGl || !metaballProgram) return;

    for (let i = 0; i < numMetaballs; i++) {
      const metaball = metaballs[i];
      metaball.x += metaball.vx;
      metaball.y += metaball.vy;

      if (metaball.x < metaball.r || metaball.x > width - metaball.r) metaball.vx *= -1;
      if (metaball.y < metaball.r || metaball.y > height - metaball.r) metaball.vy *= -1;
    }

    const dataToSendToGPU = new Float32Array(3 * numMetaballs);
    for (let i = 0; i < numMetaballs; i++) {
      const baseIndex = 3 * i;
      const mb = metaballs[i];
      dataToSendToGPU[baseIndex + 0] = mb.x;
      dataToSendToGPU[baseIndex + 1] = mb.y;
      dataToSendToGPU[baseIndex + 2] = mb.r;
    }
    metaballGl.uniform3fv(metaballsHandle, dataToSendToGPU);

    metaballGl.drawArrays(metaballGl.TRIANGLE_STRIP, 0, 4);
    metaballAnimationId = requestAnimationFrame(loop);
  }

  function compileShader(shaderSource: string, shaderType: number) {
    const shader = metaballGl!.createShader(shaderType);
    if (!shader) throw new Error('Failed to create shader');

    metaballGl!.shaderSource(shader, shaderSource);
    metaballGl!.compileShader(shader);

    if (!metaballGl!.getShaderParameter(shader, metaballGl!.COMPILE_STATUS)) {
      throw new Error("Shader compile failed with: " + metaballGl!.getShaderInfoLog(shader));
    }
    return shader;
  }

  function getUniformLocation(program: WebGLProgram, name: string) {
    const uniformLocation = metaballGl!.getUniformLocation(program, name);
    if (uniformLocation === -1) {
      throw new Error('Can not find uniform ' + name + '.');
    }
    return uniformLocation;
  }

  function getAttribLocation(program: WebGLProgram, name: string) {
    const attributeLocation = metaballGl!.getAttribLocation(program, name);
    if (attributeLocation === -1) {
      throw new Error('Can not find attribute ' + name + '.');
    }
    return attributeLocation;
  }

  loop();
}


// Vanta.js Animation
let vantaEffect: any = null

const initVantaEffect = () => {
    if (typeof window !== 'undefined' && (window as any).VANTA) {
        vantaEffect = (window as any).VANTA.NET({
            el: "#vanta-hero",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3b82f6,
            backgroundColor: 0x0f0f23,
            points: 8.00,
            maxDistance: 20.00,
            spacing: 17.00
        })
    }
}

onMounted(() => {
    // Initialize metaball animation after a short delay to ensure DOM is ready
    setTimeout(() => {
        initMetaballAnimation();
    }, 100);
})

// Clean up animations when component unmounts
onUnmounted(() => {
    if (metaballAnimationId) {
        cancelAnimationFrame(metaballAnimationId);
    }
    if (vantaEffect) {
        vantaEffect.destroy()
    }
})

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
    <NavBar />

    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center px-4 pt-16 bg-black overflow-hidden">
            <!-- Metaball Animation Canvas -->
            <canvas id="metaball-canvas" class="absolute inset-0 w-full h-full"></canvas>
            <div class="max-w-7xl mx-auto w-full z-10 relative">
                <div class="flex justify-center items-center">
                    <!-- Content -->
                    <div class="text-center max-w-4xl">

                        <!-- Tagline -->
                        <div class="mb-12">
                            <h2 class="text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-8 leading-tight text-center museo-moderno">
                                {{ t('heroTitle') }}<br>
                                <span style="color: #ff751f;">{{ t('heroTitleHighlight') }}</span>
                            </h2>
                            <p class="text-2xl md:text-3xl lg:text-4xl text-gray-300 leading-relaxed text-center">
                                {{ t('heroSubtitle') }}
                            </p>

                            <!-- Technology Icons -->
                            <div class="mt-12 flex flex-wrap justify-center items-center gap-6 md:gap-8">
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Amazon_Web_Services_Logo.svg" alt="AWS" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">AWS</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">Laravel</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">PHP</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">React</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue.js" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">Vue.js</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">Node.js</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg" alt="Flutter" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">Flutter</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="Python" class="w-6 h-6">
                                    <span class="text-white text-sm font-medium">Python</span>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
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
                        class="group flex items-center justify-center p-4 transition-all duration-300 hover:scale-110"
                    >
                        <img 
                            :src="partner.logo"
                            :alt="`${partner.name} logo`"
                            class="max-h-20 max-w-full object-contain opacity-80 group-hover:opacity-100 transition-all duration-300"
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

        <!-- Our Services -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Our Services -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('servicesTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('servicesSubtitle') }}
                    </p>
                </div>

                <!-- Services Grid -->
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

        <!-- Trust Signals -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('trustTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('trustSubtitle') }}
                    </p>
                        </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- NDA Confidentiality -->
                    <div class="group relative bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border-2 border-gray-200 hover:border-blue-300 hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-purple-500 rounded-full blur-3xl"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <FileLock class="w-10 h-10 text-gray-700" />
                    </div>
                            
                            <div class="text-center mb-4">
                                <BadgeCheck class="w-8 h-8 text-green-500 mx-auto mb-2" />
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ t('trustNDA') }}</h3>
                </div>
                            
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                {{ t('trustNDADesc') }}
                            </p>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustNDALegal') }}</span>
            </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustNDAStrict') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustNDASecure') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Secure Development Practices -->
                    <div class="group relative bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border-2 border-gray-200 hover:border-blue-300 hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-purple-500 rounded-full blur-3xl"></div>
                    </div>

                        <div class="relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <Shield class="w-10 h-10 text-gray-700" />
                            </div>
                            
                            <div class="text-center mb-4">
                                <BadgeCheck class="w-8 h-8 text-green-500 mx-auto mb-2" />
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ t('trustSecure') }}</h3>
                            </div>
                            
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                {{ t('trustSecureDesc') }}
                            </p>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustSecureCoding') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustSecureAudits') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustSecureEncryption') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GDPR / Data Protection -->
                    <div class="group relative bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border-2 border-gray-200 hover:border-blue-300 hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-purple-500 rounded-full blur-3xl"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <Lock class="w-10 h-10 text-gray-700" />
                            </div>
                            
                            <div class="text-center mb-4">
                                <BadgeCheck class="w-8 h-8 text-green-500 mx-auto mb-2" />
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ t('trustGDPR') }}</h3>
                            </div>
                            
                            <p class="text-gray-600 text-center leading-relaxed mb-6">
                                {{ t('trustGDPRDesc') }}
                            </p>
                            
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustGDPRCompliant') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustGDPRPrivacy') }}</span>
                                </div>
                                <div class="flex items-center gap-3 bg-white/60 rounded-lg p-3">
                                    <CheckCircle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    <span class="text-sm text-gray-700 font-medium">{{ t('trustGDPRDeletion') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Trust Badges -->
                <div class="mt-16 pt-12 border-t border-gray-200">
                    <div class="flex flex-wrap items-center justify-center gap-8">
                        <div class="flex items-center gap-3 bg-white rounded-xl px-6 py-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <FileCheck class="w-8 h-8 text-gray-700" />
                        <div>
                                <div class="font-semibold text-gray-900">{{ t('trustISO') }}</div>
                                <div class="text-xs text-gray-500">{{ t('trustISOCompliant') }}</div>
                                </div>
                            </div>
                        <div class="flex items-center gap-3 bg-white rounded-xl px-6 py-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <Shield class="w-8 h-8 text-gray-700" />
                            <div>
                                <div class="font-semibold text-gray-900">{{ t('trustSSL') }}</div>
                                <div class="text-xs text-gray-500">{{ t('trustSSLSecure') }}</div>
                        </div>
                        </div>
                        <div class="flex items-center gap-3 bg-white rounded-xl px-6 py-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <BadgeCheck class="w-8 h-8 text-gray-700" />
                        <div>
                                <div class="font-semibold text-gray-900">{{ t('trustCertified') }}</div>
                                <div class="text-xs text-gray-500">{{ t('trustCertifiedStandards') }}</div>
                                </div>
                                </div>
                        <div class="flex items-center gap-3 bg-white rounded-xl px-6 py-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <Lock class="w-8 h-8 text-gray-700" />
                            <div>
                                <div class="font-semibold text-gray-900">{{ t('trustBackup') }}</div>
                                <div class="text-xs text-gray-500">{{ t('trustBackupRegular') }}</div>
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
