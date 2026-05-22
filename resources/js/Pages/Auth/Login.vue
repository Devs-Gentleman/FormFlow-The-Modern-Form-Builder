<template>
    <Head title="Log in" />

    <!-- 1. Main Container: Centered Flex -->
    <div class="min-h-screen flex items-center justify-center font-sans text-[#111827] relative overflow-hidden p-4 bg-transparent">
        
        <!-- 2. Global Doodle Background -->
        <TallyBackground />

        <!-- 3. Floating Decorative Elements (Subtle animations around the card) -->
        <div class="absolute top-1/4 left-1/4 -translate-x-12 -translate-y-12 hidden lg:block animate-float-slow opacity-60 pointer-events-none">
            <svg class="w-24 h-24 text-gray-900 opacity-10" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="2"><path d="M40 160 Q 10 100 60 60 T 160 60" /></svg>
        </div>
        <div class="absolute bottom-1/4 right-1/4 translate-x-12 translate-y-12 hidden lg:block animate-float opacity-60 pointer-events-none">
            <svg class="w-16 h-16 text-gray-900 opacity-10" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"><circle cx="50" cy="50" r="40" stroke-dasharray="8 8"/></svg>
        </div>

        <!-- 4. THE LOGIN CARD -->
        <div class="w-full max-w-[420px] bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-white/60 relative z-10 overflow-hidden transition-all duration-300 hover:shadow-black/5">
            
            <!-- Top Gradient Line -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent opacity-50"></div>

            <div class="p-8 sm:p-10">
                
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <Link href="/" class="inline-flex items-center justify-center w-12 h-12 bg-black rounded-xl text-white font-bold text-xl shadow-lg shadow-black/10 mb-6 transition-transform hover:scale-105 hover:rotate-3">
                        F
                    </Link>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-gray-500 font-medium">Please enter your details to sign in.</p>
                </div>

                <!-- Social Logins -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white/50 hover:bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:border-gray-300 focus:ring-2 focus:ring-gray-100 transition-all shadow-sm group">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="currentColor"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/></svg>
                    </button>
                    <button class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white/50 hover:bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:border-gray-300 focus:ring-2 focus:ring-gray-100 transition-all shadow-sm group">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" /></svg>
                    </button>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="px-3 bg-white/80 backdrop-blur-md text-gray-400 font-bold tracking-widest">or</span>
                    </div>
                </div>

                <!-- Status Message (e.g., after password reset) -->
                <div v-if="status" class="mb-4 p-3 rounded-xl bg-green-50 border border-green-200 text-sm font-medium text-green-600 text-center">
                    {{ status }}
                </div>

                <!-- Main Form -->
                <form @submit.prevent="submit" class="space-y-5">
                    
                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            v-model="form.email" 
                            required 
                            autofocus 
                            class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                            placeholder="you@company.com"
                        />
                        <div v-if="form.errors.email" class="text-red-500 text-xs font-medium mt-1">{{ form.errors.email }}</div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide">Password</label>
                            <Link :href="route('password.request')" class="text-xs font-medium text-gray-500 hover:text-black transition-colors">
                                Forgot?
                            </Link>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            v-model="form.password" 
                            required 
                            autocomplete="current-password" 
                            class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                            placeholder="••••••••"
                        />
                        <div v-if="form.errors.password" class="text-red-500 text-xs font-medium mt-1">{{ form.errors.password }}</div>
                    </div>

                    <!-- Remember Me & Submit -->
                    <div class="pt-2 space-y-4">
                        <div class="flex items-center">
                            <input 
                                id="remember-me" 
                                type="checkbox" 
                                v-model="form.remember" 
                                class="h-4 w-4 rounded border-gray-300 text-black focus:ring-black cursor-pointer bg-white/50"
                            />
                            <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">Remember me</label>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-black py-3.5 px-4 text-sm font-bold text-white shadow-lg shadow-black/10 hover:bg-gray-900 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Signing in...</span>
                            <span v-else>Sign In</span>
                            <svg v-if="!form.processing" class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>

                </form>

                <!-- Footer -->
                <p class="text-center text-sm text-gray-500 mt-8">
                    Don't have an account?
                    <Link :href="route('register')" class="font-semibold text-black hover:underline transition-all">Sign up free</Link>
                </p>

            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TallyBackground from '@/Components/TallyBackground.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
@keyframes float-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}
.animate-float {
    animation: float 5s ease-in-out infinite;
}
.animate-float-slow {
    animation: float-slow 7s ease-in-out infinite;
}
</style>