<template>
  <nav id="navbar" class="flex flex-wrap items-center justify-between p-4 bg-gray-900">
    <div class="flex items-center flex-shrink-0 text-white">
      <span class="font-body font-normal text-2xl">
        <router-link :to="{ name: 'home' }">Lan Xang Stadium</router-link>
      </span>
    </div>
    <div class="block dt:hidden tl:hidden">
      <button
        @click="toggle()"
        :class=" isOpen ? 'text-teal-300 border-teal-300': 'text-white border-white'"
        class="flex items-center px-3 py-2 border rounded"
      >
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <title>Menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
      </button>
    </div>
    <div :class=" isOpen ? 'mb:block' : 'mb:hidden'" class="dt:flex items-center w-auto mb:w-full">
      <div class="dt:flex-grow">
        <span
          @click="toggle()"
          class="font-body font-normal text-white mx-4 hover:text-teal-300 mb:block mb:my-2"
        >
          <router-link :to="{ name: 'stadium' }">ເດີ່ນເຕະບານ</router-link>
        </span>
        <span
          @click="toggle()"
          class="font-body font-normal text-white mx-4 hover:text-teal-300 mb:block mb:my-2"
        >
          <router-link :to="{ name: 'schedule' }">ຕາຕະລາງຈອງເດີ່ນ</router-link>
        </span>
        <span
          @click="toggle()"
          class="font-body font-normal text-white mx-4 hover:text-teal-300 mb:block mb:my-2"
        >
          <router-link :to="{ name: 'contact' }">ຕິດຕໍ່</router-link>
        </span>
        <span
          @click="toggle()"
          class="font-body font-normal text-white mx-4 hover:text-teal-300 mb:block mb:my-2"
        >
          <router-link :to="{ name: 'aboutus' }">ກ່ຽວກັບພວກເຮົາ</router-link>
        </span>
      </div>
    </div>
    <div :class=" isOpen ? 'mb:block' : 'mb:hidden'" class="dt:flex items-center w-auto mb:w-full">
      <div class="dt:flex-grow">
        <span
          @click="toggle()"
          class="font-body font-normal text-white mx-4 hover:text-teal-300 mb:block mb:my-2"
        >
          <router-link :to="{ name: $route.name == 'dashboard' ? 'logout' : 'dashboard' }">{{ $route.name == 'dashboard' ? 'ອອກຈາກລະບົບ':'ສໍາລັບຜູ້ເບິ່ງແຍງລະບົບ' }}</router-link>
        </span>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data: () => {
    return {
      isOpen: false,
      currentRoute: ''
    };
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    },
  }
};
</script>
