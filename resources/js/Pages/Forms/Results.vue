<template>
    <Head title="Form Results" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-4xl font-bold text-slate-900">{{ form.title }}</h1>
                    <div class="flex gap-2">
                        <a :href="`/form/${form.public_link}`" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-slate-700 rounded-lg border border-slate-200 hover:border-slate-300 hover:shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                            View Form
                        </a>
                        <Link :href="route('dashboard')" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                            Back
                        </Link>
                    </div>
                </div>
                <p v-if="form.description" class="text-slate-600">{{ form.description }}</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="relative bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-blue-200 p-6 overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-blue-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-blue-600 mb-2">Total Responses</div>
                        <div class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ responses.length }}</div>
                    </div>
                </div>
                <div class="relative bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl shadow-sm border border-indigo-200 p-6 overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-indigo-600 mb-2">Response Rate</div>
                        <div class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">100%</div>
                    </div>
                </div>
                <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-sm border border-purple-200 p-6 overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-purple-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="text-sm font-medium text-purple-600 mb-2">Last Response</div>
                        <div class="text-lg font-semibold text-purple-900">
                            {{ responses.length > 0 ? formatDate(responses[0].created_at) : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responses -->
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">All Responses</h2>
                
                <div v-if="responses.length === 0" class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-slate-500 text-lg">No responses yet. Share your form to collect data.</p>
                </div>

                <div v-for="(response, index) in responses" :key="response.id" class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition overflow-hidden">
                    <!-- Response Header with Gradient Accent -->
                    <div class="h-1 bg-gradient-to-r from-blue-500 to-purple-600"></div>
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-slate-500">Response #{{ responses.length - index }}</div>
                            <div class="font-semibold mt-1 bg-gradient-to-r from-slate-700 to-slate-900 bg-clip-text text-transparent">
                                {{ getSubmitterName(response.response_json) || 'Anonymous' }}
                            </div>
                            <div class="text-xs text-slate-400 mt-1">{{ formatDate(response.created_at) }}</div>
                        </div>
                        <button 
                            @click="toggleResponse(response.id)"
                            class="p-2 rounded-lg transition"
                            :class="expandedId === response.id ? 'bg-blue-50 text-blue-600' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :class="expandedId === response.id ? 'rotate-180' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Response Content -->
                    <div v-if="expandedId === response.id" class="px-6 py-6 bg-gradient-to-b from-slate-50 to-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div v-for="header in headers" :key="header" class="pb-4">
                                <label class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2 block">{{ header }}</label>
                                <div class="text-slate-900 bg-gradient-to-br from-slate-50 to-slate-100 px-4 py-3 rounded-lg border border-slate-200 text-sm hover:border-slate-300 transition">
                                    <span v-html="renderAnswer(response.response_json, header)"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const normalizeKey = (key) => {
    if (!key) return '';
    return key.toLowerCase().replace(/\s/g, '');
};

const props = defineProps({
    form: Object,
    responses: Array
});

const expandedId = ref(null);

const toggleResponse = (responseId) => {
    expandedId.value = expandedId.value === responseId ? null : responseId;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const getSubmitterName = (responseData) => {
    // Use the explicitly marked identifier field
    const identifierField = props.form.identifier_field;
    
    if (identifierField && responseData[identifierField]) {
        const value = responseData[identifierField];
        if (Array.isArray(value)) {
            return value.join(', ');
        }
        return String(value);
    }
    
    // Fallback: return null if no identifier field is set
    return null;
};

const fieldTypeMap = computed(() => {
    try {
        const structure = typeof props.form.json_structure === 'string' 
            ? JSON.parse(props.form.json_structure) 
            : props.form.json_structure;
        
        return structure.reduce((map, field) => {
            map[normalizeKey(field.label)] = field;
            return map;
        }, {});
    } catch (e) {
        return {};
    }
});

const headers = computed(() => {
    try {
        const structure = typeof props.form.json_structure === 'string' 
            ? JSON.parse(props.form.json_structure) 
            : props.form.json_structure;
        return structure.map(f => f.label);
    } catch (e) {
        return [];
    }
});

const renderAnswer = (json, question) => {
    try {
        const data = json;
        const normalizedQuestionKey = normalizeKey(question);
        const fieldDefinition = fieldTypeMap.value[normalizedQuestionKey];
        
        if (!fieldDefinition) {
            return '<span class="text-red-500 text-xs">Field not found</span>';
        }
        
        const answer = data[fieldDefinition.label];
        const fieldType = fieldDefinition.type;

        if (answer === undefined || answer === null || answer === '' || (Array.isArray(answer) && answer.length === 0)) {
            return '<span class="text-slate-400 italic">—</span>';
        }

        switch (fieldType) {
            case 'checkbox':
                if (Array.isArray(answer)) {
                    return answer.map(a => `<span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2 mb-2">${a}</span>`).join('');
                }
                break;
            case 'rating':
                const stars = '★'.repeat(answer);
                return `<span class="text-yellow-400 text-lg">${stars}</span>`;
            case 'file':
                const filename = answer.substring(answer.lastIndexOf('/') + 1);
                const fileUrl = `/storage/${answer}`;
                return `<a href="${fileUrl}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm font-medium">${filename}</a>`;
            case 'textarea':
                return `<div class="whitespace-pre-wrap text-sm">${answer}</div>`;
            case 'email':
                return `<a href="mailto:${answer}" class="text-blue-600 hover:text-blue-800">${answer}</a>`;
            default:
                return String(answer);
        }

        return String(answer);

    } catch (e) {
        return '<span class="text-red-500 text-xs">Error</span>';
    }
};
</script>