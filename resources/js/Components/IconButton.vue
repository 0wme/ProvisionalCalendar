<template>
  <button 
    class="icon-button"
    @click="$emit('click')"
  >
    <i class="icon" :class="iconClass"></i>
    <span v-if="label">{{ label }}</span>
  </button>
</template>

<script>
export default {
  name: 'IconButton',
  props: {
    iconClass: {
      type: String,
      required: true
    },
    label: {
      type: String,
      default: ''
    }
  }
}
</script>

<style scoped>
.icon-button {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  background-color: #4CAF50;
  color: white;
}

.icon-button:hover {
  background-color: #45a049;
}

.icon {
  font-size: 18px;
}
</style>