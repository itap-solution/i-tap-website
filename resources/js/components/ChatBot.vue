<template>
    <div class="fixed bottom-6 right-6 md:bottom-6 md:right-6 sm:bottom-4 sm:right-4 z-50">

        <!-- Chat Toggle Button -->
        <button
            v-if="!isOpen"
            @click="openChat"
            class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 md:p-6 shadow-lg transition-all duration-300 hover:scale-110 overflow-hidden"
            style="z-index: 9999; position: fixed; bottom: 24px; right: 24px; background-color: #2563eb !important; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;"
        >
            <img src="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" alt="iTab Logo" class="w-16 h-16 md:w-18 md:h-18 object-cover" />
        </button>

        <!-- Chat Window -->
        <div
            v-if="isOpen"
            class="bg-white rounded-2xl shadow-2xl w-[95vw] h-[80vh] max-w-[520px] max-h-[700px] md:w-[520px] md:h-[700px] flex flex-col overflow-hidden"
        >
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-3 md:p-4 flex items-center justify-between">
                <div class="flex items-center space-x-2 md:space-x-3">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-white/20 rounded-full flex items-center justify-center overflow-hidden">
                        <img src="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" alt="iTab Logo" class="w-full h-full object-cover" />
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm md:text-base">iTab Assistant</h3>
                        <p class="text-xs text-blue-100">Online</p>
                    </div>
                </div>
                <button @click="closeChat" class="text-white/80 hover:text-white">
                    <X class="w-4 h-4 md:w-5 md:h-5" />
                </button>
            </div>

            <!-- Chat Messages -->
            <div ref="messagesContainer" class="flex-1 overflow-y-auto p-3 md:p-4 space-y-3 md:space-y-4 bg-gray-50">
                <div v-for="message in messages" :key="message.id"
                     :class="['flex', message.isUser ? 'justify-end' : 'justify-start']">
                    <div :class="[
                        'max-w-[80%] md:max-w-xs px-3 py-2 md:px-4 md:py-3 rounded-2xl',
                        message.isUser
                            ? 'bg-blue-600 text-white rounded-br-md'
                            : 'bg-white text-gray-800 rounded-bl-md shadow-sm border'
                    ]">
                        <p class="text-xs md:text-sm">{{ message.text }}</p>
                        <p class="text-xs mt-1 opacity-70">{{ formatTime(message.timestamp) }}</p>
                    </div>
                </div>

        <!-- Language Options -->
        <div v-if="showLanguageOptions" class="space-y-2">
            <div class="text-xs text-gray-500 text-center">{{ getText('selectLanguage') }}</div>
            <div class="grid grid-cols-1 gap-2">
                <button
                    v-for="language in languageOptions"
                    :key="language.id"
                    @click="selectLanguage(language)"
                    class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                >
                    <div class="flex items-center space-x-3">
                        <div class="text-2xl">{{ language.flag }}</div>
                        <div>
                            <p class="font-medium text-sm text-gray-900">{{ language.name }}</p>
                        </div>
                    </div>
                </button>
            </div>
        </div>

                <!-- Service Options -->
                <div v-if="showServiceOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('serviceQuestion') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="service in serviceOptions"
                            :key="service.id"
                            @click="selectService(service)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <component :is="service.icon" class="w-4 h-4 text-blue-600" />
                                </div>
                                <div>
                                    <p class="font-medium text-sm text-gray-900">{{ service.name }}</p>
                                    <p class="text-xs text-gray-500">{{ service.description }}</p>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Project Goal Options -->
                <div v-if="showProjectGoalOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectProjectGoal') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="goal in projectGoalOptions"
                            :key="goal"
                            @click="selectProjectGoal(goal)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-xs md:text-sm text-gray-900">{{ goal }}</p>
                        </button>
                    </div>
                </div>

                <!-- Design Options -->
                <div v-if="showDesignOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectDesignStatus') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="design in designOptions"
                            :key="design"
                            @click="selectDesignStatus(design)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ design }}</p>
                        </button>
                    </div>
                </div>

                <!-- Integration Options -->
                <div v-if="showIntegrationOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectIntegration') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="integration in integrationOptions"
                            :key="integration"
                            @click="selectIntegration(integration)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ integration }}</p>
                        </button>
                    </div>
                </div>

                <!-- Timeline Options -->
                <div v-if="showTimelineOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectTimeline') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="timeline in timelineOptions"
                            :key="timeline"
                            @click="selectTimeline(timeline)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ timeline }}</p>
                        </button>
                    </div>
                </div>

                <!-- Budget Options -->
                <div v-if="showBudgetOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectBudget') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="budget in budgetOptions"
                            :key="budget"
                            @click="selectBudget(budget)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ budget }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Design Options -->
                <div v-if="showWebMobileDesignOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileDesign') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileDesignOptions"
                            :key="option"
                            @click="selectWebMobileDesign(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Integration Options -->
                <div v-if="showWebMobileIntegrationOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileIntegration') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileIntegrationOptions"
                            :key="option"
                            @click="selectWebMobileIntegration(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Content Options -->
                <div v-if="showWebMobileContentOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileContent') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileContentOptions"
                            :key="option"
                            @click="selectWebMobileContent(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Timeline Options -->
                <div v-if="showWebMobileTimelineOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileTimeline') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileTimelineOptions"
                            :key="option"
                            @click="selectWebMobileTimeline(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Budget Options -->
                <div v-if="showWebMobileBudgetOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileBudget') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileBudgetOptions"
                            :key="option"
                            @click="selectWebMobileBudget(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Web + Mobile Design Handling Options -->
                <div v-if="showWebMobileDesignHandlingOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectWebMobileDesignHandling') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in webMobileDesignHandlingOptions"
                            :key="option"
                            @click="selectWebMobileDesignHandling(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Consulting Type Options -->
                <div v-if="showConsultingTypeOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectConsultingType') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in consultingTypeOptions"
                            :key="option"
                            @click="selectConsultingType(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Consulting Project Options -->
                <div v-if="showConsultingProjectOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectConsultingProject') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in consultingProjectOptions"
                            :key="option"
                            @click="selectConsultingProject(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Consulting Session Options -->
                <div v-if="showConsultingSessionOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectConsultingSession') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in consultingSessionOptions"
                            :key="option"
                            @click="selectConsultingSession(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

                <!-- Consulting Budget Timeline Options -->
                <div v-if="showConsultingBudgetTimelineOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('selectConsultingBudgetTimeline') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="option in consultingBudgetTimelineOptions"
                            :key="option"
                            @click="selectConsultingBudgetTimeline(option)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ option }}</p>
                        </button>
                    </div>
                </div>

        <!-- Mobile Platform Options -->
        <div v-if="showMobilePlatformOptions" class="space-y-2">
            <div class="text-xs text-gray-500 text-center">{{ getText('mobilePlatformQuestion') }}</div>
            <div class="grid grid-cols-1 gap-2">
                <button
                    v-for="platform in mobilePlatformOptions"
                    :key="platform"
                    @click="selectMobilePlatform(platform)"
                    class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                >
                    <p class="font-medium text-sm text-gray-900">{{ platform }}</p>
                </button>
            </div>
        </div>


                <!-- Mobile Integration Options -->
                <div v-if="showMobileIntegrationOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('mobileIntegrationQuestion') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="integration in mobileIntegrationOptions"
                            :key="integration"
                            @click="selectMobileIntegration(integration)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ integration }}</p>
                        </button>
                    </div>
                </div>

                <!-- Mobile Design Options -->
                <div v-if="showMobileDesignOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('mobileDesignQuestion') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="design in mobileDesignOptions"
                            :key="design"
                            @click="selectMobileDesign(design)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ design }}</p>
                        </button>
                    </div>
                </div>

                <!-- Mobile Budget/Timeline Options -->
                <div v-if="showMobileBudgetTimelineOptions" class="space-y-2">
                    <div class="text-xs text-gray-500 text-center">{{ getText('mobileBudgetTimelineQuestion') }}</div>
                    <div class="grid grid-cols-1 gap-2">
                        <button
                            v-for="budgetTimeline in mobileBudgetTimelineOptions"
                            :key="budgetTimeline"
                            @click="selectMobileBudgetTimeline(budgetTimeline)"
                            class="bg-white border border-gray-200 rounded-xl p-2 md:p-3 text-left hover:bg-blue-50 hover:border-blue-300 transition-colors duration-200"
                        >
                            <p class="font-medium text-sm text-gray-900">{{ budgetTimeline }}</p>
                        </button>
                    </div>
                </div>

                <!-- Contact Form -->
                <div v-if="showContactForm" class="space-y-2 md:space-y-3">
                    <div class="bg-white border border-gray-200 rounded-xl p-3 md:p-4">
                        <div class="space-y-2 md:space-y-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">{{ getText('nameLabel') }}</label>
                                <input
                                    v-model="contactName"
                                    type="text"
                                    :placeholder="getText('namePlaceholder')"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-xs md:text-sm"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">{{ getText('emailLabel') }}</label>
                                <input
                                    v-model="contactEmail"
                                    type="email"
                                    :placeholder="getText('emailPlaceholder')"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-xs md:text-sm"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">{{ getText('phoneLabel') }}</label>
                                <input
                                    v-model="contactPhone"
                                    type="tel"
                                    :placeholder="getText('phonePlaceholder')"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-xs md:text-sm"
                                />
                            </div>
                            <button
                                @click="submitContactInfo"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 px-4 font-medium text-xs md:text-sm transition-colors duration-200"
                            >
                                {{ getText('submitButton') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Typing Indicator -->
                <div v-if="isTyping" class="flex justify-start">
                    <div class="bg-white rounded-2xl rounded-bl-md shadow-sm border px-4 py-3">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="p-3 md:p-4 border-t bg-white">
                <div class="flex space-x-2">
                    <input
                        v-model="userInput"
                        @keypress.enter="sendMessage"
                        :placeholder="getText('typeMessage')"
                        class="flex-1 px-3 py-2 md:px-4 md:py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-xs md:text-sm"
                        :disabled="isTyping"
                    />
                    <button
                        @click="sendMessage"
                        :disabled="!userInput.trim() || isTyping"
                        class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 text-white rounded-full p-2 md:p-2 transition-colors duration-200"
                    >
                        <Send class="w-3 h-3 md:w-4 md:h-4" />
                    </button>
                </div>

                <!-- Powered by iTab Solution -->
                <div class="text-center mt-3">
                    <p class="text-xs text-gray-400">{{ getText('poweredBy') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, nextTick } from 'vue'
import { MessageCircle, X, Send, Globe, Smartphone, Monitor, Users } from 'lucide-vue-next'
import { translations, type Language, type TranslationKey } from '@/translations'

interface Message {
    id: number
    text: string
    isUser: boolean
    timestamp: Date
}

interface ServiceOption {
    id: string
    name: string
    description: string
    icon: any
}

const isOpen = ref(false)
const isTyping = ref(false)
const showServiceOptions = ref(false)
const showProjectGoalOptions = ref(false)
const showDesignOptions = ref(false)
const showIntegrationOptions = ref(false)
const showTimelineOptions = ref(false)
const showBudgetOptions = ref(false)
const showContactForm = ref(false)

// Language selection
const showLanguageOptions = ref(false)
const selectedLanguage = ref('')

// Mobile app specific options
const showMobilePlatformOptions = ref(false)
const showMobileIntegrationOptions = ref(false)
const showMobileDesignOptions = ref(false)
const showMobileBudgetTimelineOptions = ref(false)

// Web + Mobile app specific
const showWebMobileDesignOptions = ref(false)
const showWebMobileIntegrationOptions = ref(false)
const showWebMobileContentOptions = ref(false)
const showWebMobileTimelineOptions = ref(false)
const showWebMobileBudgetOptions = ref(false)
const showWebMobileDesignHandlingOptions = ref(false)

// Consulting specific
const showConsultingTypeOptions = ref(false)
const showConsultingProjectOptions = ref(false)
const showConsultingSessionOptions = ref(false)
const showConsultingBudgetTimelineOptions = ref(false)
const userInput = ref('')
const messages = ref<Message[]>([])
const messagesContainer = ref<HTMLElement>()

// Contact form variables
const contactName = ref('')
const contactEmail = ref('')
const contactPhone = ref('')

// Session ID for tracking the conversation
const sessionId = ref('')

const serviceOptions = computed(() => [
    {
        id: 'web',
        name: getText('webApp'),
        description: getText('webAppDesc'),
        icon: Globe
    },
    {
        id: 'mobile',
        name: getText('mobileApp'),
        description: getText('mobileAppDesc'),
        icon: Smartphone
    },
    {
        id: 'web-mobile',
        name: getText('webMobileApp'),
        description: getText('webMobileAppDesc'),
        icon: Monitor
    },
    {
        id: 'consulting',
        name: getText('consulting'),
        description: getText('consultingDesc'),
        icon: Users
    }
])

const projectGoalOptions = computed(() => [
    getText('businessManagement'),
    getText('ecommerce'),
    getText('customerService'),
    getText('educational'),
    getText('healthcare'),
    getText('realEstate'),
    getText('socialMedia'),
    getText('other')
])

const designOptions = computed(() => [
    getText('yesDesign'),
    getText('noDesign')
])

const integrationOptions = computed(() => [
    getText('yesIntegration'),
    getText('noIntegration')
])

const timelineOptions = computed(() => [
    getText('timeline1to2'),
    getText('timeline3to4'),
    getText('timeline5to6'),
    getText('timeline7to12'),
    getText('timelineMoreThan1Year'),
    getText('timelineNotSure')
])

const budgetOptions = computed(() => [
    getText('budgetUnder5k'),
    getText('budget5kto10k'),
    getText('budget10kto25k'),
    getText('budget25kto50k'),
    getText('budget50kto100k'),
    getText('budgetOver100k'),
    getText('budgetDiscuss')
])

// Web + Mobile App Options
const webMobileDesignOptions = computed(() => [
    getText('sameDesign'),
    getText('differentDesign')
])

const webMobileIntegrationOptions = computed(() => [
    getText('yesExternalIntegration'),
    getText('noExternalIntegration')
])

const webMobileContentOptions = computed(() => [
    getText('contentReady'),
    getText('contentNotReady')
])

const webMobileTimelineOptions = computed(() => [
    getText('webMobileTimeline1to3'),
    getText('webMobileTimeline4to6'),
    getText('webMobileTimeline7to12'),
    getText('webMobileTimelineMoreThan1Year')
])

const webMobileBudgetOptions = computed(() => [
    getText('webMobileBudgetUnder10k'),
    getText('webMobileBudget10kto25k'),
    getText('webMobileBudget25kto50k'),
    getText('webMobileBudget50kto100k'),
    getText('webMobileBudgetOver100k'),
    getText('budgetFlexible')
])

const webMobileDesignHandlingOptions = computed(() => [
    getText('yesDesignHandling'),
    getText('noDesignHandling')
])

// Consulting Options
const consultingTypeOptions = computed(() => [
    getText('appDevelopment'),
    getText('digitalStrategy'),
    getText('performanceImprovement'),
    getText('technologyConsulting'),
    getText('systemArchitecture'),
    getText('securityConsulting'),
    getText('otherConsulting')
])

const consultingProjectOptions = computed(() => [
    getText('specificProject'),
    getText('generalAdvice')
])

const consultingSessionOptions = computed(() => [
    getText('oneTimeConsultation'),
    getText('ongoingSessions')
])

const consultingBudgetTimelineOptions = computed(() => [
    getText('budgetUnder5k'),
    getText('budget5kto10k'),
    getText('budget10kto25k'),
    getText('budget25kto50k'),
    getText('budget50kto100k'),
    getText('budgetOver100k'),
    getText('budgetDiscuss')
])

// Mobile app options
const mobilePlatformOptions = computed(() => [
    getText('iosOnly'),
    getText('androidOnly'),
    getText('bothPlatforms')
])


const mobileIntegrationOptions = computed(() => [
    getText('yesIntegration'),
    getText('noIntegration'),
    getText('maybeIntegration')
])

const mobileDesignOptions = computed(() => [
    getText('yesDesign'),
    getText('noDesign')
])

const mobileBudgetTimelineOptions = computed(() => [
    getText('budgetImportant'),
    getText('timelineImportant'),
    getText('bothImportant'),
    getText('notSure')
])

// Language options
const languageOptions = [
    { id: 'ar', name: 'العربية', flag: '🇪🇬' },
    { id: 'en', name: 'English', flag: '🇺🇸' }
]

// Text content based on language
const getText = (key: TranslationKey, params?: Record<string, string>) => {
    const language = selectedLanguage.value as Language
    let text = translations[language]?.[key] || translations.en[key] || key

    // Replace parameters in text
    if (params) {
        Object.entries(params).forEach(([paramKey, paramValue]) => {
            text = text.replace(`{${paramKey}}`, paramValue)
        })
    }

    return text
}

let messageId = 0

const addMessage = (text: string, isUser: boolean = false) => {
    messages.value.push({
        id: messageId++,
        text,
        isUser,
        timestamp: new Date()
    })
    // Scroll to bottom after adding message
    nextTick(() => {
        scrollToBottom()
    })
}

// Auto scroll when any option is selected
const scrollToLastMessage = () => {
    nextTick(() => {
        scrollToBottom()
    })
}

// Save response to database
const saveResponse = async (data: any) => {
    try {
        const response = await fetch('/chat/store-response', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                ...data,
                session_id: sessionId.value
            })
        })

        if (!response.ok) {
            console.error('Failed to save response')
        }
    } catch (error) {
        console.error('Error saving response:', error)
    }
}

