<template>
  <div
    id="home"
    class="bg-scroll bg-cover px-8 py-4 h-screen"
    style="background-image: url('/img/football.jpeg')"
  >
    <Searchbox></Searchbox>
  </div>
</template>
<script>
import Searchbox from "../components/SearchBoxComponent";

export default {
  components: {
    Searchbox
  }
};
</script>
