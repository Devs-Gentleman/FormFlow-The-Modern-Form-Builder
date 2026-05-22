<template>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Forms</h2>
            <Link 
                :href="route('forms.create')" 
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
            >
                + Create New Form
            </Link>
        </div>
<div class="flex gap-4">
    <a :href="`/form/${form.public_link}`" target="_blank" class="text-blue-500 text-sm hover:underline flex items-center">
        Public Link 🔗
    </a>
    
    <Link :href="route('forms.results', form.id)" class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-200">
        View Results 📊
    </Link>
</div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div v-if="forms.length === 0" class="text-center text-gray-500 py-10">
                    You haven't created any forms yet.
                </div>

                <div v-else class="grid gap-4">
                    <div v-for="form in forms" :key="form.id" class="border p-4 rounded-lg flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <h3 class="font-bold text-lg">{{ form.title }}</h3>
                            <p class="text-sm text-gray-500">Created: {{ new Date(form.created_at).toLocaleDateString() }}</p>
                            <a :href="`/form/${form.public_link}`" target="_blank" class="text-blue-500 text-sm hover:underline">
                                Public Link 🔗
                            </a>
                        </div>
                        <div class="flex gap-2">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    forms: Array
});
</script>