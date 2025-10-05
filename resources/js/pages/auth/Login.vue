<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { LoaderCircle, Mail, Lock, Eye, EyeOff } from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login" />

    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <Card class="w-full max-w-md">
            <CardHeader class="text-center space-y-2">
                <CardTitle class="text-2xl font-bold">Login</CardTitle>
                <CardDescription>
                    Enter your credentials to access your account
                </CardDescription>
            </CardHeader>

            <CardContent class="space-y-4">
                <!-- Status Message -->
                <div v-if="status" class="p-3 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-sm text-green-600 text-center">{{ status }}</p>
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <Label for="email" class="text-sm font-medium">Email Address</Label>
                        <div class="relative">
                            <Mail class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
                            <Input
                                id="email"
                                type="email"
                                required
                                autofocus
                                autocomplete="email"
                                v-model="form.email"
                                placeholder="Enter your email"
                                class="pl-10"
                            />
                        </div>
                        <InputError :message="form.errors.email" />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <Label for="password" class="text-sm font-medium">Password</Label>
                            <TextLink
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs text-blue-600 hover:text-blue-500"
                            >
                                Forgot password?
                            </TextLink>
                        </div>
                        <div class="relative">
                            <Lock class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
                            <Input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="current-password"
                                v-model="form.password"
                                placeholder="Enter your password"
                                class="pl-10 pr-10"
                            />
                            <button
                                type="button"
                                @click="togglePassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <Eye v-if="!showPassword" class="w-4 h-4" />
                                <EyeOff v-else class="w-4 h-4" />
                            </button>
                        </div>
                        <InputError :message="form.errors.password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center space-x-2">
                        <Checkbox
                            id="remember"
                            v-model="form.remember"
                        />
                        <Label for="remember" class="text-sm text-gray-600">Remember me</Label>
                    </div>

                    <!-- Submit Button -->
                    <Button
                        type="submit"
                        class="w-full"
                        :disabled="form.processing"
                    >
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                        {{ form.processing ? 'Signing in...' : 'Sign In' }}
                    </Button>
                </form>

                <!-- Sign Up Link -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <TextLink
                            :href="route('register')"
                            class="text-blue-600 hover:text-blue-500 font-medium"
                        >
                            Create account
                        </TextLink>
                    </p>
                </div>

                <!-- Back to Home -->
                <div class="text-center">
                    <Link
                        :href="route('home')"
                        class="text-sm text-gray-500 hover:text-gray-700"
                    >
                        Back to Home
                    </Link>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
