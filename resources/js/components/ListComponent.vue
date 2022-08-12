<template>
  <div class="container">
    <div
      class="row justify-content-center"
      v-for="(tubuyaki, index) in tubuyakis"
      :key="index"
    >
      <div class="card w-50 mt-2">
        <div class="card-header d-flex justify-content-between">
          {{ tubuyaki.id }}
          <router-link
            v-bind:to="{ name: 'show', params: { tubuyakiId: tubuyaki.id } }"
          >
            <button class="btn btn-primary">編集</button>
          </router-link>
        </div>
        <div class="card-body">
          <p class="card-text">
            {{ tubuyaki.contents }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "list",
  data: function () {
    return {
      tubuyakis: {},
    };
  },
  methods: {
    getTubuyakies() {
      axios
        .get("/api/tubuyakies")
        .then((res) => {
          this.tubuyakis = res.data;
        })
        .catch((error) => {
          console.log(error.response);
          router.push({ name: "list" });
        });
    },
  },
  mounted() {
    this.getTubuyakies();
  },
};
</script>
