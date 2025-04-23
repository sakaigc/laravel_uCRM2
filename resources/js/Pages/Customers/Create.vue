<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import { Core as YubinBangoCore } from 'yubinbango-core2'

const form = useForm({
  name: '',
  kana: '',
  tel: '',
  email: '',
  postcode: '',
  address: '',
  birthday: '',
  gender: '',
  memo: '',
})

const fetchAddress = () => {
  new YubinBangoCore(String(form.postcode), (value) => {
    form.address = value.region + value.locality + value.street
  })
}

const storeCustomer = () => {
  form.post('/customers')
}
</script>

<template>
  <Head title="顧客登録" />

  <!-- ページ上部ヘッダー -->
  <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white shadow mb-4">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">👤 顧客登録</h2>
  </div>

  <div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
      <ValidationErrors :errors="form.errors" class="mb-4" />

      <form @submit.prevent="storeCustomer" class="space-y-5">
        <!-- 名前 -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
          <input id="name" v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- カナ -->
        <div>
          <label for="kana" class="block text-sm font-medium text-gray-700">カナ</label>
          <input id="kana" v-model="form.kana" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- 電話番号 -->
        <div>
          <label for="tel" class="block text-sm font-medium text-gray-700">電話番号</label>
          <input id="tel" v-model="form.tel" type="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- メールアドレス -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
          <input id="email" v-model="form.email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- 郵便番号 -->
        <div>
          <label for="postcode" class="block text-sm font-medium text-gray-700">郵便番号</label>
          <input id="postcode" v-model="form.postcode" type="text" @blur="fetchAddress" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- 住所 -->
        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">住所</label>
          <input id="address" v-model="form.address" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- 誕生日 -->
        <div>
          <label for="birthday" class="block text-sm font-medium text-gray-700">誕生日</label>
          <input id="birthday" v-model="form.birthday" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>

        <!-- 性別 -->
        <div>
          <label class="block text-sm font-medium text-gray-700">性別</label>
          <div class="mt-2 space-x-4">
            <label><input type="radio" value="0" v-model="form.gender" /> 男性</label>
            <label><input type="radio" value="1" v-model="form.gender" /> 女性</label>
            <label><input type="radio" value="2" v-model="form.gender" /> その他</label>
          </div>
        </div>

        <!-- メモ -->
        <div>
          <label for="memo" class="block text-sm font-medium text-gray-700">メモ</label>
          <textarea id="memo" rows="3" v-model="form.memo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
        </div>

        <!-- ボタン -->
        <div class="text-center">
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow">
            顧客登録
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
