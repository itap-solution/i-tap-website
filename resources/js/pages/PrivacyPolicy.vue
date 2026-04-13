<template>
    <Head :title="t('privacyMetaTitle')" />

    <NavBar logoSrc="/asset/logo-new-white.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <section class="py-16 px-4 bg-black border-b border-gray-800">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                    {{ t('privacyHeroTitle') }}
                </h1>
                <p class="text-gray-400 text-sm md:text-base">
                    {{ t('privacyUpdated') }}
                </p>
            </div>
        </section>

        <section class="py-16 px-4 bg-gray-50">
            <div class="max-w-4xl mx-auto space-y-12">
                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS1Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS1Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS2Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS2Intro') }}</p>
                    <ul class="list-disc ps-5 space-y-2 text-gray-600 leading-relaxed">
                        <li>{{ t('privacyS2a') }}</li>
                        <li>{{ t('privacyS2b') }}</li>
                        <li>{{ t('privacyS2c') }}</li>
                        <li>{{ t('privacyS2d') }}</li>
                    </ul>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS3Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS3Intro') }}</p>
                    <ul class="list-disc ps-5 space-y-2 text-gray-600 leading-relaxed">
                        <li>{{ t('privacyS3a') }}</li>
                        <li>{{ t('privacyS3b') }}</li>
                        <li>{{ t('privacyS3c') }}</li>
                        <li>{{ t('privacyS3d') }}</li>
                    </ul>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS4Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS4Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS5Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS5Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS6Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS6Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS7Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS7Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS8Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS8Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS9Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS9Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS10Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS10Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS11Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS11Text') }}</p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('privacyS12Title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ t('privacyS12Text') }}</p>
                    <p class="pt-2">
                        <Link href="/contact-us" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                            {{ t('navContact') }} →
                        </Link>
                    </p>
                </article>
            </div>
        </section>

        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 py-10">
                <div class="flex flex-col items-center justify-center gap-4 text-sm">
                    <Link href="/" class="text-gray-400 hover:text-white transition-colors">
                        {{ t('navHome') }}
                    </Link>
                    <div class="text-gray-500">
                        {{ t('footerCopyright') }}
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'

const { currentLanguage, t } = useLanguage()

watch(
    currentLanguage,
    (newLang) => {
        if (newLang === 'ar') {
            document.documentElement.setAttribute('dir', 'rtl')
            document.documentElement.setAttribute('lang', 'ar')
        } else {
            document.documentElement.setAttribute('dir', 'ltr')
            document.documentElement.setAttribute('lang', 'en')
        }
    },
    { immediate: true },
)
</script>
