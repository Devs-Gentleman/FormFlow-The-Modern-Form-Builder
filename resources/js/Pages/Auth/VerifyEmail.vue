<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TallyBackground from '@/Components/TallyBackground.vue';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Head title="Email Verification" />

    <div class="min-h-screen flex items-center justify-center font-sans text-[#111827] relative overflow-hidden p-4 bg-transparent">
        <TallyBackground />

        <div class="w-full max-w-[420px] bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-white/60 relative z-10 overflow-hidden transition-all duration-300 hover:shadow-black/5">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent opacity-50"></div>

            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <Link href="/" class="inline-flex items-center justify-center w-12 h-12 bg-black rounded-xl text-white font-bold text-xl shadow-lg shadow-black/10 mb-6 transition-transform hover:scale-105 hover:rotate-3">
                        F
                    </Link>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Verify your email</h2>
                    <p class="mt-2 text-sm text-gray-500 font-medium">Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you.</p>
                </div>

                <div v-if="verificationLinkSent" class="mb-6 p-3 rounded-xl bg-green-50 border border-green-200 text-sm font-medium text-green-600 text-center">
                    A new verification link has been sent to your email address.
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div class="pt-2 flex flex-col gap-3">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-black py-3.5 px-4 text-sm font-bold text-white shadow-lg shadow-black/10 hover:bg-gray-900 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Sending...</span>
                            <span v-else>Resend Verification Email</span>
                        </button>

                        <Link 
                            :href="route('logout')" 
                            method="post" 
                            as="button"
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-white border border-gray-200 py-3.5 px-4 text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all"
                        >
                            Log Out
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