const scrollToBottom = () => {
    if (messagesContainer.value) {
        messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight
    }
}

const formatTime = (date: Date) => {
    return date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    })
}

const openChat = () => {
    isOpen.value = true

    // Generate new session ID if not exists
    if (!sessionId.value) {
        sessionId.value = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9)
    }

    // If no messages yet, start the conversation immediately
    if (messages.value.length === 0) {
        setTimeout(() => {
            askLanguage()
        }, 500)
    }
}

const closeChat = () => {
    isOpen.value = false
}

const selectService = (service: ServiceOption) => {
    addMessage(getText('interestedIn', { service: service.name }), true)
    showServiceOptions.value = false

    // Save service selection
    saveResponse({ service_type: service.name })

        setTimeout(() => {
            isTyping.value = true
            setTimeout(() => {
                isTyping.value = false
                addMessage(getText('greatChoice', { service: service.name }))
                setTimeout(() => {
                    if (service.id === 'mobile') {
                        askMobilePlatform()
                    } else if (service.id === 'web-mobile') {
                        askWebMobileDesign()
                    } else if (service.id === 'consulting') {
                        askConsultingType()
                    } else {
                        askProjectGoal()
                    }
                }, 1500)
            }, 1500)
        }, 500)
}

const askProjectGoal = () => {
    addMessage(getText('projectGoalQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showProjectGoalOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askDesignStatus = () => {
    addMessage(getText('designStatusQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showDesignOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askIntegration = () => {
    addMessage(getText('integrationQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showIntegrationOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askTimeline = () => {
    addMessage(getText('timelineQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showTimelineOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askBudget = () => {
    addMessage(getText('budgetQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showBudgetOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askContactInfo = () => {
    addMessage(getText('contactInfoRequest'))
    scrollToLastMessage()
    setTimeout(() => {
        showContactForm.value = true
        scrollToLastMessage()
    }, 1000)
}

// Language selection
const askLanguage = () => {
    addMessage(getText('selectLanguage'))
    scrollToLastMessage()
    setTimeout(() => {
        showLanguageOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const selectLanguage = (language: any) => {
    selectedLanguage.value = language.id
    addMessage(`${language.flag} ${language.name}`, true)
    showLanguageOptions.value = false
    scrollToLastMessage()

    // Save language selection
    saveResponse({ language: language.id })

    setTimeout(() => {
        isTyping.value = true
        setTimeout(() => {
            isTyping.value = false
            addMessage(getText('welcome'))
            scrollToLastMessage()
            setTimeout(() => {
                addMessage(getText('serviceQuestion'))
                scrollToLastMessage()
                setTimeout(() => {
                    showServiceOptions.value = true
                    scrollToLastMessage()
                }, 1000)
            }, 1500)
        }, 1500)
    }, 500)
}

// Mobile app specific questions
const askMobilePlatform = () => {
    addMessage(getText('mobilePlatformQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showMobilePlatformOptions.value = true
        scrollToLastMessage()
    }, 1000)
}


const askMobileIntegration = () => {
    addMessage(getText('mobileIntegrationQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showMobileIntegrationOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askMobileDesign = () => {
    addMessage(getText('mobileDesignQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showMobileDesignOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askMobileBudgetTimeline = () => {
    addMessage(getText('mobileBudgetTimelineQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showMobileBudgetTimelineOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const submitContactInfo = () => {
    if (!contactName.value.trim() || !contactEmail.value.trim() || !contactPhone.value.trim()) {
        addMessage("Please fill in all fields", true)
        return
    }

    // Save contact information
    saveResponse({
        name: contactName.value,
        email: contactEmail.value,
        phone: contactPhone.value
    })

    addMessage(`Name: ${contactName.value}\nEmail: ${contactEmail.value}\nPhone: ${contactPhone.value}`, true)
    showContactForm.value = false
    scrollToLastMessage()

    setTimeout(() => {
        isTyping.value = true
        setTimeout(() => {
            isTyping.value = false
            addMessage(getText('perfect'))
        }, 1500)
    }, 1000)
}

const selectProjectGoal = (goal: string) => {
    addMessage(goal, true)
    showProjectGoalOptions.value = false
    scrollToLastMessage()

    // Save project goal
    saveResponse({ project_goal: goal })

    setTimeout(() => {
        askDesignStatus()
    }, 1000)
}

const selectDesignStatus = (status: string) => {
    addMessage(status, true)
    showDesignOptions.value = false
    scrollToLastMessage()

    // Save design status
    saveResponse({ design_status: status })

    setTimeout(() => {
        askIntegration()
    }, 1000)
}

const selectIntegration = (integration: string) => {
    addMessage(integration, true)
    showIntegrationOptions.value = false
    scrollToLastMessage()

    // Save integration status
    saveResponse({ integration_needed: integration })

    setTimeout(() => {
        askTimeline()
    }, 1000)
}

const selectTimeline = (timeline: string) => {
    addMessage(timeline, true)
    showTimelineOptions.value = false
    scrollToLastMessage()

    // Save timeline
    saveResponse({ timeline: timeline })

    setTimeout(() => {
        askBudget()
    }, 1000)
}

const selectBudget = (budget: string) => {
    addMessage(budget, true)
    showBudgetOptions.value = false
    scrollToLastMessage()

    // Save budget
    saveResponse({ budget: budget })

    setTimeout(() => {
        isTyping.value = true
        setTimeout(() => {
            isTyping.value = false
            addMessage(getText('perfect'))
            setTimeout(() => {
                askContactInfo()
            }, 1500)
        }, 1500)
    }, 1000)
}

// Mobile app response handlers
const selectMobilePlatform = (platform: string) => {
    addMessage(getText('mobilePlatformResponse', { platform }), true)
    showMobilePlatformOptions.value = false
    scrollToLastMessage()

    // Save mobile platform
    saveResponse({ mobile_platform: platform })

    setTimeout(() => {
        askMobileIntegration()
    }, 1000)
}


const selectMobileIntegration = (integration: string) => {
    addMessage(getText('mobileIntegrationResponse', { integration }), true)
    showMobileIntegrationOptions.value = false
    scrollToLastMessage()

    // Save mobile integration
    saveResponse({ mobile_integration: integration })

    setTimeout(() => {
        askMobileDesign()
    }, 1000)
}

const selectMobileDesign = (design: string) => {
    addMessage(getText('mobileDesignResponse', { design }), true)
    showMobileDesignOptions.value = false
    scrollToLastMessage()

    // Save mobile design handling
    saveResponse({ mobile_design_handling: design })

    setTimeout(() => {
        askMobileBudgetTimeline()
    }, 1000)
}

const selectMobileBudgetTimeline = (budgetTimeline: string) => {
    addMessage(getText('mobileBudgetTimelineResponse', { budgetTimeline }), true)
    showMobileBudgetTimelineOptions.value = false
    scrollToLastMessage()

    // Save mobile budget/timeline
    saveResponse({ mobile_budget_timeline: budgetTimeline })

    setTimeout(() => {
        isTyping.value = true
        setTimeout(() => {
            isTyping.value = false
            addMessage(getText('perfect'))
            setTimeout(() => {
                askContactInfo()
            }, 1500)
        }, 1500)
    }, 1000)
}

const sendMessage = () => {
    if (!userInput.value.trim()) return

    const userMessage = userInput.value
    addMessage(userMessage, true)

    // Save additional message
    saveResponse({ additional_message: userMessage })

    userInput.value = ''

    setTimeout(() => {
        isTyping.value = true
        setTimeout(() => {
            isTyping.value = false

            if (userMessage.toLowerCase().includes('hello') || userMessage.toLowerCase().includes('hi') || userMessage.toLowerCase().includes('hey')) {
                addMessage("Hello! Welcome to iTab! How can I help you today?")
                scrollToLastMessage()
                setTimeout(() => {
                    showServiceOptions.value = true
                    scrollToLastMessage()
                }, 1000)
            } else if (userMessage.toLowerCase().includes('service') || userMessage.toLowerCase().includes('help')) {
                addMessage("I'd be happy to help! What type of service are you looking for?")
                scrollToLastMessage()
                setTimeout(() => {
                    showServiceOptions.value = true
                    scrollToLastMessage()
                }, 1000)
            } else {
                addMessage("Thank you for your message! Our team will get back to you soon. In the meantime, feel free to explore our services.")
                scrollToLastMessage()
            }
        }, 1500)
    }, 500)
}

// Auto-open chat after 10 seconds
// Web + Mobile App Functions
const askWebMobileDesign = () => {
    addMessage(getText('webMobileDesignQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileDesignOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askWebMobileIntegration = () => {
    addMessage(getText('webMobileIntegrationQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileIntegrationOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askWebMobileContent = () => {
    addMessage(getText('webMobileContentQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileContentOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askWebMobileTimeline = () => {
    addMessage(getText('webMobileTimelineQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileTimelineOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askWebMobileBudget = () => {
    addMessage(getText('webMobileBudgetQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileBudgetOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askWebMobileDesignHandling = () => {
    addMessage(getText('webMobileDesignHandlingQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showWebMobileDesignHandlingOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const selectWebMobileDesign = (design: string) => {
    addMessage(getText('webMobileDesignResponse', { design }), true)
    showWebMobileDesignOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_design: design })

    setTimeout(() => {
        askWebMobileIntegration()
    }, 1000)
}

const selectWebMobileIntegration = (integration: string) => {
    addMessage(getText('webMobileIntegrationResponse', { integration }), true)
    showWebMobileIntegrationOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_integration: integration })

    setTimeout(() => {
        askWebMobileContent()
    }, 1000)
}

const selectWebMobileContent = (content: string) => {
    addMessage(getText('webMobileContentResponse', { content }), true)
    showWebMobileContentOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_content: content })

    setTimeout(() => {
        askWebMobileTimeline()
    }, 1000)
}

const selectWebMobileTimeline = (timeline: string) => {
    addMessage(getText('webMobileTimelineResponse', { timeline }), true)
    showWebMobileTimelineOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_timeline: timeline })

    setTimeout(() => {
        askWebMobileBudget()
    }, 1000)
}

const selectWebMobileBudget = (budget: string) => {
    addMessage(getText('webMobileBudgetResponse', { budget }), true)
    showWebMobileBudgetOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_budget: budget })

    setTimeout(() => {
        askWebMobileDesignHandling()
    }, 1000)
}

const selectWebMobileDesignHandling = (designHandling: string) => {
    addMessage(getText('webMobileDesignHandlingResponse', { designHandling }), true)
    showWebMobileDesignHandlingOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ web_mobile_design_handling: designHandling })

    setTimeout(() => {
        askContactInfo()
    }, 1000)
}

// Consulting Functions
const askConsultingType = () => {
    addMessage(getText('consultingTypeQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showConsultingTypeOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askConsultingProject = () => {
    addMessage(getText('consultingProjectQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showConsultingProjectOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askConsultingSession = () => {
    addMessage(getText('consultingSessionQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showConsultingSessionOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const askConsultingBudgetTimeline = () => {
    addMessage(getText('consultingBudgetTimelineQuestion'))
    scrollToLastMessage()
    setTimeout(() => {
        showConsultingBudgetTimelineOptions.value = true
        scrollToLastMessage()
    }, 1000)
}

const selectConsultingType = (type: string) => {
    addMessage(getText('consultingTypeResponse', { type }), true)
    showConsultingTypeOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ consulting_type: type })

    setTimeout(() => {
        askConsultingProject()
    }, 1000)
}

const selectConsultingProject = (project: string) => {
    addMessage(getText('consultingProjectResponse', { project }), true)
    showConsultingProjectOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ consulting_project: project })

    setTimeout(() => {
        askConsultingSession()
    }, 1000)
}

const selectConsultingSession = (session: string) => {
    addMessage(getText('consultingSessionResponse', { session }), true)
    showConsultingSessionOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ consulting_session: session })

    setTimeout(() => {
        askConsultingBudgetTimeline()
    }, 1000)
}

const selectConsultingBudgetTimeline = (budgetTimeline: string) => {
    addMessage(getText('consultingBudgetTimelineResponse', { budgetTimeline }), true)
    showConsultingBudgetTimelineOptions.value = false
    scrollToLastMessage()

    // Save response
    saveResponse({ consulting_budget_timeline: budgetTimeline })

    setTimeout(() => {
        askContactInfo()
    }, 1000)
}

onMounted(() => {
    // Generate session ID on component mount
    sessionId.value = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9)

    setTimeout(() => {
        if (!isOpen.value && messages.value.length === 0) {
            openChat()
        }
    }, 10000)
})
</script>

<style scoped>
/* Custom scrollbar */
.overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
