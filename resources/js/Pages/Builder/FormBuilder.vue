<template>
  <div id="builder">
    <div class="components-panel">
      <h3>Components</h3>
      <button @click="addComponent('text')">Text Input</button>
      <button @click="addComponent('textarea')">Textarea</button>
    </div>

    <div class="form-canvas">
      <h3>Form Canvas</h3>
      <div v-for="(comp, index) in components" :key="index">
        <component :is="comp.type"></component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      components: []
    };
  },
  methods: {
    addComponent(type) {
      this.components.push({ type });
    }
  }
};
</script>

<style scoped>
#builder { display: flex; gap: 20px; }
.components-panel { width: 200px; }
.form-canvas { flex: 1; border: 1px solid #ccc; padding: 10px; }
</style>
