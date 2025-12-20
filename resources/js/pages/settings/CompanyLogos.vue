<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Trash2, Upload, Image as ImageIcon } from 'lucide-vue-next';

interface Logo {
    id: number;
    logo_path: string;
    logo_url: string;
    original_name: string | null;
    order: number;
}

interface Props {
    logos: Logo[];
}

const props = defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Company Logos',
        href: '/settings/company-logos',
    },
];

const fileInputRef = ref<HTMLInputElement | null>(null);
const selectedFiles = ref<File[]>([]);
const previewUrls = ref<string[]>([]);
const isUploading = ref(false);

const handleFileSelect = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        selectedFiles.value = Array.from(target.files);
        previewUrls.value = selectedFiles.value.map(file => URL.createObjectURL(file));
    }
};

const removePreview = (index: number) => {
    URL.revokeObjectURL(previewUrls.value[index]);
    selectedFiles.value.splice(index, 1);
    previewUrls.value.splice(index, 1);
    
    // Reset file input
    if (fileInputRef.value) {
        fileInputRef.value.value = '';
    }
};

const submit = () => {
    if (selectedFiles.value.length === 0) {
        return;
    }

    isUploading.value = true;
    const formData = new FormData();
    selectedFiles.value.forEach((file: File) => {
        formData.append('logos[]', file);
    });

    router.post(route('company-logos.store'), formData, {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            selectedFiles.value = [];
            previewUrls.value.forEach(url => URL.revokeObjectURL(url));
            previewUrls.value = [];
            if (fileInputRef.value) {
                fileInputRef.value.value = '';
            }
            isUploading.value = false;
        },
        onError: () => {
            isUploading.value = false;
        },
    });
};

const deleteLogo = (logoId: number) => {
    if (confirm('Are you sure you want to delete this logo?')) {
        router.delete(route('company-logos.destroy', logoId), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Company Logos Settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall 
                    title="Company Logos" 
                    description="Upload and manage company logos" 
                />

                <!-- Upload Form -->
                <div class="space-y-4">
                    <div>
                        <Label for="logos">Upload Logos</Label>
                        <div class="mt-2">
                            <input
                                ref="fileInputRef"
                                id="logos"
                                type="file"
                                multiple
                                accept="image/*"
                                @change="handleFileSelect"
                                class="hidden"
                            />
                            <div class="flex items-center gap-4">
                                <Button
                                    type="button"
                                    variant="outline"
                                    @click="fileInputRef?.click()"
                                    class="flex items-center gap-2"
                                >
                                    <Upload class="w-4 h-4" />
                                    Choose Files
                                </Button>
                                <span v-if="selectedFiles.length > 0" class="text-sm text-gray-600">
                                    {{ selectedFiles.length }} file(s) selected
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Selected Files -->
                    <div v-if="previewUrls.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <div
                            v-for="(url, index) in previewUrls"
                            :key="index"
                            class="relative group"
                        >
                            <img
                                :src="url"
                                :alt="selectedFiles[index]?.name"
                                class="w-full h-32 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50"
                            />
                            <button
                                @click="removePreview(index)"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                            >
                                <Trash2 class="w-4 h-4" />
                            </button>
                            <p class="text-xs text-gray-500 mt-1 truncate">
                                {{ selectedFiles[index]?.name }}
                            </p>
                        </div>
                    </div>

                    <Button
                        @click="submit"
                        :disabled="isUploading || selectedFiles.length === 0"
                        class="flex items-center gap-2"
                    >
                        <Upload class="w-4 h-4" />
                        <span v-if="isUploading">Uploading...</span>
                        <span v-else>Upload Logos</span>
                    </Button>
                </div>

                <!-- Existing Logos -->
                <div v-if="props.logos.length > 0" class="space-y-4">
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold mb-4">Uploaded Logos</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div
                                v-for="logo in props.logos"
                                :key="logo.id"
                                class="relative group"
                            >
                                <img
                                    :src="logo.logo_url"
                                    :alt="logo.original_name || 'Company Logo'"
                                    class="w-full h-32 object-contain border border-gray-200 rounded-lg p-2 bg-gray-50"
                                />
                                <button
                                    @click="deleteLogo(logo.id)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                >
                                    <Trash2 class="w-4 h-4" />
                                </button>
                                <p v-if="logo.original_name" class="text-xs text-gray-500 mt-1 truncate">
                                    {{ logo.original_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-12 border border-dashed border-gray-300 rounded-lg">
                    <ImageIcon class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                    <p class="text-gray-500">No logos uploaded yet</p>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

