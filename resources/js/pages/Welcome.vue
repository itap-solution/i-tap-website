<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted, watch } from 'vue'
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

// Promo Modal
const showPromoModal = ref(false)

const closePromoModal = () => {
    showPromoModal.value = false
    // Save with today's date so it shows again tomorrow
    const today = new Date().toDateString()
    localStorage.setItem('promo-closed-date', today)
}

// ChatBot is automatically registered in Vue 3 Composition API
import {
    Smartphone,
    Globe,
    Zap,
    Github,
    Linkedin,
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
    X,
    Sparkles
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
    
    // Show promo modal after a short delay
    setTimeout(() => {
        // Check if user has already closed the promo today
        if (typeof window !== 'undefined') {
            const today = new Date().toDateString()
            const promoClosedDate = localStorage.getItem('promo-closed-date')
            
            // Show modal if never closed, or if closed on a different day
            if (!promoClosedDate || promoClosedDate !== today) {
                showPromoModal.value = true
            }
        }
    }, 1500)
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

// Partners data
const partners = ref([
    {
        name: 'Microsoft',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
        website: 'https://microsoft.com'
    },
    {
        name: 'Google',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
        website: 'https://google.com'
    },
    {
        name: 'Amazon',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
        website: 'https://amazon.com'
    },
    {
        name: 'Apple',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
        website: 'https://apple.com'
    },
    {
        name: 'Meta',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Meta_Platforms_Inc._logo.svg',
        website: 'https://meta.com'
    },
    {
        name: 'Netflix',
        logo: 'https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg',
        website: 'https://netflix.com'
    }
]);
</script>

<template>
    <Head title="iTab - Leading Software Development Company" />

    <!-- Navigation Bar -->
    <NavBar />

    <!-- Promo Modal -->
    <Transition name="modal">
        <div v-if="showPromoModal" 
             class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
             @click.self="closePromoModal">
            <div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 rounded-3xl p-8 md:p-12 max-w-lg w-full shadow-2xl transform transition-all">
                <!-- Close Button -->
                <button @click="closePromoModal" 
                        class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors z-10">
                    <X class="w-6 h-6" />
                </button>
                
                <!-- Content -->
                <div class="text-center text-white">
                    <!-- Icon/Emoji -->
                    <div class="mb-6">
                        <Sparkles class="w-16 h-16 mx-auto text-yellow-300 animate-pulse" />
                    </div>
                    
                    <!-- Main Text -->
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 leading-tight">
                        عرض خاص لفترة محدودة: تطبيق أو موقع بـ 999 ريال
                    </h2>
                    
                    <!-- CTA Button -->
                    <a href="https://wa.me/966535815072?text=مرحباً، أريد الاستفادة من العرض الخاص لتطبيق أو موقع بـ 999 ريال" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-block bg-white text-blue-600 font-bold px-8 py-4 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        تواصل معنا
                    </a>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl translate-x-1/2 translate-y-1/2"></div>
            </div>
        </div>
    </Transition>

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
                                <span style="color: #ffdc4f;">{{ t('heroTitleHighlight') }}</span>
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

                <!-- Partners Scrolling Animation -->
                <div class="relative overflow-hidden">
                    <div class="flex animate-scroll">
                        <!-- First set of partners -->
                        <div v-for="partner in partners" :key="`first-${partner.name}`"
                             class="group flex items-center justify-center p-6 hover:scale-105 transition-all duration-300 flex-shrink-0 mx-4">
                            <a :href="partner.website" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-center w-32 h-16">
                                <img :src="partner.logo"
                                     :alt="`${partner.name} logo`"
                                     class="max-h-12 max-w-full object-contain"
                                     loading="lazy">
                            </a>
                        </div>
                        <!-- Duplicate set for seamless loop -->
                        <div v-for="partner in partners" :key="`second-${partner.name}`"
                             class="group flex items-center justify-center p-6 hover:scale-105 transition-all duration-300 flex-shrink-0 mx-4">
                            <a :href="partner.website" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-center w-32 h-16">
                                <img :src="partner.logo"
                                     :alt="`${partner.name} logo`"
                                     class="max-h-12 max-w-full object-contain"
                                     loading="lazy">
                            </a>
                        </div>
                    </div>
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

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 30s linear infinite;
    display: flex;
    width: 200%;
}

.animate-scroll:hover {
    animation-play-state: paused;
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

/* Modal Transitions */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-active .relative,
.modal-leave-active .relative {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .relative,
.modal-leave-to .relative {
    transform: scale(0.9) translateY(-20px);
    opacity: 0;
}

</style>
