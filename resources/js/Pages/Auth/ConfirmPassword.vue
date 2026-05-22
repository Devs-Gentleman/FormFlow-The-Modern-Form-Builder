<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TallyBackground from '@/Components/TallyBackground.vue';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Confirm Password" />

    <div class="min-h-screen flex items-center justify-center font-sans text-[#111827] relative overflow-hidden p-4 bg-transparent">
        <TallyBackground />

        <div class="w-full max-w-[420px] bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-white/60 relative z-10 overflow-hidden transition-all duration-300 hover:shadow-black/5">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent opacity-50"></div>

            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <Link href="/" class="inline-flex items-center justify-center w-12 h-12 bg-black rounded-xl text-white font-bold text-xl shadow-lg shadow-black/10 mb-6 transition-transform hover:scale-105 hover:rotate-3">
                        F
                    </Link>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Confirm password</h2>
                    <p class="mt-2 text-sm text-gray-500 font-medium">This is a secure area. Please confirm your password before continuing.</p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            v-model="form.password" 
                            required 
                            autofocus
                            autocomplete="current-password"
                            class="block w-full rounded-xl border-gray-200 bg-white/50 text-gray-900 shadow-sm focus:bg-white focus:border-black focus:ring-black sm:text-sm px-4 py-3 transition-all placeholder-gray-400"
                            placeholder="••••••••"
                        />
                        <div v-if="form.errors.password" class="text-red-500 text-xs font-medium mt-1">{{ form.errors.password }}</div>
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-black py-3.5 px-4 text-sm font-bold text-white shadow-lg shadow-black/10 hover:bg-gray-900 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Confirming...</span>
                            <span v-else>Confirm</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
