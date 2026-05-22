<template>
    <Head title="FormFlow - The modern form builder" />

    <div class="min-h-screen bg-white text-gray-900 font-sans relative overflow-x-hidden selection:bg-black selection:text-white">
        
        <!-- ========================================== -->
        <!-- BACKGROUND DOODLES (Subtle Flow Theme) -->
        <!-- ========================================== -->
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <!-- 1. Top Left: Looping Arrow -->
            <svg class="absolute top-32 left-[5%] w-64 h-64 text-gray-100 opacity-60 transform -rotate-12 animate-float-slow" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M40 160 Q 10 100 60 60 T 160 60" />
                <path d="M150 50 L 160 60 L 150 70" />
            </svg>

            <!-- 2. Top Right: Paper Plane -->
            <svg class="absolute top-24 right-[8%] w-40 h-40 text-gray-100 opacity-80 transform rotate-12 animate-float" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10 50 L 90 20 L 50 90 L 40 60 L 10 50 Z" />
                <path d="M40 60 L 90 20" />
            </svg>

            <!-- 3. Bottom Left: Abstract Shapes -->
            <svg class="absolute bottom-20 left-[10%] w-32 h-32 text-gray-100 opacity-60" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="50" cy="50" r="40" stroke-dasharray="8 8"/>
                <path d="M50 20 L 50 80 M 20 50 L 80 50" />
            </svg>

            <!-- 4. Bottom Right: Sparkle -->
            <svg class="absolute bottom-32 right-[5%] w-48 h-48 text-gray-100 opacity-60 transform rotate-6" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M100 50 L 100 20 M 100 180 L 100 150 M 50 100 L 20 100 M 180 100 L 150 100" />
                <path d="M65 65 L 45 45 M 135 135 L 155 155 M 65 135 L 45 155 M 135 65 L 155 45" />
            </svg>
        </div>

        <!-- ========================================== -->
        <!-- NAVBAR -->
        <!-- ========================================== -->
        <nav class="relative z-20 px-6 py-6 max-w-7xl mx-auto flex justify-between items-center">
            <!-- Brand -->
            <div class="flex items-center gap-2 group cursor-pointer">
                <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center text-white shadow-md transition-transform group-hover:rotate-3 border border-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
                <span class="font-bold text-lg tracking-tight text-gray-900">FormFlow</span>
            </div>

            <!-- Auth -->
            <div v-if="canLogin" class="flex items-center gap-6">
                <Link 
                    v-if="$page.props.auth.user" 
                    :href="route('dashboard')"
                    class="font-medium text-sm text-gray-500 hover:text-black transition-colors"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link 
                        :href="route('login')"
                        class="font-medium text-sm text-gray-500 hover:text-black transition-colors"
                    >
                        Log in
                    </Link>

                    <Link 
                        :href="route('register')"
                        class="hidden sm:inline-flex px-5 py-2.5 bg-black text-white font-semibold text-sm rounded-full hover:bg-gray-800 transition-all shadow-sm hover:shadow-md"
                    >
                        Sign up free
                    </Link>
                </template>
            </div>
        </nav>

        <!-- ========================================== -->
        <!-- HERO SECTION -->
        <!-- ========================================== -->
        <main class="relative z-10 max-w-6xl mx-auto px-6 pt-24 pb-24 text-center">
            
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-50 border border-gray-200 text-gray-600 text-[11px] font-bold uppercase tracking-widest mb-8 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                FormFlow 1.0
            </div>

            <!-- Headline -->
            <h1 class="text-5xl sm:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-[1.1]">
                Forms that feel like <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-violet-600">
                    a conversation.
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed font-light">
                The simplest way to create forms, surveys, and quizzes.
                <br class="hidden sm:block" />
                Just type, drag, and publish. <span class="text-gray-900 font-medium">No code required.</span>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-24">
                <Link 
                    :href="route('register')"
                    class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white transition-all duration-200 bg-black rounded-full hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 shadow-lg hover:shadow-xl hover:-translate-y-0.5 w-full sm:w-auto"
                >
                    Create a form
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </Link>
                <a href="#" class="px-8 py-3.5 text-base font-medium text-gray-500 hover:text-black transition-colors flex items-center gap-2">
                    See examples
                </a>
            </div>

            <!-- Main Interface Mockup -->
            <div class="relative mx-auto w-full max-w-4xl transition-transform hover:scale-[1.01] duration-700">
                
                <!-- Floating Elements (Subtle) -->
                <div class="absolute -top-6 -right-12 bg-white p-3 rounded-xl shadow-lg border border-gray-100 hidden lg:flex items-center gap-3 animate-float z-20">
                    <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600 text-xs font-bold">✓</div>
                    <div class="text-xs font-bold text-gray-800 pr-2">Saved</div>
                </div>

                <div class="bg-white rounded-2xl shadow-2xl shadow-gray-200/50 border border-gray-200 overflow-hidden relative z-10">
                    <!-- Browser Bar -->
                    <div class="bg-white px-5 py-4 border-b border-gray-100 flex items-center gap-4">
                        <div class="flex gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-200"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-200"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-200"></div>
                        </div>
                        <div class="flex-1 bg-gray-50 h-6 rounded-md mx-4 max-w-[200px]"></div>
                    </div>
                    <!-- Form Content -->
                    <div class="p-12 md:p-16 text-left bg-white">
                        <div class="max-w-lg mx-auto space-y-12">
                            <!-- Question 1 -->
                            <div class="space-y-4">
                                <label class="block text-2xl font-bold text-gray-900">1. Hey! What's your name?</label>
                                <input type="text" class="block w-full border-0 border-b-2 border-gray-100 focus:border-black focus:ring-0 text-2xl px-0 py-2 placeholder-gray-200 transition-colors bg-transparent" placeholder="Type here..." readonly>
                            </div>
                            <!-- Question 2 -->
                            <div class="space-y-4">
                                <label class="block text-2xl font-bold text-gray-900">2. How can we help you?</label>
                                <div class="flex flex-wrap gap-3">
                                    <div class="px-5 py-3 rounded-xl border border-gray-200 text-gray-500 font-medium hover:border-black hover:text-black cursor-pointer transition-all">Project</div>
                                    <div class="px-5 py-3 rounded-xl border-2 border-black bg-black text-white font-medium shadow-md">Hiring</div>
                                    <div class="px-5 py-3 rounded-xl border border-gray-200 text-gray-500 font-medium hover:border-black hover:text-black cursor-pointer transition-all">Support</div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button class="bg-black text-white px-6 py-3 rounded-lg font-bold text-sm shadow-md">Submit →</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- ========================================== -->
        <!-- FEATURES TRIO -->
        <!-- ========================================== -->
        <section class="relative z-10 max-w-6xl mx-auto px-6 py-24 border-t border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <!-- Feature 1 -->
                <div class="group">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-xl mb-4 text-gray-900 mx-auto md:mx-0 group-hover:scale-110 transition-transform duration-300">
                        ✨
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Simplicity First</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">No complex drag-and-drop. Just simple, intuitive controls that stay out of your way.</p>
                </div>
                <!-- Feature 2 -->
                <div class="group">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-xl mb-4 text-gray-900 mx-auto md:mx-0 group-hover:scale-110 transition-transform duration-300">
                        🚀
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Share Anywhere</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">Embed your forms in your website, documentation, or share as a standalone link.</p>
                </div>
                <!-- Feature 3 -->
                <div class="group">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-xl mb-4 text-gray-900 mx-auto md:mx-0 group-hover:scale-110 transition-transform duration-300">
                        📊
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Instant Analytics</h3>
                    <p class="text-gray-500 leading-relaxed text-sm">Get insights the moment a user submits. Export data or connect to your tools.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 text-center relative z-10 bg-white border-t border-gray-100">
            <div class="flex justify-center items-center gap-8 mb-8 font-medium text-sm">
                <a href="#" class="text-gray-500 hover:text-black transition-colors">Twitter</a>
                <a href="#" class="text-gray-500 hover:text-black transition-colors">GitHub</a>
                <a href="#" class="text-gray-500 hover:text-black transition-colors">Login</a>
            </div>
            <p class="text-xs text-gray-400">&copy; 2025 FormFlow.</p>
        </footer>

    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0) rotate(12deg); }
    50% { transform: translateY(-10px) rotate(10deg); }
}
@keyframes float-slow {
    0%, 100% { transform: translateY(0) rotate(-12deg); }
    50% { transform: translateY(-15px) rotate(-14deg); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}
.animate-float-slow {
    animation: float-slow 8s ease-in-out infinite;
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}
</style>