<script setup>
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  memo: '',
  price: '',
  is_selling: true,
})

const storeItem = () => {
  form.post(route('items.store'))
}
</script>

<template>
  <Head title="商品登録" />

  <!-- ヘッダー -->
  <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white shadow mb-4">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">📦 商品登録</h2>
  </div>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-8 rounded shadow-sm">
        <form @submit.prevent="storeItem" class="space-y-5">
          <!-- 名前 -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
            <input id="name" v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
          </div>

          <!-- メモ -->
          <div>
            <label for="memo" class="block text-sm font-medium text-gray-700">メモ</label>
            <textarea id="memo" v-model="form.memo" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            <div v-if="form.errors.memo" class="text-red-500 text-sm mt-1">{{ form.errors.memo }}</div>
          </div>

          <!-- 価格 -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">価格</label>
            <input id="price" v-model="form.price" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <div v-if="form.errors.price" class="text-red-500 text-sm mt-1">{{ form.errors.price }}</div>
          </div>

          <!-- 販売中 -->
          <div class="flex items-center">
            <input id="is_selling" type="checkbox" v-model="form.is_selling" class="mr-2" />
            <label for="is_selling" class="text-sm text-gray-700">販売中</label>
          </div>

          <!-- ボタン -->
          <div class="text-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
              商品登録
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
