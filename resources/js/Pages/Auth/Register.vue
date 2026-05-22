<template>
    <Head title="Register" />

    <!-- 1. Main Container: Centered Flex -->
    <div class="min-h-screen flex items-center justify-center font-sans text-[#111827] relative overflow-hidden p-4 sm:p-6 bg-transparent">
        
        <!-- 2. Global Doodle Background -->
        <TallyBackground />

        <!-- 3. THE WIDE CARD: Centered, Rounded, Shadowed -->
        <div class="w-full max-w-2xl bg-white/85 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-white/60 relative z-10 overflow-hidden transition-all duration-300">
            
            <!-- Top Gradient Line -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent opacity-50"></div>

            <div class="p-8 sm:p-12">
                
                <!-- Header -->
                <div class="text-center mb-10">
                    <Link href="/" class="inline-flex items-center justify-center w-12 h-12 bg-black rounded-xl text-white font-bold text-xl shadow-lg shadow-black/10 mb-6 transition-transform hover:scale-105 hover:rotate-3">
                        F
                    </Link>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Create an account</h2>
                    <p class="mt-2 text-sm text-gray-500 font-medium">
                        Already have an account? 
                        <Link :href="route('login')" class="font-bold text-black hover:underline transition-colors">Log in</Link>
                    </p>
                </div>

                <!-- Social Logins -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/></svg>
                        Google
                    </button>
                    <button class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" /></svg>
                        GitHub
                    </button>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="px-2 bg-white text-gray-400 font-medium tracking-wider">Or with email</span>
                    </div>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="space-y-4">
                    
                    <!-- Row 1: Name & Email Side-by-Side -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Full Name</label>
                            <input 
                                id="name" 
                                type="text" 
                                v-model="form.name" 
                                required 
                                autofocus 
                                class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                                placeholder="John Doe"
                            />
                            <div v-if="form.errors.name" class="text-red-500 text-xs mt-1 font-medium">{{ form.errors.name }}</div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Email Address</label>
                            <input 
                                id="email" 
                                type="email" 
                                v-model="form.email" 
                                required 
                                class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                                placeholder="you@company.com"
                            />
                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1 font-medium">{{ form.errors.email }}</div>
                        </div>
                    </div>

                    <!-- Row 2: Password & Confirm Side-by-Side -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Password</label>
                            <input 
                                id="password" 
                                type="password" 
                                v-model="form.password" 
                                required 
                                class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                                placeholder="••••••••"
                            />
                            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1 font-medium">{{ form.errors.password }}</div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Confirm</label>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                v-model="form.password_confirmation" 
                                required 
                                class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>

                    <!-- Submit Button (Full Width) -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="flex w-full justify-center items-center gap-2 rounded-xl bg-black py-4 px-6 text-sm font-bold text-white shadow-xl shadow-black/10 hover:bg-gray-900 hover:shadow-2xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Creating account...</span>
                            <span v-else>Create Account &rarr;</span>
                        </button>
                    </div>

                </form>

                <p class="text-center text-xs text-gray-400 mt-8">
                    By signing up, you agree to our Terms and Privacy Policy.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TallyBackground from '@/Components/TallyBackground.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>