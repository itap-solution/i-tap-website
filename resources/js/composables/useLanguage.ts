import { ref, computed, onMounted } from 'vue'
import { translations, type Language, type TranslationKey } from '@/translations'

const currentLanguage = ref<Language>('ar')

export function useLanguage() {
    onMounted(() => {
        const savedLanguage = localStorage.getItem('preferred-language') as Language | null
        if (savedLanguage && (savedLanguage === 'ar' || savedLanguage === 'en')) {
            currentLanguage.value = savedLanguage
        } else {
            // Set default to Arabic if no saved language
            currentLanguage.value = 'ar'
            localStorage.setItem('preferred-language', 'ar')
        }
        
        // Set initial HTML attributes
        if (currentLanguage.value === 'ar') {
            document.documentElement.setAttribute('dir', 'rtl')
            document.documentElement.setAttribute('lang', 'ar')
        } else {
            document.documentElement.setAttribute('dir', 'ltr')
            document.documentElement.setAttribute('lang', 'en')
        }
    })

    function setLanguage(lang: Language) {
        currentLanguage.value = lang
        localStorage.setItem('preferred-language', lang)
        
        // Update HTML dir attribute for RTL support
        if (lang === 'ar') {
            document.documentElement.setAttribute('dir', 'rtl')
            document.documentElement.setAttribute('lang', 'ar')
        } else {
            document.documentElement.setAttribute('dir', 'ltr')
            document.documentElement.setAttribute('lang', 'en')
        }
    }

    function t(key: TranslationKey, params?: Record<string, string>): string {
        const lang = currentLanguage.value
        let text = translations[lang]?.[key] || translations.en[key] || key

        // Replace parameters in text
        if (params) {
            Object.entries(params).forEach(([paramKey, paramValue]) => {
                text = text.replace(`{${paramKey}}`, paramValue)
            })
        }

        return text
    }

    const isRTL = computed(() => currentLanguage.value === 'ar')

    return {
        currentLanguage: computed(() => currentLanguage.value),
        setLanguage,
        t,
        isRTL
    }
}

