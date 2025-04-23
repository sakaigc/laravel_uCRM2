<script setup>
import MicroModal from 'micromodal'
import { onMounted } from 'vue'

onMounted(() => {
  MicroModal.init({
    disableScroll: true,
    awaitCloseAnimation: true,
  })
})
</script>

<template>
  <button data-micromodal-trigger="modal-1">モーダルを開く</button>

  <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">Micromodal</h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <p>フォーカスがモーダル内に留まることを確認してね。</p>
        </main>
        <footer class="modal__footer">
          <button class="modal__btn modal__btn-primary">続ける</button>
          <button class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
        </footer>
      </div>
    </div>
  </div>
</template>
