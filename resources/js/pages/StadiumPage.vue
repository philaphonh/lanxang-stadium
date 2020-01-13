<template>
  <div id="stadium" class="flex flex-col items-center w-4/5 my-4 mx-auto">
    <div class="text-2xl my-4">
      <h1>Stadium | ເດີ່ນເຕະບານ</h1>
    </div>
    <div class="my-4 max-w-xl w-full dt:flex" v-for="s of stadiumInfo" v-bind:key="s.stadium_id">
      <div
        class="h-48 dt:h-auto dt:w-48 flex-none bg-cover rounded-t dt:rounded-t-none dt:rounded-l text-center overflow-hidden"
        style="background-image: url('/img/football.jpeg')"
      ></div>
      <div class="shadow-lg bg-white w-full px-4 py-2">
        <div>
          <h3 class="text-xl">{{ s.stadium_name }}</h3>
          <p>{{ s.stadium_type }}</p>
          <p>{{ s.stadium_capacity }} ຄົນ</p>
          <p>{{ s.stadium_fee }} ກີບຕໍ່ການຈອງ</p>
          <button
            @click="onReserve(s.stadium_id, s.stadium_name, s.stadium_fee)"
            class="bg-gray-700 text-white rounded-full px-4 py-2 my-2"
          >ສັ່ງຈອງ</button>
        </div>
      </div>
    </div>
    <Reservemodal
      v-bind:show="show"
      v-bind:sid="selectedStadiumId"
      v-bind:stadium="selectedStadiumName"
      v-bind:fee="selectedStadiumFee"
      v-bind:confirmed="confirmed"
      v-bind:completed="completed"
      v-bind:alreadyTaken="alreadyTaken"
      @close="show = confirmed = completed = alreadyTaken = false;"
    ></Reservemodal>
  </div>
</template>
<script>
import axios from "axios";
import Reservemodal from "../components/ReserveModalComponent";

export default {
  data: () => {
    return {
      stadiumInfo: [],
      show: false,
      confirmed: false,
      completed: false,
      alreadyTaken: false,
      selectedStadiumId: "",
      selectedStadiumName: "",
      selectedStadiumFee: 0
    };
  },
  components: {
    Reservemodal
  },
  created() {
    this.fetchStadium();
  },
  methods: {
    fetchStadium() {
      axios
        .get("/api/stadiuminfo")
        .then(res => {
          this.stadiumInfo = res.data;
        })
        .catch(err => console.log(err));
    },
    onReserve(id, name, fee) {
      this.show = true;
      this.selectedStadiumId = id;
      this.selectedStadiumName = name;
      this.selectedStadiumFee = fee;
    }
  }
};
</script>
