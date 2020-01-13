<template>
  <transition name="fade">
    <div class="fixed w-full h-full inset-0 flex items-center justify-center" v-if="show">
      <div class="relative w-full mb:w-3/4 max-w-2xl bg-white shadow-lg rounded-lg p-8 text-center">
        <h3>ຜົນການຄົ້ນຫາ</h3>
        <p>ເດີ່ນ {{stadium}} | ວັນທີ {{date | moment("DD/MM/YYYY")}}</p>
        <p>ຊ່ວງເວລາທີ່ເດີ່ນວ່າງ</p>
        <ul v-if="result">
          <li v-for="r of result" v-bind:key="r.time_id">{{ r.time }}</li>
        </ul>
        <button
          @click="$emit('close')"
          class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
        >X</button>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  props: ["result", "stadium", "date", "show"]
};
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
