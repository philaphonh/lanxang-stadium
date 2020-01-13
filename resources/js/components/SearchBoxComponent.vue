<template>
  <div id="search-box" class="w-full mx-auto max-w-sm">
    <form @submit.prevent class="bg-white opacity-75 shadow-lg rounded px-8 py-6 text-center">
      <div class>
        <h3 class="text-2xl">ຄົ້ນຫາເດີ່ນເຕະບານ</h3>
      </div>
      <div class="relative">
        <!-- <input
                    type="text"
                    name="stadium"
                    id="stadium"
                    placeholder="ພິມຊື່ເດີ່ນ"
                    class="bg-gray-700 text-white px-6 py-2 my-2 rounded-full"
                    v-model="stadium"
                    required
        />-->
        <select
          v-model="stadium"
          name="stadium"
          id="stadium"
          class="block appearance-none w-full bg-gray-700 text-white text-center py-2 px-6 rounded-full leading-tight focus:outline-none"
        >
          <option disabled value>ກະລຸນາເລືອກເດີ່ນ</option>
          <option
            v-for="s of stadiumInfo"
            v-bind:key="s.stadium_id"
            v-bind:value="s.stadium_id"
          >{{s.stadium_name}}</option>
        </select>
        <div
          class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white"
        >
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
          </svg>
        </div>
      </div>
      <div>
        <input
          type="date"
          name="datepicker"
          id="datepicker"
          class="bg-gray-700 text-white text-center w-full px-6 py-2 my-2 rounded-full"
          v-model="date"
          required
        />
      </div>
      <div>
        <button
          type="submit"
          @click.prevent="show"
          class="text-white bg-gray-700 px-6 py-2 rounded-full"
        >ຄົ້ນຫາ</button>
      </div>
    </form>
    <Searchmodal
      v-bind:show="showResult"
      v-bind:result="result"
      v-bind:stadium="stadium"
      v-bind:date="date"
      @close="showResult = false"
    ></Searchmodal>
  </div>
</template>
<script>
import axios from "axios";
import Searchmodal from "./SearchModalComponent";
import moment from "moment";

export default {
  data: () => {
    return {
      stadium: "",
      date: "",
      stadiumInfo: [],
      timeInfo: [],
      showResult: false,
      result: []
    };
  },
  created() {
    this.fetchStadium();
    this.fetchTime();
  },
  components: {
    Searchmodal
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
        .catch(err => console.log(err));
    },
    show() {
      this.result = [];
      this.showResult = true;
      if (this.stadium !== "" && this.date !== "") {
        axios
          .get("/api/reservationinfobydateandstadium", {
            params: {
              selecteddate: moment(this.date).format("YYYY-MM-DD"),
              stadium: parseInt(this.stadium)
            }
          })
          .then(res => {
            const info = res.data.info;
            let reservedTime = [];
            info.forEach(i => {
              reservedTime.push(
                this.timeInfo.find(t => t.time_id == i.selected_time_id)
              );
            });
            this.timeInfo.forEach(t => {
                if (!reservedTime.includes(t)) {
                    console.log("Yes");
                    this.result.push(t);
                }
            });
            console.log(this.result);
          })
          .catch(err => {
            console.log(err);
          });
      }
    }
  }
};
</script>
