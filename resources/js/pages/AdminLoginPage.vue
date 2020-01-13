<template>
  <div id="login" class="flex flex-col w-4/5 mx-auto my-4 items-center">
    <div class="text-2xl my-4">
      <h1>Admin Login | ເຂົ້າສູ່ລະບົບສໍາລັບຜູ້ເບິ່ງແຍງລະບົບ</h1>
    </div>
    <div class="w-full max-w-lg">
      <form method="post" @submit.prevent class="bg-white shadow-lg rounded p-4">
        <div class="my-2">
          <label for="username" class="block mb-2">ຊື່ຜູ້ໃຊ້</label>
          <input
            id="username"
            type="text"
            v-model="username"
            placeholder="ຊື່ຜູ້ໃຊ້"
            class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
          />
        </div>
        <div class="my-2">
          <label for="password" class="block mb-2">ລະຫັດຜ່ານ</label>
          <input
            id="password"
            type="password"
            v-model="password"
            placeholder="ລະຫັດຜ່ານ"
            class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
          />
        </div>
        <div class="my-2">
          <button
            type="submit"
            @click="login()"
            class="bg-gray-700 text-white rounded-full px-4 py-2"
          >ເຂົ້າສູ່ລະບົບ</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data: () => {
    return {
      username: "",
      password: ""
    };
  },
  methods: {
    login() {
      axios
        .post("/api/login", {
          username: this.username,
          password: this.password
        })
        .then(res => {
          if (res.data.message === "Authenticated") {
            localStorage.setItem("admin", res.data.admin[0].id);
            this.$router.push({ name: "dashboard" });
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
