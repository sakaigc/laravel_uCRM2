<script setup>
import { getToday } from '@/common'
import { ref, reactive, onMounted, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  customers: Array,
  items: Array,
})

// フォームデータ
const form = reactive({
  date: '',
  customer_id: null,
  status: true,
  items: [],
})

// 商品一覧
const itemList = ref([])

onMounted(() => {
  form.date = getToday()

  props.items.forEach(item => {
    itemList.value.push({
      id: item.id,
      name: item.name,
      price: item.price,
      quantity: 0,
    })
  })
})

const quantity = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

const totalPrice = computed(() => {
  let total = 0
  itemList.value.forEach(item => {
    total += item.price * item.quantity
  })
  return total
})

// 登録ボタン処理
const storePurchase = () => {
  form.items = [] // ← 初期化を忘れずに！
  itemList.value.forEach(item => {
    if (item.quantity > 0) {
      form.items.push({ id: item.id, quantity: item.quantity })
    }
  })
  Inertia.post(route('purchases.store'), form)
}
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">🛒 購入作成フォーム</h1>

    <!-- 成功メッセージ -->
    <div v-if="$page.props.flash.message" class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ $page.props.flash.message }}
    </div>

    <!-- エラーメッセージ -->
    <div v-if="$page.props.flash.error" class="bg-red-100 text-red-800 p-3 rounded mb-4">
    {{ $page.props.flash.error }}

    </div>
    <!-- 購入日 -->
    <div class="mb-4">
      <label>📅 購入日</label><br />
      <input type="date" name="date" v-model="form.date" class="border px-2 py-1 rounded w-full" />
    </div>

    <!-- 会員名 -->
    <div class="mb-4">
      <label>👤 会員名</label><br />
      <select name="customer" v-model="form.customer_id" class="border px-2 py-1 rounded w-full">
        <option :value="null" disabled>選択してください</option>
        <option v-for="customer in customers" :value="customer.id" :key="customer.id">
          {{ customer.id }} : {{ customer.name }}
        </option>
      </select>
    </div>

    <!-- 商品・サービス -->
    <div class="mb-6">
      <label>📦 商品・サービス</label>

      <table class="w-full border text-sm mt-2">
        <thead class="bg-pink-100 font-semibold text-gray-700">
          <tr>
            <th class="border p-2">Id</th>
            <th class="border p-2">名前</th>
            <th class="border p-2">金額</th>
            <th class="border p-2">数量</th>
            <th class="border p-2">小計</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in itemList" :key="item.id" class="text-center">
            <td class="border p-2">{{ item.id }}</td>
            <td class="border p-2">{{ item.name }}</td>
            <td class="border p-2">¥{{ item.price.toLocaleString() }}</td>
            <td class="border p-2">
                <select v-model="item.quantity" class="..." >
                    <option v-for="q in quantity" :value="q" :key="q">{{ q }}</option>
                </select>
            </td>
            <td class="border p-2 text-right">
              ¥{{ (item.price * item.quantity).toLocaleString() }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- 合計金額 -->
    <div class="text-right text-lg font-bold mb-6">
      合計：¥{{ totalPrice.toLocaleString() }} 円
    </div>

    <!-- 登録ボタン -->
    <form @submit.prevent="storePurchase" class="text-center">
      <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
      >
        ✅ 登録する
      </button>
    </form>
  </div>
</template>
