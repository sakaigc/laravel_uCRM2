<template>
    <div
      v-if="Object.keys(errors).length"
      class="mb-4 max-w-md mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
    >
      <strong class="block font-semibold mb-1">⚠ 入力内容にエラーがあります</strong>
      <ul class="list-disc list-inside text-sm">
        <li v-for="(message, key) in errors" :key="key">{{ message }}</li>
      </ul>
    </div>
  </template>

  <script setup>
  defineProps({
    errors: {
      type: Object,
      default: () => ({}) // ← null安全でOK
    }
  })
  </script>
