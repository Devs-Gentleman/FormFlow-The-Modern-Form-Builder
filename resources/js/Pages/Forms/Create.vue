<template>
  <div class="flex h-screen bg-gradient-to-br from-gray-50 to-gray-100 font-sans relative">
    
    <!-- SIDEBAR: Professional & Clear -->
    <div class="w-72 bg-white border-r border-gray-200 flex flex-col py-6 z-30 shadow-[8px_0_32px_rgba(0,0,0,0.04)]">
      
      <!-- Brand Icon & Title -->
      <div class="px-6 mb-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/30">F</div>
        <div>
          <div class="text-base font-bold text-gray-900">Form Builder</div>
          <div class="text-xs text-gray-500">Drag fields to canvas</div>
        </div>
      </div>
      
      <!-- Field Types Section -->
      <div class="px-4 mb-3">
        <div class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider px-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
          Field Types
        </div>
      </div>

      <div class="flex-1 overflow-y-auto px-4 space-y-1.5 no-scrollbar">
        <draggable 
          class="flex flex-col gap-1.5" 
          :list="availableFields" 
          :group="{ name: 'fields', pull: 'clone', put: false }" 
          :clone="cloneField" 
          item-key="type"
          :sort="false"
        >
          <template #item="{ element }">
            <div 
              @click="addFieldToCanvas(element)"
              class="group relative bg-white hover:bg-gray-50 border border-gray-200 rounded-xl cursor-grab hover:cursor-pointer hover:border-blue-400 hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-200 p-3.5"
              :title="'Drag to add ' + element.label + ' or click to add to canvas'"
            >
              <div class="flex items-center gap-3">
                <!-- Icon SVG with Enhanced Gradient -->
                <div class="w-10 h-10 bg-gray-50 group-hover:bg-slate-900 rounded-lg flex items-center justify-center group-hover:text-white transition-all duration-300 flex-shrink-0 shadow-sm group-hover:shadow-md group-hover:shadow-black/20">
                  <!-- Text -->
                  <svg v-if="element.type === 'text'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                  <!-- Paragraph -->
                  <svg v-else-if="element.type === 'textarea'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                  <!-- Radio/Multiple Choice -->
                  <svg v-else-if="element.type === 'radio'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                  <!-- Checkbox -->
                  <svg v-else-if="element.type === 'checkbox'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  <!-- File -->
                  <svg v-else-if="element.type === 'file'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                  <!-- Date -->
                  <svg v-else-if="element.type === 'date'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                  <!-- Time -->
                  <svg v-else-if="element.type === 'time'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                  <!-- Number -->
                  <svg v-else-if="element.type === 'number'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  <!-- Email -->
                  <svg v-else-if="element.type === 'email'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-10 5L2 7"></path></svg>
                  <!-- Rating -->
                  <svg v-else-if="element.type === 'rating'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-white transition-colors"><polygon points="12 2 15.09 10.26 24 10.27 17.18 16.70 20.27 25 12 19.54 3.73 25 6.82 16.70 0 10.27 8.91 10.26 12 2"></polygon></svg>
                </div>
                
                <!-- Label & Description -->
                <div class="flex-1 min-w-0">
                  <div class="text-sm font-bold text-gray-900">
                    {{ element.label }}
                  </div>
                  <div class="text-xs text-gray-500 truncate">
                    {{ getFieldDescription(element.type) }}
                  </div>
                </div>
                
                <!-- Drag Indicator -->
                <div class="text-gray-300 group-hover:text-slate-900 opacity-0 group-hover:opacity-100 transition-all duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"></circle><circle cx="9" cy="12" r="1"></circle><circle cx="9" cy="19" r="1"></circle><circle cx="15" cy="5" r="1"></circle><circle cx="15" cy="12" r="1"></circle><circle cx="15" cy="19" r="1"></circle></svg>
                </div>
              </div>
            </div>
          </template>
        </draggable>
      </div>

      <!-- Bottom Tip -->
      <div class="mt-auto px-6 pt-6 border-t border-gray-200">
        <!-- Removed - moved to main canvas area -->
      </div>
    </div>

    <!-- MAIN CANVAS -->
    <div class="flex-1 flex flex-col h-full relative overflow-hidden">
      
      <!-- Top Navigation -->
      <div class="bg-white/90 backdrop-blur-xl border-b border-gray-200 px-8 py-5 flex justify-between items-center z-20 sticky top-0 shadow-sm">
        <!-- Title Input -->
        <div class="flex-1 max-w-2xl space-y-1">
          <!-- Main Form Title -->
          <input 
            v-model="form.title" 
            type="text" 
            class="text-2xl font-bold border-none focus:ring-0 focus:outline-none text-gray-900 placeholder-gray-300 w-full bg-transparent px-0 py-1" 
            placeholder="Untitled Form"
          />
          <!-- Main Form Description -->
          <input 
            v-model="form.description" 
            type="text" 
            class="text-sm text-gray-600 border-none focus:ring-0 focus:outline-none w-full bg-transparent px-0 py-1 placeholder-gray-300" 
            placeholder="Add a description to help respondents..."
          />
        </div>

        <!-- Right Side: Controls -->
        <div class="flex items-center gap-3">
          
          <!-- DEADLINE SMART MENU -->
          <div class="relative">
            <!-- Trigger Button -->
            <button 
                @click="showDeadlineMenu = !showDeadlineMenu"
                class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-5 py-2.5 rounded-full border-2 transition-all hover:shadow-md active:scale-95"
                :class="form.expires_at ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-blue-600 hover:from-blue-700 hover:to-indigo-700 shadow-blue-500/20' : 'bg-white text-gray-600 border-gray-200 hover:border-gray-300'"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                
                <span v-if="!form.expires_at">Set Deadline</span>
                <span v-else>{{ new Date(form.expires_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' }) }}</span>
            </button>

            <!-- Smart Dropdown Menu -->
            <div v-if="showDeadlineMenu" class="absolute top-full right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50 animate-fadeIn origin-top-right">
                <div class="p-2 space-y-1">
                    <div class="px-3 py-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Quick Select</div>
                    
                    <button @click="setQuickDate(24)" class="w-full text-left px-3 py-2.5 text-sm text-gray-700 hover:bg-blue-50 rounded-xl flex justify-between items-center group transition-colors">
                        <span class="font-medium">Tomorrow</span>
                        <span class="text-gray-400 group-hover:text-blue-600 text-xs font-bold">+24h</span>
                    </button>
                    <button @click="setQuickDate(72)" class="w-full text-left px-3 py-2.5 text-sm text-gray-700 hover:bg-blue-50 rounded-xl flex justify-between items-center group transition-colors">
                        <span class="font-medium">3 Days</span>
                        <span class="text-gray-400 group-hover:text-blue-600 text-xs font-bold">+3d</span>
                    </button>
                    <button @click="setQuickDate(168)" class="w-full text-left px-3 py-2.5 text-sm text-gray-700 hover:bg-blue-50 rounded-xl flex justify-between items-center group transition-colors">
                        <span class="font-medium">1 Week</span>
                        <span class="text-gray-400 group-hover:text-blue-600 text-xs font-bold">+7d</span>
                    </button>
                    
                    <div class="border-t border-gray-100 my-1"></div>
                    
                    <button @click="openNativePicker" class="w-full text-left px-3 py-2.5 text-sm text-blue-600 font-bold hover:bg-blue-50 rounded-xl flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Pick Custom Date...
                    </button>
                </div>
                
                <!-- Clear Action -->
                <div v-if="form.expires_at" class="bg-gray-50 p-2 border-t border-gray-100">
                    <button @click="form.expires_at = null; showDeadlineMenu = false" class="w-full text-center text-xs text-red-500 hover:text-red-700 font-bold py-1.5 transition-colors">
                        Clear Deadline
                    </button>
                </div>
            </div>
            
            <!-- Backdrop to close menu -->
            <div v-if="showDeadlineMenu" class="fixed inset-0 z-40" @click="showDeadlineMenu = false"></div>

            <!-- HIDDEN INPUT -->
            <input 
                ref="dateInput"
                type="datetime-local" 
                v-model="form.expires_at"
                style="position: absolute; opacity: 0; pointer-events: none; bottom: 0; right: 0; z-index: -1;"
                @change="showDeadlineMenu = false"
            />
          </div>

          <!-- SAVE BUTTON -->
          <button 
            @click="saveForm" 
            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-7 py-2.5 rounded-full hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/30 font-bold text-sm flex items-center gap-2 hover:shadow-xl hover:shadow-blue-500/40"
            :disabled="form.processing"
          >
            <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            <span v-if="form.processing">Publishing...</span>
            <span v-else>Publish Form</span>
          </button>
        </div>
      </div>

      <!-- Canvas Area with Enhanced Artboard -->
      <div class="flex-1 overflow-y-auto p-6 sm:p-12 scroll-smooth relative">
        <div class="max-w-3xl mx-auto min-h-[700px] pb-32 relative">
          
          <!-- How to Build Card - Floating Panel Bottom Right -->
          <div class="fixed bottom-6 right-6 w-72 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6 shadow-xl z-20 hidden lg:block">
            <div class="space-y-4">
              <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M12 2a10 10 0 1 0 10 10H12V2z"></path><path d="M12 2v10h10"></path></svg>
                <h3 class="font-bold text-gray-900">Getting Started</h3>
              </div>
              
              <div class="space-y-3 text-sm text-gray-700">
                <div class="flex gap-3">
                  <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs">1</div>
                  <div>
                    <p class="font-semibold text-gray-900">Name field</p>
                    <p class="text-gray-600 text-xs mt-0.5">Already added</p>
                  </div>
                </div>
                
                <div class="flex gap-3">
                  <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs">2</div>
                  <div>
                    <p class="font-semibold text-gray-900">Click or drag</p>
                    <p class="text-gray-600 text-xs mt-0.5">Add fields from left</p>
                  </div>
                </div>
                
                <div class="flex gap-3">
                  <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs">3</div>
                  <div>
                    <p class="font-semibold text-gray-900">Customize</p>
                    <p class="text-gray-600 text-xs mt-0.5">Write questions, add options</p>
                  </div>
                </div>
                
                <div class="flex gap-3">
                  <div class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs">4</div>
                  <div>
                    <p class="font-semibold text-gray-900">Reorder</p>
                    <p class="text-gray-600 text-xs mt-0.5">Use drag handle (⋮⋮)</p>
                  </div>
                </div>
              </div>
              
              <div class="pt-3 border-t border-blue-200">
                <p class="text-xs text-blue-600 font-medium">✨ Quick add or drag</p>
              </div>
            </div>
          </div>
          
          <!-- Enhanced Empty State with Better Instructions -->
          <div v-if="formFields.length === 0" class="absolute inset-0 flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50/30 pointer-events-none">
            <div class="text-center space-y-6">
              <div>
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center text-4xl mb-4 mx-auto shadow-lg">👈</div>
                <h3 class="text-gray-900 font-bold text-lg">Drag fields to start building</h3>
                <p class="text-gray-600 text-sm mt-2 max-w-sm mx-auto leading-relaxed">
                  The <span class="font-semibold">"Name"</span> field is already there. Now drag question types from the left sidebar to add more fields to your form.
                </p>
              </div>
              
              <div class="grid grid-cols-3 gap-3 bg-white/60 backdrop-blur-sm px-6 py-4 rounded-xl border border-blue-200/50 max-w-2xl">
                <div class="flex flex-col items-center gap-2">
                  <div class="text-2xl">T</div>
                  <div class="text-xs text-gray-600 font-medium">Text</div>
                </div>
                <div class="flex flex-col items-center gap-2">
                  <div class="text-2xl">◉</div>
                  <div class="text-xs text-gray-600 font-medium">Multiple</div>
                </div>
                <div class="flex flex-col items-center gap-2">
                  <div class="text-2xl">★</div>
                  <div class="text-xs text-gray-600 font-medium">Rating</div>
                </div>
              </div>
              
              <div class="text-xs text-gray-500 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-500"><path d="M12 5v14M5 12h14"></path></svg>
                Tip: Hover over fields on the left to see the drag icon
              </div>
            </div>
          </div>

          <!-- Draggable Form Fields -->
          <draggable data-form-canvas class="space-y-5 min-h-[700px] w-full" :list="formFields" group="fields" item-key="id" handle=".drag-handle" animation="200" ghost-class="opacity-50">
            <template #item="{ element, index }">
              <div class="group relative bg-white rounded-2xl shadow-md border-2 border-gray-100 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                <!-- Action Buttons -->
                <div class="absolute -right-4 top-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                   <div class="drag-handle w-10 h-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl flex items-center justify-center cursor-grab hover:bg-blue-50 hover:border-blue-400 text-gray-400 hover:text-blue-600 transition-all">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"></circle><circle cx="9" cy="12" r="1"></circle><circle cx="9" cy="19" r="1"></circle><circle cx="15" cy="5" r="1"></circle><circle cx="15" cy="12" r="1"></circle><circle cx="15" cy="19" r="1"></circle></svg>
                   </div>
                   <button @click="removeField(index)" class="w-10 h-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-300 transition-all">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                   </button>
                </div>

                <div class="p-7 sm:p-9">
                  <!-- Question Header - Minimalist -->
                  <div class="flex justify-between items-start gap-4 mb-5">
                     <div class="flex-1 flex items-center gap-3">
                       <input 
                        v-model="element.label" 
                        class="block w-full text-xl font-bold border-none focus:ring-0 focus:outline-none px-0 py-1 bg-transparent placeholder-gray-300 text-gray-900" 
                        placeholder="Write your question here..."
                      />
                      <span v-if="element.isIdentifierField || element.label === 'Name'" class="flex-shrink-0 bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">IDENTIFIER</span>
                     </div>
                    <label class="flex items-center gap-2 cursor-pointer flex-shrink-0 pt-1 group/toggle" title="Toggle Required">
                      <span class="text-xs font-semibold text-gray-500 group-hover/toggle:text-gray-900 transition-colors">Required</span>
                      <div class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" v-model="element.required" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-blue-600 peer-checked:to-indigo-600 shadow-inner"></div>
                      </div>
                    </label>
                  </div>
                  
                  <!-- Description - Minimalist -->
                  <input 
                    v-model="element.helpText" 
                    class="block w-full text-sm text-gray-600 border-none focus:ring-0 focus:outline-none px-0 py-1 bg-transparent placeholder-gray-300 mb-6" 
                    placeholder="Add helpful description or instructions (optional)"
                  />
                  
                  <!-- Field Previews -->
                  <!-- Combined standard inputs -->
                  <div v-if="['text', 'email', 'number'].includes(element.type)">
                    <div class="border-2 border-gray-200 rounded-lg py-3 px-4 text-gray-400 text-sm font-medium bg-gray-100">{{ element.placeholder || 'Respondent will type their answer here...' }}</div>
                  </div>
                  
                  <div v-else-if="element.type === 'textarea'">
                    <div class="border-2 border-gray-200 rounded-lg py-3 px-4 text-gray-400 text-sm font-medium h-28 bg-gray-100">Paragraph answer will appear here...</div>
                  </div>
                  
                  <div v-else-if="element.type === 'file'">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg py-8 px-4 text-center bg-gray-100 flex flex-col items-center justify-center">
                      <svg class="mx-auto mb-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                      <div class="text-sm text-gray-500 font-medium">Students can upload files here</div>
                    </div>
                  </div>
                  
                  <div v-else-if="element.type === 'rating'">
                    <div class="flex gap-2">
                      <div v-for="n in 5" :key="n" class="w-10 h-10 border-2 border-gray-200 rounded-lg flex items-center justify-center text-gray-400 bg-gray-50 hover:border-yellow-400 hover:bg-yellow-50 cursor-pointer transition-all">
                        ★
                      </div>
                    </div>
                  </div>
                  
                  <div v-else-if="element.type === 'date'">
                    <div class="border-2 border-gray-200 rounded-lg py-3 px-4 text-gray-400 text-sm font-medium bg-gray-100 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                      Select date...
                    </div>
                  </div>
                  
                  <div v-else-if="element.type === 'time'">
                    <div class="border-2 border-gray-200 rounded-lg py-3 px-4 text-gray-400 text-sm font-medium bg-gray-100 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                      Select time...
                    </div>
                  </div>
                  
                  <div v-else-if="['radio', 'checkbox'].includes(element.type)">
                    <div class="space-y-3">
                      <div v-for="(opt, optIndex) in element.options" :key="optIndex" class="flex items-center gap-3 group/opt animate-fadeIn">
                        <div class="w-5 h-5 border-2 border-gray-300 flex-shrink-0 flex items-center justify-center hover:border-blue-500 transition-colors" :class="element.type === 'radio' ? 'rounded-full' : 'rounded-md'"></div>
                        
                        <!-- Option Text - Minimalist -->
                        <input 
                          v-model="element.options[optIndex]" 
                          class="flex-1 text-sm border-none focus:ring-0 focus:outline-none px-0 py-1 bg-transparent text-gray-700 font-medium placeholder-gray-300" 
                          placeholder="Type option..."
                        >
                        
                        <button @click="element.options.splice(optIndex, 1)" class="text-gray-300 hover:text-red-500 opacity-0 group-hover/opt:opacity-100 px-2 transition-all font-bold text-lg">&times;</button>
                      </div>
                      <button @click="element.options.push('New Option')" class="text-sm text-blue-600 hover:text-blue-700 font-bold flex items-center gap-1.5 mt-4 transition-colors hover:gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add option
                      </button>
                    </div>
                  </div>
                  
                   <!-- Fallback for debugging unknown types -->
                  <div v-else class="text-red-500 text-sm font-bold bg-red-50 p-3 rounded-lg border border-red-200">
                     Unknown field type: {{ element.type }}
                  </div>

                </div>
              </div>
            </template>
          </draggable>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import { v4 as uuidv4 } from 'uuid';

// Optimized for Teacher/Education Use
const availableFields = [
  { type: 'text', label: 'Short Answer' },
  { type: 'textarea', label: 'Paragraph' },
  { type: 'radio', label: 'Multiple Choice' },
  { type: 'checkbox', label: 'Checkboxes' },
  // Dropdown removed as requested
  { type: 'file', label: 'File Upload' },
  { type: 'date', label: 'Date' },
  { type: 'time', label: 'Time' },
  { type: 'number', label: 'Number' },
  { type: 'email', label: 'Email' },
  { type: 'rating', label: 'Rating Scale' },
];

const formFields = ref([]);
const form = useForm({
  title: '',
  description: '',
  json_structure: [],
  status: 'published',
  expires_at: null,
  identifier_field: 'Name'
});

// Initialize with a required Name field
const initializeNameField = () => {
  const nameField = {
    id: uuidv4(),
    type: 'text',
    label: 'Name',
    helpText: 'This field is used to identify who submitted the form',
    placeholder: 'Enter your name',
    required: true,
    options: [],
    isIdentifierField: true // Mark as identifier
  };
  formFields.value.push(nameField);
};

// Call on component mount
initializeNameField();

// UI States
const showDeadlineMenu = ref(false);
const dateInput = ref(null);

// Helper function for field descriptions
const getFieldDescription = (type) => {
  const descriptions = {
    'text': 'Single line answer',
    'textarea': 'Longer text answer',
    'email': 'Student/Contact email',
    'number': 'Math or numeric value',
    'date': 'Calendar date picker',
    'time': 'Time selector',
    'radio': 'Single choice question',
    'checkbox': 'Multiple select question',
    'file': 'Collect assignments',
    'rating': 'Feedback/Rating scale'
  };
  return descriptions[type] || 'Field input';
};

// Smart Date Setter
const setQuickDate = (hours) => {
    const date = new Date();
    date.setHours(date.getHours() + hours);
    date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
    form.expires_at = date.toISOString().slice(0, 16);
    showDeadlineMenu.value = false;
};

// Open Native Picker programmatically
const openNativePicker = () => {
    showDeadlineMenu.value = false;
    setTimeout(() => {
        if(dateInput.value) {
            try {
                dateInput.value.showPicker();
            } catch (e) {
                dateInput.value.click();
            }
        }
    }, 50);
};

const cloneField = (field) => {
  const newField = {
    ...field,
    id: uuidv4(),
    label: '', // Initialize empty to show placeholder "Write your question here..."
    helpText: '',
    placeholder: '',
    required: false,
    options: field.options ? [...field.options] : []
  };

  // Ensure Multiple Choice and Checkboxes start with options
  if (['radio', 'checkbox'].includes(newField.type) && newField.options.length === 0) {
    newField.options = ['Option 1', 'Option 2'];
  }

  return newField;
};

const addFieldToCanvas = (field) => {
  // Add the cloned field to formFields when icon is clicked
  const newField = cloneField(field);
  formFields.value.push(newField);
  
  // Small visual feedback with scroll
  setTimeout(() => {
    const canvas = document.querySelector('[data-form-canvas]');
    if (canvas) {
      canvas.scrollIntoView({ behavior: 'smooth', block: 'end' });
    }
  }, 100);
};

const removeField = (index) => {
  const field = formFields.value[index];
  
  // Warn if trying to remove the Name field
  if (field.label === 'Name' || field.isIdentifierField) {
    const confirmed = confirm(
      '⚠️ This is the identifier field!\n\n' +
      'If you remove this field, you won\'t be able to know who submitted each response.\n\n' +
      'Are you sure you want to remove it?'
    );
    if (!confirmed) return;
  }
  
  formFields.value.splice(index, 1);
};

const saveForm = () => {
  form.json_structure = formFields.value;
  form.post(route('forms.store'), {
    onError: (errors) => {
        console.error(errors);
        alert("Validation error. Please check your form.");
    }
  });
};
</script>