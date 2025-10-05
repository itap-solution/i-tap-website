<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted } from 'vue'
import { Button } from '@/components/ui/button'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from '@/components/ui/dialog'
import NavBar from '@/components/NavBar.vue'
import ChatBot from '@/components/ChatBot.vue'

// ChatBot is automatically registered in Vue 3 Composition API
import {
    Smartphone,
    Globe,
    Zap,
    Github,
    Linkedin,
    Mail,
    ExternalLink,
    ArrowRight,
    MessageCircle
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

// Types
interface Project {
    title: string
    description: string
    image: string
    technologies: string[]
    year: string
    category: string
    platform?: string
    github: string
    live: string
}

// Project Modal State
const isProjectModalOpen = ref(false)
const selectedProject = ref<Project | null>(null)

// Featured Projects Data
const featuredProjects = ref<Project[]>([
    {
        title: "E-Commerce Mobile App",
        description: "Full-featured shopping app with AI recommendations and secure payments",
        image: "https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=600&fit=crop",
        technologies: ["Flutter", "Firebase", "Node.js", "AI/ML", "Stripe"],
        year: "2024",
        category: "Mobile Application",
        platform: "iOS & Android",
        github: "https://github.com/example",
        live: "https://demo.example.com"
    },
    {
        title: "Healthcare Management System",
        description: "Comprehensive platform for hospitals and clinics with real-time analytics",
        image: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=600&fit=crop",
        technologies: ["React", "Laravel", "MySQL", "AWS", "Chart.js"],
        year: "2024",
        category: "Web Application",
        platform: "Web Platform",
        github: "https://github.com/example",
        live: "https://demo.example.com"
    },
    {
        title: "AI-Powered Analytics Dashboard",
        description: "Advanced business intelligence platform with machine learning insights",
        image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop",
        technologies: ["Vue.js", "Python", "TensorFlow", "D3.js", "PostgreSQL"],
        year: "2024",
        category: "AI Solution",
        platform: "Web & API",
        github: "https://github.com/example",
        live: "https://demo.example.com"
    }
])

const openProjectModal = (project: any) => {
    selectedProject.value = project
    isProjectModalOpen.value = true
}

const contactForSale = (project: Project) => {
    const subject = `Inquiry about ${project.title} - Sales Information`
    const body = `Hello iTab,

I am interested in learning more about your project "${project.title}".

Project Details:
- Title: ${project.title}
- Category: ${project.category}
- Technologies: ${project.technologies.join(', ')}

Could you please provide more information about purchasing or licensing this solution?

Best regards,`

    const mailtoLink = `mailto:contact@itab.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
    window.open(mailtoLink, '_self')
}

const getTechIcon = (tech: string): string => {
    const techIcons: { [key: string]: string } = {
        'Flutter': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg',
        'Firebase': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg',
        'Node.js': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
        'AI/ML': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tensorflow/tensorflow-original.svg',
        'Stripe': 'https://images.ctfassets.net/fzn2n1nzq965/HTTOloNPhisV9P4hlMPNA/cacf1bb88b9fc492dfad34378d844280/Stripe_icon_-_square.svg',
        'React': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
        'Laravel': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg',
        'MySQL': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
        'AWS': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original.svg',
        'Chart.js': 'https://www.chartjs.org/img/chartjs-logo.svg',
        'Vue.js': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg',
        'Python': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg',
        'TensorFlow': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tensorflow/tensorflow-original.svg',
        'D3.js': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/d3js/d3js-original.svg',
        'PostgreSQL': 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg'
    }

    return techIcons[tech] || 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/devicon/devicon-original.svg'
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
                                Transforming Ideas<br>
                                <span style="color: #ffdc4f;">into Digital Excellence</span>
                            </h2>
                            <p class="text-2xl md:text-3xl lg:text-4xl text-gray-300 leading-relaxed text-center">
                                We design and develop innovative web and mobile solutions that empower businesses to grow, engage, and lead through technology.
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
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">Partners</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Trusted by leading companies worldwide. We're proud to work with industry leaders.
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
                        <span class="text-gray-700 text-xs font-medium">Trusted by 1000+ companies worldwide</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Services -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Our Services -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">Our Services</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Comprehensive software solutions tailored to your business needs
                    </p>
                </div>

                <!-- Services Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Smartphone class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Mobile Development</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Native iOS & Android apps, Cross-platform solutions with React Native & Flutter.
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
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Globe class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Web Applications</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Modern, scalable web applications with cutting-edge frameworks and cloud deployment.
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
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <Zap class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">AI & Automation</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Intelligent solutions powered by machine learning and artificial intelligence.
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
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Cloud Services</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Scalable cloud infrastructure and deployment solutions to ensure your applications run smoothly and securely.
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
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Consulting</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Expert guidance and strategic planning to help you make informed technology decisions and optimize your digital transformation.
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
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <MessageCircle class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Chat Bot</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Intelligent conversational AI solutions to enhance customer engagement and automate support processes.
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
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Projects Showcase -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">Featured Projects</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Discover our latest innovations and success stories
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="project in featuredProjects" :key="project.title"
                         class="group cursor-pointer" @click="openProjectModal(project)">
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-1 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-500 group-hover:scale-105">
                            <div class="bg-white rounded-3xl p-6 h-full">
                                <!-- Project Image -->
                                <div class="relative aspect-video bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-2xl overflow-hidden mb-6">
                                    <img :src="project.image" :alt="project.title"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4">
                                        <div class="bg-white/10 backdrop-blur-sm rounded-full p-2">
                                            <ExternalLink class="w-4 h-4 text-white" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Info -->
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                            {{ project.title }}
                                        </h3>
                                        <p class="text-gray-600 leading-relaxed">{{ project.description }}</p>
                                    </div>

                                    <!-- Tech Stack -->
                                    <div class="flex flex-wrap gap-3">
                                        <div v-for="tech in project.technologies?.slice(0, 3)" :key="tech"
                                             class="flex items-center gap-2 text-gray-600 text-sm">
                                            <img :src="getTechIcon(tech)" :alt="tech" class="w-5 h-5" />
                                            <span>{{ tech }}</span>
                                        </div>
                                        <div v-if="project.technologies && project.technologies.length > 3"
                                             class="flex items-center gap-1 text-blue-600 text-sm">
                                            <span class="text-xs">+{{ project.technologies.length - 3 }} more</span>
                                        </div>
                                    </div>

                                    <!-- Project Meta -->
                                    <div class="pt-4 border-t border-gray-200 space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500">{{ project.year }}</span>
                                            <div class="flex items-center gap-2 text-blue-600 group-hover:text-blue-700 transition-colors">
                                                <span class="text-xs font-medium">View Project</span>
                                                <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <!-- Project Modal -->
        <Dialog :open="isProjectModalOpen" @update:open="isProjectModalOpen = false">
            <DialogContent class="max-w-5xl bg-gradient-to-br from-gray-900 to-black border border-white/20 backdrop-blur-xl">
                <DialogHeader>
                    <DialogTitle class="text-3xl font-bold text-white">{{ selectedProject?.title }}</DialogTitle>
                    <DialogDescription class="text-gray-300 text-lg">{{ selectedProject?.description }}</DialogDescription>
                </DialogHeader>
                <div class="space-y-8">
                    <div class="relative aspect-video bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-2xl overflow-hidden">
                        <img :src="selectedProject?.image" :alt="selectedProject?.title" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xl font-bold text-white mb-4">Technologies Used</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div v-for="tech in selectedProject?.technologies" :key="tech"
                                     class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10 backdrop-blur-sm hover:bg-white/10 transition-colors">
                                    <img :src="getTechIcon(tech)" :alt="tech" class="w-8 h-8" />
                                    <span class="text-gray-300 font-medium">{{ tech }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white mb-4">Project Details</h4>
                            <div class="space-y-3 text-gray-300">
                                <div class="flex justify-between items-center py-2 border-b border-white/10">
                                    <span class="font-medium">Year:</span>
                                    <span>{{ selectedProject?.year }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-white/10">
                                    <span class="font-medium">Category:</span>
                                    <span>{{ selectedProject?.category }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="font-medium">Platform:</span>
                                    <span>{{ selectedProject?.platform || 'Web & Mobile' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex gap-4">
                            <Button asChild variant="outline" class="border-white/20 text-gray-300 hover:bg-white/10 flex-1">
                                <a :href="selectedProject?.github" target="_blank" rel="noopener noreferrer">
                                    <Github class="w-4 h-4 mr-2" />
                                    View Code
                                </a>
                            </Button>
                            <Button asChild class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 flex-1">
                                <a :href="selectedProject?.live" target="_blank" rel="noopener noreferrer">
                                    <ExternalLink class="w-4 h-4 mr-2" />
                                    Live Demo
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </DialogContent>
        </Dialog>

        <!-- Chat Bot -->
        <ChatBot />
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

</style>
