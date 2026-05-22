<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2>
                <Link 
                    :href="route('forms.create')" 
                    class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm inline-flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    New Form
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
            <!-- Decorative doodle elements -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <!-- Top left doodle -->
                <svg class="absolute top-20 left-10 w-24 h-24 text-blue-200 opacity-40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 50 Q30 20, 50 30 T80 50" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="50" cy="50" r="8" fill="currentColor"/>
                </svg>
                
                <!-- Top right doodle -->
                <svg class="absolute top-40 right-20 w-32 h-32 text-purple-200 opacity-30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30 70 Q50 30, 70 70" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M25 50 L35 45 L30 55 Z" fill="currentColor"/>
                </svg>
                
                <!-- Bottom left curved line -->
                <svg class="absolute bottom-32 left-1/4 w-40 h-20 text-green-200 opacity-35" viewBox="0 0 100 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 25 Q30 10, 50 25 T90 25" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                
                <!-- Right side star -->
                <svg class="absolute top-1/3 right-10 w-16 h-16 text-orange-200 opacity-40" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25 5 L28 20 L42 20 L31 28 L35 42 L25 34 L15 42 L19 28 L8 20 L22 20 Z" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                
                <!-- Bottom right checkmark -->
                <svg class="absolute bottom-20 right-1/4 w-20 h-20 text-blue-300 opacity-35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 25 L20 35 L40 15" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                
                <!-- Middle left circle -->
                <svg class="absolute top-1/2 left-16 w-12 h-12 text-purple-300 opacity-30" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="25" cy="25" r="20" stroke="currentColor" stroke-width="2.5"/>
                    <circle cx="25" cy="25" r="10" fill="currentColor" opacity="0.3"/>
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
                
                <!-- Welcome Section -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-violet-600">{{ $page.props.auth.user.name.split(' ')[0] }}</span></h1>
                    <p class="text-gray-600 mt-1">Here's what's happening with your forms</p>
                </div>
                
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div class="bg-white rounded-xl p-7 border border-gray-200 hover:border-gray-300 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-sm font-medium text-gray-600">Total Forms</div>
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ totalForms || 0 }}</div>
                    </div>

                    <div class="bg-white rounded-xl p-7 border border-gray-200 hover:border-gray-300 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-sm font-medium text-gray-600">Total Responses</div>
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ totalResponses || 0 }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Recent Forms -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">Recent Forms</h3>
                                <Link :href="route('forms.index')" class="text-sm text-gray-600 hover:text-gray-900 font-medium">View all →</Link>
                            </div>

                            <!-- Empty State -->
                            <div v-if="!recentActivity || recentActivity.length === 0" class="py-12 flex flex-col items-center justify-center text-center rounded-lg border border-gray-200 bg-white">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                </div>
                                <h3 class="text-gray-900 font-semibold mb-1">No forms yet</h3>
                                <p class="text-gray-600 text-sm mb-4">Create your first form to get started</p>
                                <Link :href="route('forms.create')" class="text-sm font-medium text-gray-700 hover:text-gray-900 border-b border-gray-700">
                                    Create form →
                                </Link>
                            </div>

                            <!-- Form Cards - Optimized Grid -->
                            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="form in recentActivity" :key="form.id" class="group relative overflow-hidden rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all bg-white">
                                    <!-- Top accent bar -->
                                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-gray-800 to-gray-600"></div>
                                    
                                    <div class="p-4">
                                        <!-- Header -->
                                        <div class="mb-3">
                                            <h4 class="font-semibold text-gray-900 truncate text-sm">{{ form.title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ new Date(form.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) }}</p>
                                        </div>
                                        
                                        <!-- Quick Stats Row -->
                                        <div class="flex items-center gap-3 mb-4 py-2 border-y border-gray-100">
                                            <div class="text-center flex-1 min-w-0">
                                                <div class="text-lg font-bold text-gray-900">0</div>
                                                <div class="text-xs text-gray-500">Responses</div>
                                            </div>
                                            <div class="w-px h-8 bg-gray-200"></div>
                                            <div class="text-center flex-1 min-w-0">
                                                <div class="text-lg font-bold text-gray-900">0%</div>
                                                <div class="text-xs text-gray-500">Complete</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="flex items-center gap-2">
                                            <Link 
                                                :href="route('forms.results', form.id)" 
                                                class="flex-1 text-center text-xs font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 px-2 py-1.5 rounded transition-colors"
                                            >
                                                Results
                                            </Link>
                                            <a 
                                                :href="form.public_link ? `/form/${form.public_link}` : '#'" 
                                                target="_blank" 
                                                class="flex-1 text-center text-xs font-medium text-white bg-black hover:bg-gray-800 px-2 py-1.5 rounded transition-colors inline-flex items-center justify-center gap-1"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                                Open
                                            </a>
                                            <button 
                                                @click="deleteForm(form.id)"
                                                class="text-xs font-medium text-red-600 hover:text-red-700 hover:bg-red-50 px-2 py-1.5 rounded transition-colors"
                                                title="Delete form"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

 <!-- Quick Stats Visual -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7 relative overflow-hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">This Week</h3>
                            
                            <!-- Visual stats bars -->
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-600">Forms Created</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ totalForms || 0 }}</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-gray-900 rounded-full transition-all duration-500" :style="{ width: totalForms > 0 ? '70%' : '5%' }"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-600">Responses</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ totalResponses || 0 }}</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-gray-700 rounded-full transition-all duration-500" :style="{ width: totalResponses > 0 ? '85%' : '5%' }"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-gray-600">Views</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ (totalResponses * 3) || 0 }}</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden mb-8">
                                        <div class="h-full bg-gray-500 rounded-full transition-all duration-500" :style="{ width: totalResponses > 0 ? '60%' : '5%' }"></div>
                                    </div>
                                </div>
                            </div>
                            
                        <!-- Templates -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Start with a template</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <Link :href="route('forms.create')" class="group relative overflow-hidden bg-white border-2 border-purple-200 rounded-lg p-4 hover:border-purple-300 hover:shadow-md cursor-pointer transition-all">
                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                        </div>
                                        <h4 class="font-semibold text-sm text-gray-900 mb-1">Feedback</h4>
                                        <p class="text-xs text-gray-600">Customer satisfaction</p>
                                    </div>
                                </Link>
                                <Link :href="route('forms.create')" class="group relative overflow-hidden bg-white border-2 border-blue-200 rounded-lg p-4 hover:border-blue-300 hover:shadow-md cursor-pointer transition-all">
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                        </div>
                                        <h4 class="font-semibold text-sm text-gray-900 mb-1">Registration</h4>
                                        <p class="text-xs text-gray-600">Event signups</p>
                                    </div>
                                </Link>
                                <Link :href="route('forms.create')" class="group relative overflow-hidden bg-white border-2 border-green-200 rounded-lg p-4 hover:border-green-300 hover:shadow-md cursor-pointer transition-all">
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                        </div>
                                        <h4 class="font-semibold text-sm text-gray-900 mb-1">Application</h4>
                                        <p class="text-xs text-gray-600">Job candidates</p>
                                    </div>
                                </Link>
                            </div>
                        </div>

                       
                            
                            <!-- Decorative corner element -->
                            <div class="absolute -bottom-6 -right-6 w-24 h-24 opacity-5">
                                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8" class="text-blue-600"/>
                                    <path d="M50 10 L50 50 L90 50" stroke="currentColor" stroke-width="8" stroke-linecap="round" class="text-purple-600"/>
                                </svg>
                            </div>
                            
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-500">Keep going! You're building something great 🚀</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        
                        <!-- Profile Card -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-full bg-gray-900 text-white flex items-center justify-center font-semibold text-sm">
                                    {{ $page.props.auth.user.name.charAt(0) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-sm text-gray-900 truncate">{{ $page.props.auth.user.name }}</div>
                                    <div class="text-xs text-gray-600 truncate">{{ $page.props.auth.user.email }}</div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                        </div>
                                        <div>
                                            <div class="text-xs font-semibold text-gray-900">Active Plan</div>
                                            <div class="text-xs text-gray-600">Free Tier</div>
                                        </div>
                                    </div>
                                    <Link href="#" class="text-xs font-medium text-gray-700 hover:text-gray-900">
                                        Upgrade
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- Form Builder Resources -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7">
                            <h3 class="text-sm font-semibold text-gray-900 mb-4">Form Builder Resources</h3>
                            <div class="grid grid-cols-3 gap-3">
                                <a href="https://docs.example.com/getting-started" target="_blank" class="group flex flex-col items-center p-3 rounded-lg hover:bg-blue-50 transition-colors text-center">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Docs</span>
                                </a>
                                <a href="https://community.example.com" target="_blank" class="group flex flex-col items-center p-3 rounded-lg hover:bg-purple-50 transition-colors text-center">
                                    <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Community</span>
                                </a>
                                <a href="https://youtube.com/tutorials" target="_blank" class="group flex flex-col items-center p-3 rounded-lg hover:bg-red-50 transition-colors text-center">
                                    <div class="w-10 h-10 rounded-lg bg-red-100 text-red-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Videos</span>
                                </a>
                            </div>
                        </div>

                        <!-- Form Building Tips -->
                        <div class="bg-white rounded-xl border border-gray-200 p-7">
                            <div class="flex items-start gap-2 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700 flex-shrink-0 mt-0.5"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 mb-1">Form Building Best Practice</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed mb-3">Keep your forms short and focused. Each additional field reduces completion rates by 5-10%.</p>
                                    <Link :href="route('forms.create')" class="text-xs font-medium text-gray-700 hover:text-gray-900">
                                        Start building →
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    totalForms: { type: Number, default: 0 },
    totalResponses: { type: Number, default: 0 },
    recentActivity: { type: Array, default: () => [] }
});

const deleteForm = (formId) => {
    if (confirm('Are you sure you want to delete this form? This action cannot be undone.')) {
        router.delete(route('forms.destroy', formId), {
            onSuccess: () => {
                // Form will be removed from the list automatically via Inertia
            },
            onError: () => {
                alert('Failed to delete form. Please try again.');
            }
        });
    }
};
</script>