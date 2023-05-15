<template>
  <div v-if="data.length">
    <ul v-for="datas in data" v-bind:key="datas.id">
      <li>{{ datas.nama }}</li>
    </ul>
  </div>
  <div v-else>
    <h1>Tidak ada data</h1>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: [
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
        {
          nama: "Farish",
        },
      ],
    };
  },
};
</script>

<style></style>
