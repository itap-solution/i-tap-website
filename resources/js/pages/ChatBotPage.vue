<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted } from 'vue'
import { Button } from '@/components/ui/button'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from '@/components/ui/dialog'
import NavBar from '@/components/NavBar.vue'
import ChatBot from '@/components/ChatBot.vue'

// ChatBot is automatically registered in Vue 3 Composition API
import {
    MessageCircle,
    Bot,
    Zap,
    Github,
    Linkedin,
    Mail,
    ExternalLink,
    ArrowRight,
    Users,
    Shield,
    Globe,
    Smartphone
} from 'lucide-vue-next'

// Metaball Animation
let metaballCanvas: HTMLCanvasElement | null = null;
let metaballGl: WebGLRenderingContext | null = null;
let metaballProgram: WebGLProgram | null = null;
let metaballAnimationId: number | null = null;

const numMetaballs = 30;
const metaballs: Array<{x: number, y: number, vx: number, vy: number, r: number}> = [];

function compileShader(source: string, type: number): WebGLShader | null {
  if (!metaballGl) return null;
  const shader = metaballGl.createShader(type);
  if (!shader) return null;
  metaballGl.shaderSource(shader, source);
  metaballGl.compileShader(shader);
  if (!metaballGl.getShaderParameter(shader, metaballGl.COMPILE_STATUS)) {
    console.error('Shader compilation error:', metaballGl.getShaderInfoLog(shader));
    metaballGl.deleteShader(shader);
    return null;
  }
  return shader;
}

function getAttribLocation(program: WebGLProgram, name: string): number {
  if (!metaballGl) return -1;
  return metaballGl.getAttribLocation(program, name);
}

function getUniformLocation(program: WebGLProgram, name: string): WebGLUniformLocation | null {
  if (!metaballGl) return null;
  return metaballGl.getUniformLocation(program, name);
}

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
        gl_FragColor = vec4(mix(vec3(0.1, 0.1, 0.2), vec3(0.2, 0.2, 0.4), max(0.0, 1.0 - (sum - 0.99) * 100.0)), 1.0);
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

    metaballGl.clear(metaballGl.COLOR_BUFFER_BIT);

    for (let i = 0; i < metaballs.length; i++) {
      const metaball = metaballs[i];
      metaball.x += metaball.vx;
      metaball.y += metaball.vy;

      if (metaball.x <= metaball.r || metaball.x >= width - metaball.r) metaball.vx *= -1;
      if (metaball.y <= metaball.r || metaball.y >= height - metaball.r) metaball.vy *= -1;

      metaball.x = Math.max(metaball.r, Math.min(width - metaball.r, metaball.x));
      metaball.y = Math.max(metaball.r, Math.min(height - metaball.r, metaball.y));
    }

    const metaballData = new Float32Array(metaballs.length * 3);
    for (let i = 0; i < metaballs.length; i++) {
      metaballData[i * 3] = metaballs[i].x;
      metaballData[i * 3 + 1] = metaballs[i].y;
      metaballData[i * 3 + 2] = metaballs[i].r;
    }

    metaballGl.uniform3fv(metaballsHandle, metaballData);
    metaballGl.drawArrays(metaballGl.TRIANGLE_STRIP, 0, 4);

    metaballAnimationId = requestAnimationFrame(loop);
  }

  loop();
}

function handleResize() {
    if (metaballCanvas) {
        metaballCanvas.width = window.innerWidth;
        metaballCanvas.height = window.innerHeight;
    }
}

onMounted(() => {
    setTimeout(() => {
        initMetaballAnimation();
    }, 100);

    window.addEventListener('resize', handleResize);
    handleResize();
});

onUnmounted(() => {
    if (metaballAnimationId) {
        cancelAnimationFrame(metaballAnimationId);
    }
    window.removeEventListener('resize', handleResize);
});

// Chat Bot Features
const chatbotFeatures = [
    {
        icon: MessageCircle,
        title: "24/7 Customer Support",
        description: "Intelligent chatbots that provide instant responses to customer queries around the clock."
    },
    {
        icon: Bot,
        title: "AI-Powered Conversations",
        description: "Advanced natural language processing for human-like interactions and understanding."
    },
    {
        icon: Zap,
        title: "Instant Response",
        description: "Lightning-fast responses that keep your customers engaged and satisfied."
    },
    {
        icon: Users,
        title: "Multi-User Support",
        description: "Handle multiple conversations simultaneously without compromising quality."
    },
    {
        icon: Shield,
        title: "Secure & Reliable",
        description: "Enterprise-grade security with 99.9% uptime guarantee for your business."
    },
    {
        icon: Globe,
        title: "Multi-Language",
        description: "Support for multiple languages to serve your global customer base."
    }
];

