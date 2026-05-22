<template>
  <!-- 1. Main container: transparent & relative to show background -->
  <div class="min-h-screen bg-transparent flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8 font-sans relative">
    
    <!-- 2. The Animated Background -->
    <TallyBackground />

    <Head :title="form.title" />
    
    <!-- Branding / Logo -->
    <div class="mb-8 z-10">
        <div class="w-10 h-10 bg-black rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-xl shadow-black/10">
            F
        </div>
    </div>

    <div class="w-full max-w-xl z-10">
      
      <!-- Main Form Card -->
      <!-- 3. Updated classes: bg-white/90, backdrop-blur-sm, border-white/50 for frosted look -->
      <div class="bg-white/90 backdrop-blur-sm shadow-sm border border-white/50 rounded-2xl overflow-hidden">
        
        <!-- Header Section -->
        <div class="px-8 pt-10 pb-6 border-b border-gray-100/50">
          <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ form.title }}</h1>
          <p class="mt-2 text-gray-500 text-base leading-relaxed">{{ form.description || 'Please fill out the details below.' }}</p>
        </div>

        <!-- Success State -->
        <div v-if="$page.props.flash?.success" class="p-12 text-center bg-gray-50/50">
          <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6 animate-bounce">
            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          </div>
          <h2 class="text-2xl font-bold text-gray-900 mb-2">Thank you!</h2>
          <p class="text-gray-500">{{ $page.props.flash.success }}</p>
        </div>

        <!-- The Form -->
        <form v-else @submit.prevent="submitForm" class="p-8 space-y-8">
          
          <div v-if="formStructure.length === 0" class="text-center text-gray-400 py-8">
            <p>This form is currently empty.</p>
          </div>

          <div v-for="field in formStructure" :key="field.id" class="group">
            
            <!-- Label -->
            <label class="block text-sm font-semibold text-gray-900 mb-2">
              {{ field.label }}
              <span v-if="field.required" class="text-red-500 ml-0.5" title="Required">*</span>
            </label>
            
            <!-- Helper Text -->
            <p v-if="field.helpText" class="text-xs text-gray-500 mb-3">{{ field.helpText }}</p>

            <!-- 1. Simple Inputs (Text, Email, Number, Date, Time) -->
            <div v-if="['text', 'email', 'number', 'date', 'time'].includes(field.type)">
              <input 
                :type="field.type"
                v-model="answers[field.label]" 
                :placeholder="field.placeholder"
                class="block w-full rounded-lg border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-black focus:ring-black sm:text-sm py-3 px-4 transition-all duration-200 placeholder-gray-400"
                :required="field.required"
              />
            </div>

            <!-- 2. Textarea -->
            <div v-else-if="field.type === 'textarea'">
              <textarea 
                v-model="answers[field.label]"
                :placeholder="field.placeholder"
                rows="4"
                class="block w-full rounded-lg border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-black focus:ring-black sm:text-sm py-3 px-4 transition-all duration-200 placeholder-gray-400 resize-none"
                :required="field.required"
              ></textarea>
            </div>

            <!-- 3. Radio Buttons -->
            <div v-else-if="field.type === 'radio'" class="space-y-3">
              <div v-for="opt in field.options" :key="opt" class="flex items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors" @click="answers[field.label] = opt">
                <input 
                  type="radio" 
                  :name="field.id" 
                  :value="opt"
                  v-model="answers[field.label]"
                  class="h-4 w-4 border-gray-300 text-black focus:ring-black cursor-pointer"
                  :required="field.required"
                >
                <label class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                  {{ opt }}
                </label>
              </div>
            </div>

            <!-- 4. Checkboxes -->
            <div v-else-if="field.type === 'checkbox'" class="space-y-3">
              <div v-for="opt in field.options" :key="opt" class="flex items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input 
                  type="checkbox" 
                  :value="opt"
                  v-model="answers[field.label]"
                  class="h-4 w-4 rounded border-gray-300 text-black focus:ring-black cursor-pointer"
                >
                <label class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                  {{ opt }}
                </label>
              </div>
            </div>

            <!-- 5. File Upload -->
            <div v-else-if="field.type === 'file'">
              <input 
                type="file"
                @input="e => answers[field.label] = e.target.files[0]"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer bg-gray-50 rounded-lg border border-gray-200"
                :required="field.required"
              />
              <p class="mt-1 text-xs text-gray-400">Max file size: 10MB</p>
            </div>

            <!-- 6. Rating Scale -->
            <div v-else-if="field.type === 'rating'">
              <div class="flex gap-2">
                <button 
                  type="button" 
                  v-for="star in 5" 
                  :key="star" 
                  @click="answers[field.label] = star"
                  class="w-12 h-12 rounded-xl flex items-center justify-center transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                  :class="answers[field.label] >= star ? 'bg-yellow-100 text-yellow-500 ring-2 ring-yellow-400 shadow-sm' : 'bg-gray-50 text-gray-300 hover:bg-gray-100'"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                </button>
              </div>
              <input type="hidden" :value="answers[field.label]" :required="field.required">
            </div>

          </div>

          <!-- Submit Button -->
          <div class="pt-6">
            <button 
              type="submit" 
              class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-black/5 text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all transform hover:-translate-y-0.5"
              :disabled="formSubmit.processing"
            >
              <span v-if="formSubmit.processing" class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Sending...
              </span>
              <span v-else>Submit Response</span>
            </button>
          </div>

        </form>
      </div>
      
      <!-- Footer Branding -->
      <div class="mt-8 text-center">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Powered by FormFlow</p>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import TallyBackground from '@/Components/TallyBackground.vue';

const props = defineProps({
    form: Object
});

const formStructure = computed(() => {
    try {
        const parsed = typeof props.form.json_structure === 'string' 
            ? JSON.parse(props.form.json_structure) 
            : props.form.json_structure;
        
        return Array.isArray(parsed) ? parsed : [];
    } catch (e) {
        return [];
    }
});

const answers = ref({});

// Watcher now safely loops because formStructure is guaranteed to be an array
watch(formStructure, (fields) => {
    fields.forEach(field => {
        if (field.type === 'checkbox' && !answers.value[field.label]) {
            answers.value[field.label] = [];
        }
    });
}, { immediate: true });

const formSubmit = useForm({});

const submitForm = () => {
    formSubmit.defaults(answers.value);
    formSubmit.transform((data) => ({
        ...data,
        ...answers.value
    })).post(`/form/${props.form.public_link}/submit`);
};
</script>