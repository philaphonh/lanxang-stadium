<template>
  <div id="reservation" class="flex flex-col items-center w-4/5 my-4 mx-auto">
    <div class="text-2xl my-4">
      <h1>Reservation Page | ໜ້າຕາຕະລາງການຈອງເດີ່ນ</h1>
    </div>
    <div>
      <form @submit.prevent class="inline-flex items-center">
        <div class="mx-2">
          <label for="date" class="text-2xl">ເລືອກວັນທີ</label>
        </div>
        <div class="mx-2">
          <input
            type="date"
            name="date"
            id="date"
            class="bg-gray-700 text-white text-center w-full px-6 py-2 my-2 rounded-full shadow-lg"
            v-model="date"
            required
          />
        </div>
        <div class="mx-2">
          <button
            @click="search()"
            class="bg-gray-700 text-white rounded-full px-4 py-2 shadow-lg"
          >ຄົ້ນຫາ</button>
        </div>
      </form>
    </div>
    <div class="text-2xl text-center my-4">
      <h2>Schedule | ຕາຕະລາງເວລາ</h2>
      <hr class="border border-gray-700 border-solid" />
      <h2 v-if="date">
        ວັນທີ:
        <span>{{ date | moment("DD/MM/YYYY") }}</span>
      </h2>
    </div>
    <div>
      <table class="border-2 border-gray-300 bg-white shadow-lg border-collapse text-center">
        <thead>
          <tr>
            <th
              v-for="s of stadiumInfo"
              v-bind:key="s.stadium_id"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{ s.stadium_name }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(t,i) of timeInfo" v-bind:key="i">
            <td
              :class="stadium1.includes(t) && stadium1 ? 'text-green-500' : 'text-red-500'"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{t.time}}</td>
            <td
              :class="stadium2.includes(t) && stadium2 ? 'text-green-500' : 'text-red-500'"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{t.time}}</td>
            <td
              :class="stadium3.includes(t) && stadium3 ? 'text-green-500' : 'text-red-500'"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{t.time}}</td>
            <td
              :class="stadium4.includes(t) && stadium4 ? 'text-green-500' : 'text-red-500'"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{t.time}}</td>
            <td
              :class="stadium5.includes(t) && stadium5 ? 'text-green-500' : 'text-red-500'"
              class="border border-gray-300 border-solid px-4 py-2"
            >{{t.time}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import moment from "moment";

export default {
  data: () => {
    return {
      stadiumInfo: [],
      stadium1: [],
      stadium2: [],
      stadium3: [],
      stadium4: [],
      stadium5: [],
      timeInfo: [],
      date: moment()
    };
  },
  created() {
    this.fetchStadium();
    this.fetchTime();
  },
  methods: {
    fetchStadium() {
      axios
        .get("/api/stadiuminfo")
        .then(res => {
          this.stadiumInfo = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
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
    search() {
      this.stadium1 = [];
      this.stadium2 = [];
      this.stadium3 = [];
      this.stadium4 = [];
      this.stadium5 = [];
      axios
        .get("/api/reservationinfobydateandstadium", {
          params: {
            selecteddate: moment(this.date).format("YYYY-MM-DD"),
            stadium: parseInt(1)
          }
        })
        .then(res => {
          let reservedTime = [];
          res.data.info.forEach(i => {
            reservedTime.push(
              this.timeInfo.find(t => t.time_id == i.selected_time_id)
            );
          });
          this.timeInfo.forEach(t => {
            if (!reservedTime.includes(t)) {
              this.stadium1.push(t);
            }
          });
        })
        .catch(err => {
          console.log(err);
        });
      axios
        .get("/api/reservationinfobydateandstadium", {
          params: {
            selecteddate: moment(this.date).format("YYYY-MM-DD"),
            stadium: parseInt(2)
          }
        })
        .then(res => {
          let reservedTime = [];
          res.data.info.forEach(i => {
            reservedTime.push(
              this.timeInfo.find(t => t.time_id == i.selected_time_id)
            );
          });
          this.timeInfo.forEach(t => {
            if (!reservedTime.includes(t)) {
              this.stadium2.push(t);
            }
          });
        })
        .catch(err => {
          console.log(err);
        });
      axios
        .get("/api/reservationinfobydateandstadium", {
          params: {
            selecteddate: moment(this.date).format("YYYY-MM-DD"),
            stadium: parseInt(3)
          }
        })
        .then(res => {
          let reservedTime = [];
          res.data.info.forEach(i => {
            reservedTime.push(
              this.timeInfo.find(t => t.time_id == i.selected_time_id)
            );
          });
          this.timeInfo.forEach(t => {
            if (!reservedTime.includes(t)) {
              this.stadium3.push(t);
            }
          });
        })
        .catch(err => {
          console.log(err);
        });
      axios
        .get("/api/reservationinfobydateandstadium", {
          params: {
            selecteddate: moment(this.date).format("YYYY-MM-DD"),
            stadium: parseInt(4)
          }
        })
        .then(res => {
          let reservedTime = [];
          res.data.info.forEach(i => {
            reservedTime.push(
              this.timeInfo.find(t => t.time_id == i.selected_time_id)
            );
          });
          this.timeInfo.forEach(t => {
            if (!reservedTime.includes(t)) {
              this.stadium4.push(t);
            }
          });
        })
      axios
        .get("/api/reservationinfobydateandstadium", {
          params: {
            selecteddate: moment(this.date).format("YYYY-MM-DD"),
            stadium: parseInt(5)
          }
        })
        .then(res => {
          let reservedTime = [];
          res.data.info.forEach(i => {
            reservedTime.push(
              this.timeInfo.find(t => t.time_id == i.selected_time_id)
            );
          });
          this.timeInfo.forEach(t => {
            if (!reservedTime.includes(t)) {
              this.stadium5.push(t);
            }
          });
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
