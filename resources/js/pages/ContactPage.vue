<template>
  <div id="contact" class="flex flex-col items-center w-4/5 my-4 mx-auto">
    <div class="text-2xl my-4">
      <h1>Contact Page | ໜ້າຕິດຕໍ່</h1>
    </div>
    <div class="w-full max-w-xl">
      <form @submit.prevent class="bg-white shadow-lg rounded p-4">
        <div class="my-2">
          <label for="name" class="block mb-2">ຊື່ຜູ້ຕິດຕໍ່</label>
          <input
            v-model="name"
            id="name"
            type="text"
            placeholder="ຊື່ຜູ້ຕິດຕໍ່"
            class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
          />
          <p v-if="nameErr" class="text-red-500">{{ nameErr }}</p>
        </div>
        <div class="my-2">
          <label for="tel" class="block mb-2">ໝາຍເລກຜູ້ຕິດຕໍ່</label>
          <input
            v-model="tel"
            id
            type="tel"
            placeholder="ໝາກເລກໂທລະສັບຜູ້ຕິດຕໍ່"
            class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
          />
          <p v-if="telErr" class="text-red-500">{{ telErr }}</p>
        </div>
        <div class="my-2">
          <label for="email" class="block mb-2">ເມວຜູ້ຕິດຕໍ່</label>
          <input
            v-model="email"
            id
            type="mail"
            placeholder="ອີເມວຜູ້ຕິດຕໍ່"
            class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
          />
          <p v-if="emailErr" class="text-red-500">{{ emailErr }}</p>
        </div>
        <div class="my-2">
          <label for="message" class="block mb-2">ຂໍ້ຄວາມ</label>
          <textarea
            v-model="message"
            placeholder="ຂໍ້ຄວາມ"
            class="w-full rounded px-4 appearance-none py-2 border border-solid border-gray-500"
            name="message"
            id="message"
          ></textarea>
          <p v-if="messageErr" class="text-red-500">{{ messageErr }}</p>
        </div>
        <div class="my-2">
          <button @click.prevent="submit" class="bg-gray-700 text-white rounded-full px-4 py-2">ສົ່ງ</button>
          <p v-if="sent" class="mt-2 text-green-500">ສົ່ງຂໍ້ມູນສໍາເລັດແລ້ວ!</p>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import Axios from "axios";
export default {
  data: () => {
    return {
      name: "",
      nameErr: "",
      tel: "",
      telErr: "",
      email: "",
      emailErr: "",
      message: "",
      messageErr: "",
      sent: false
    };
  },
  methods: {
    submit() {
      if (this.name == "") {
        this.nameErr = "ກະລຸນາໃສ່ຊື່ຂອງທ່ານ";
      } else {
        this.nameErr = "";
      }

      if (this.tel == "") {
        this.telErr = "ກະລຸນາໃສ່ໝາຍເລກໂທລະສັບຂອງທ່ານ";
      } else {
        this.telErr = "";
      }

      if (this.email == "") {
        this.emailErr = "ກະລຸນາໃສ່ອີເມວຂອງທ່ານ (ຖ້າບໍ່ມີໃຫ້ໃສ່ none@none.com)";
      } else {
        this.emailErr = "";
      }

      if (this.message == "") {
        this.messageErr = "ກະລຸນາພິມຂໍ້ຄວາມຂອງທ່ານ";
      } else {
        this.messageErr = "";
      }

      if (
        this.nameErr == "" &&
        this.telErr == "" &&
        this.emailErr == "" &&
        this.messageErr == ""
      ) {
        Axios.post("/api/send", {
          name: this.name,
          tel: this.tel,
          email: this.email,
          message: this.message
        })
          .then(res => {
            if (res.data.message == "Successful") {
              this.sent = true;
              setTimeout(() => {
                this.sent = false;
              }, 3000);
            }
          })
          .catch(err => {
              console.log(err);
          });
      }
    }
  }
};
</script>
