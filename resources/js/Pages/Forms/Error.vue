<template>
    <div class="min-h-screen bg-[#F5F5F7] flex flex-col justify-center items-center p-6 text-center font-sans">
        <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-200 max-w-md w-full">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ title }}</h1>
            <p class="text-gray-500 mb-8">{{ message }}</p>
            <a href="/" class="text-black font-bold border-b border-black hover:border-gray-400 transition-all pb-0.5">
                Go to Homepage
            </a>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    message: String
});
</script>