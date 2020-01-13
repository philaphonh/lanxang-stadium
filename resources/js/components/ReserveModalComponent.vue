<template>
  <transition name="fade">
    <div class="fixed w-full h-full inset-0 flex items-center justify-center" v-if="show">
      <div class="relative w-full mb:w-3/4 max-w-2xl bg-white shadow-lg rounded-lg p-8">
        <div class="text-xl text-center">
          <h3>ຈອງເດີ່ນ</h3>
        </div>
        <div>
          <form @submit.prevent>
            <div class="my-2">
              <label for="name" class="block mb-2"></label>
              <input
                v-model="name"
                id="name"
                type="text"
                placeholder="ຊື່ຜູ້ຈອງ"
                class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
              />
              <p v-if="nameErr" class="text-red-500">{{ nameErr }}</p>
            </div>
            <div class="my-2">
              <label for="stadium" class="block mb-2">ເດີ່ນທີ່ຈອງ</label>
              <input
                v-model="stadium"
                id="stadium"
                type="text"
                placeholder="ເດີ່ນທີ່ຈອງ"
                disabled
                class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
              />
            </div>
            <div class="my-2">
              <label for="date" class="block mb-2">ວັນເວລາທີ່ຈອງ</label>
              <input
                v-model="date"
                id="date"
                type="text"
                placeholder="ວັນທີ"
                disabled
                class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
              />
            </div>
            <div class="my-2">
              <label for="selecteddate" class="block mb-2">ວັນທີທີ່ຕ້ອງການນໍາໃຊ້</label>
              <input
                type="date"
                id="selecteddate"
                class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
                v-model="selectedDate"
              />
              <p v-if="selectedDateErr" class="text-red-500">{{selectedDateErr}}</p>
            </div>
            <div class="my-2">
              <label for="time" class="block mb-2">ເວລາ</label>
              <select
                v-model="time"
                id="time"
                class="rounded block appearance-none text-black px-4 py-2 w-full border border-solid border-gray-500"
              >
                <option value disabled>ກະລຸນາເລືອກເວລາ</option>
                <option
                  v-for="t of timeInfo"
                  v-bind:key="t.time_id"
                  v-bind:value="t.time_id"
                >{{ t.time }}</option>
              </select>
              <p v-if="timeErr" class="text-red-500">{{ timeErr }}</p>
            </div>
            <div class="my-2">
              <label for="fee" class="block mb-2">ລາຄາຈອງເປັນເງິນກີບ</label>
              <input
                v-model="fee"
                id="fee"
                type="text"
                placeholder="ລາຄາ"
                disabled
                class="rounded appearance-none px-4 py-2 w-full border border-solid border-gray-500"
              />
            </div>
            <div class="my-2">
              <input type="checkbox" id="confirmed" v-model="confirmed" />
              <span>ຂ້າພະເຈົ້າຍືນຍັນການຈອງໃນຄັ້ງນີ້</span>
            </div>
            <div class="my-2">
              <button
                v-if="!completed"
                v-bind:disabled="!confirmed"
                @click="reserve()"
                class="bg-gray-700 text-white rounded-full px-4 py-2"
              >ຈອງເລີຍ</button>
              <p
                v-if="completed"
                class="text-green-500"
              >ການຈອງຂອງທ່ານສໍາເລັດແລ້ວ ກະລຸນາຈ່າຍເງິນໃນມື້ທີ່ທ່ານເຂົ້າມານໍາໃຊ້ບໍລິການ, ທ່ານສາມາດປິດໜ້ານີ້ໄດ້ເລີຍ!</p>
              <p v-if="alreadyTaken" class="text-red-500">ມີຄົນຈອງເວລານີ້ໄວ້ແລ້ວ!</p>
            </div>
          </form>
        </div>
        <div>
          <button
            @click.prevent="$emit('close')"
            class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
          >X</button>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import moment from "moment";
import axios from "axios";
export default {
  props: [
    "show",
    "sid",
    "stadium",
    "fee",
    "confirmed",
    "completed",
    "alreadyTaken"
  ],
  data: () => {
    return {
      name: "",
      nameErr: "",
      time: "",
      timeErr: "",
      selectedDate: "",
      selectedDateErr: "",
      reservationByDate: [],
      timeInfo: [],
      date: moment().format("DD/MM/YYYY HH:mm:ss")
    };
  },
  created() {
    this.fetchTime();
  },
  methods: {
    fetchTime() {
      axios
        .get("/api/timeinfo")
        .then(res => {
          this.timeInfo = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    reserve() {
      this.alreadyTaken = false;
      if (this.name === "") {
        this.nameErr = "ກະລຸນາໃສ່ຊື່ຂອງທ່ານ";
      } else {
        this.nameErr = "";
      }
      if (this.time === "") {
        this.timeErr = "ກະລຸນາເລືອກເວລາທີ່ຕ້ອງການຈອງ";
      } else {
        this.timeErr = "";
      }

      if (this.selectedDate == "") {
        this.selectedDateErr = "ກະລຸນາເລືອກວັນທີ";
      } else {
        this.selectedDateErr = "";
      }
      if (
        this.nameErr == "" &&
        this.timeErr == "" &&
        this.selectedDateErr == ""
      ) {
        console.log(`
            ${this.name}
            ${this.stadium}: ${this.sid}
            ${moment(this.selectedDate).format("DD/MM/YYYY")}
            ${this.time}
          `);
        axios
          .get("/api/reservationinfobydateandstadium", {
            params: {
              selecteddate: moment(this.selectedDate).format("YYYY-MM-DD"),
              stadium: parseInt(this.sid)
            }
          })
          .then(res => {
            // console.log(res.data.info);
            this.reservationByDate = res.data.info;
            console.log(this.reservationByDate);
            this.reservationByDate.forEach(data => {
              if (
                data.selected_time_id == this.time &&
                data.stadium_id == parseInt(this.sid)
              ) {
                this.alreadyTaken = true;
                console.log("Already Taken");
                return;
              }
            });
          })
          .catch(err => {
            console.log(err);
          });
        axios
          .post("/api/reserve", {
            name: this.name,
            stadium: this.sid,
            time: this.time,
            selecteddate: this.selectedDate
          })
          .then(res => {
            console.log(res.data.message);
            if (res.data.message == "Successful") {
              console.log("Yes");
              this.completed = true;
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