// Use Cases
const useCases = [
    {
        title: "E-commerce Support",
        description: "Help customers with product inquiries, order tracking, and returns.",
        icon: "🛒"
    },
    {
        title: "Lead Generation",
        description: "Qualify leads and collect contact information automatically.",
        icon: "🎯"
    },
    {
        title: "Technical Support",
        description: "Provide instant technical assistance and troubleshooting guides.",
        icon: "🔧"
    },
    {
        title: "Booking & Scheduling",
        description: "Handle appointments, reservations, and scheduling requests.",
        icon: "📅"
    },
    {
        title: "FAQ Automation",
        description: "Answer frequently asked questions instantly and accurately.",
        icon: "❓"
    },
    {
        title: "Sales Assistant",
        description: "Guide customers through the sales process and product selection.",
        icon: "💰"
    }
];
</script>

<template>
    <Head title="Chat Bot Solutions - iTab" />

    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <NavBar
            logoSrc="/asset/logo-new-white.png"
            textColor="text-white"
            backgroundColor="bg-transparent"
        />

        <!-- Hero Section with Metaball Background -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Metaball Background -->
            <canvas
                id="metaball-canvas"
                class="absolute inset-0 w-full h-full"
                style="background: #000000;"
            ></canvas>

            <!-- Content -->
            <div class="relative z-10 text-center px-4 max-w-6xl mx-auto">
                <h2 class="text-4xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-white mb-8 leading-tight text-center museo-moderno">
                    Chatbots that Talk<br>
                    <span style="color: #ffdc4f;">Business</span>
                </h2>
                <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto mb-12 leading-relaxed">
                    Turn visitors into customers with intelligent, automated conversations tailored to your brand.
                </p>
            </div>
        </section>

        <!-- Chat Bot Features -->
        <section class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">Why Choose Our Chat Bot Solutions?</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Advanced AI technology meets exceptional user experience
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="feature in chatbotFeatures" :key="feature.title"
                         class="bg-white rounded-3xl p-8 border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <component :is="feature.icon" class="w-8 h-8 text-white" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ feature.title }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ feature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Use Cases -->
        <section class="py-20 px-4 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">Perfect For Every Business</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Discover how our chatbot solutions can transform your customer interactions
                    </p>
                </div>

                <!-- Interactive Cards with Hover Effects -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="(useCase, index) in useCases" :key="useCase.title"
                         class="group relative overflow-hidden bg-white rounded-3xl p-8 border border-gray-200 hover:border-blue-300 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <!-- Gradient Background on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Icon with Animation -->
                        <div class="relative z-10 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                                <span class="text-2xl">{{ useCase.icon }}</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                                {{ useCase.title }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                {{ useCase.description }}
                            </p>
                        </div>

                        <!-- Decorative Element -->
                        <div class="absolute top-4 right-4 w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="absolute bottom-4 left-4 w-6 h-6 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                    </div>
                </div>

                <!-- Bottom CTA -->
                <div class="text-center mt-16">
                    <p class="text-lg text-gray-600 mb-6">Ready to see how chatbots can help your business?</p>
                    <Button size="lg" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 text-lg font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                        Get Your Custom Solution
                        <ArrowRight class="ml-2 w-5 h-5" />
                    </Button>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Ready to Transform Your Customer Experience?
                </h2>
                <p class="text-xl text-white/90 mb-12 leading-relaxed">
                    Get started with our intelligent chatbot solutions today and see the difference
                    AI can make for your business.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Button size="lg" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 text-lg font-semibold">
                        Get Started Today
                        <ArrowRight class="ml-2 w-5 h-5" />
                    </Button>
                    <Button size="lg" variant="outline" class="border-white text-white hover:bg-white/10 px-8 py-4 text-lg font-semibold">
                        Learn More
                    </Button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="/asset/logo-new-white.png"
                                 alt="iTab Logo"
                                 class="h-56 w-auto -ml-8">
                        </div>
                        <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                            Leading software development company specializing in cutting-edge web and mobile applications.
                            We transform innovative ideas into digital excellence.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://github.com" target="_blank" rel="noopener noreferrer"
                               class="text-gray-400 hover:text-white transition-colors duration-200">
                                <Github class="w-6 h-6" />
                            </a>
                            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                               class="text-gray-400 hover:text-white transition-colors duration-200">
                                <Linkedin class="w-6 h-6" />
                            </a>
                            <a href="mailto:info@itab.com"
                               class="text-gray-400 hover:text-white transition-colors duration-200">
                                <Mail class="w-6 h-6" />
                            </a>
                        </div>
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
                            <li><span class="text-gray-300">Chat Bot</span></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="border-t border-gray-800 pt-8 mb-8">
                        <h4 class="text-lg font-semibold mb-6">Contact</h4>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <Mail class="w-5 h-5 text-blue-400" />
                                <span class="text-gray-300">info@itab.com</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <Smartphone class="w-5 h-5 text-blue-400" />
                                <span class="text-gray-300">+1 (555) 123-4567</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <Globe class="w-5 h-5 text-blue-400" />
                                <span class="text-gray-300">www.itab.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 mt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-sm">
                            © 2024 iTab. All rights reserved. | Powered by iTab Solution
                        </p>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Chat Bot Component -->
        <ChatBot />
    </div>
</template>

<style scoped>
.museo-moderno {
    font-family: 'Museo Moderno', sans-serif;
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
}
</style>
