<template>
  <div id="dashboard" class="flex flex-col w-4/5 mx-auto my-4 items-center">
    <div class="text-2xl text-center my-4">
      <h1>Dashboard | ກະດານວຽກ</h1>
      <p>ສະບາຍດີທ່ານ {{ adminFullName }}</p>
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
          <button @click="getReservationInfoByDate()" class="bg-gray-700 text-white rounded-full px-4 py-2 shadow-lg">ຄົ້ນຫາ</button>
          <button @click="refresh()" class="bg-gray-700 text-white rounded-full px-4 py-2 shadow-lg">ໂຫຼດໃໝ່</button>
        </div>
      </form>
    </div>
    <div class="text-2xl my-4">
      <h2>ຂໍ້ມູນການຈອງເດີ່ນ</h2>
      <h2 v-if="date">
        ວັນທີ:
        <span>{{ date | moment("DD/MM/YYYY") }}</span>
      </h2>
      <hr class="border border-gray-700 border-solid" />
    </div>
    <div>
      <table
        v-if="reservationInfo"
        class="border-2 border-gray-300 bg-white shadow-lg border-collapse text-center"
      >
        <thead>
          <tr>
            <th class="border border-gray-300 border-solid px-4 py-2">ລໍາດັບ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ຊື່ຜູ້ຈອງ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ຈອງເມື່ອ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ເດີ່ນ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ເວລາ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ສະຖານະການເຊັກອິນ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(r, index) of reservationInfo" :key="r.reservation_id">
            <td class="border border-gray-300 border-solid px-4 py-2">{{index + 1}}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{r.customer_name}}</td>
            <td
              class="border border-gray-300 border-solid px-4 py-2"
            >{{r.reserve_date | moment("DD/MM/YYYY HH:mm:ss")}}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{r.stadium_name}}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{r.time}}</td>
            <td
              class="border border-gray-300 border-solid px-4 py-2"
            >{{r.is_checked_in ? 'ເຊັກອິນແລ້ວ' : 'ຍັງບໍ່ໄດ້ເຊັກອິນ'}}</td>
            <td>
              <button
                @click="checkin(r.reservation_id)"
                class="px-4 py-2 text-white rounded"
                :class="r.is_checked_in ? 'bg-green-500' : 'bg-gray-700'"
              >{{ r.is_checked_in ? 'ເຊັກອິນແລ້ວ' : 'ເຊັກອິນ' }}</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="text-2xl my-4">
      <h2>ຂໍ້ມູນການຕິດຕໍ່</h2>
      <hr class="border border-gray-700 border-solid" />
    </div>
    <div>
      <table
        v-if="contactInfo"
        class="border-2 border-gray-300 bg-white shadow-lg border-collapse text-center"
      >
        <thead>
          <tr>
            <th class="border border-gray-300 border-solid px-4 py-2">ລໍາດັບ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ຊື່ຜູ້ຕິດຕໍ່</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ໝາຍເລກໂທລະສັບ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ອີເມວ</th>
            <th class="border border-gray-300 border-solid px-4 py-2">ຂໍ້ຄວາມ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(c, index) of contactInfo" :key="c.contact_id">
            <td class="border border-gray-300 border-solid px-4 py-2">{{ index + 1 }}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{ c.customer_name }}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{ c.customer_tel }}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{ c.customer_email }}</td>
            <td class="border border-gray-300 border-solid px-4 py-2">{{ c.customer_message }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import Axios from "axios";
import moment from "moment";
export default {
  data: () => {
    return {
      adminFullName: "",
      reservationInfo: [],
      contactInfo: [],
      date: ""
    };
  },
  created() {
    this.getAdminInfo();
    this.getReservationInfo();
    this.getContactInfo();
  },
  methods: {
    getAdminInfo() {
      Axios.get("/api/admininfo", {
        params: { id: parseInt(localStorage.getItem("admin"), 10) }
      })
        .then(res => {
          const adminInfo = res.data.info[0];
          this.adminFullName =
            adminInfo.admin_first_name + " " + adminInfo.admin_last_name;
        })
        .catch(err => {
          console.log(err);
        });
    },
    getReservationInfo() {
      Axios.get("/api/reservationinfo")
        .then(res => {
          this.reservationInfo = res.data.info;
          console.log(this.reservationInfo);
        })
        .catch(err => {
          console.log(err);
        });
    },
    getReservationInfoByDate() {
      if (this.date !== "") {
        Axios.get("/api/reservationinfobydate", {
          params: { selecteddate: moment(this.date).format("YYYY-MM-DD") }
        })
          .then(res => {
              this.reservationInfo = res.data.info;
          })
          .catch(err => {
              console.log(err);
          });
      }
    },
    refresh() {
        this.date = "";
        this.getReservationInfo();
    },
    getContactInfo() {
      Axios.get("/api/contactinfo")
        .then(res => {
          this.contactInfo = res.data.info;
          console.log(this.contactInfo);
        })
        .catch(err => {
          console.log(err);
        });
    },
    checkin(id) {
      Axios.put("/api/checkin/" + parseInt(id))
        .then(res => {
          if (res.data.message == "Successful") {
            console.log("Yes");
            this.getReservationInfo();
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
