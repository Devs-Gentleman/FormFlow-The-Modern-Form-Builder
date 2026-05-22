<template>
  <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none bg-[#FAFAFA]">
    <!-- Blob 1: Soft Purple (Top Left) -->
    <div 
      class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob"
    ></div>

    <!-- Blob 2: Soft Blue (Top Right) -->
    <div 
      class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob animation-delay-2000"
    ></div>

    <!-- Blob 3: Soft Pink (Bottom Left) -->
    <div 
      class="absolute -bottom-32 left-20 w-[500px] h-[500px] bg-pink-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob animation-delay-4000"
    ></div>
    
    <!-- Noise Overlay -->
    <div class="absolute inset-0 opacity-[0.03]" :style="{ backgroundImage: 'url(https://grainy-gradients.vercel.app/noise.svg)' }"></div>
  </div>
</template>

<style scoped>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}
</style>