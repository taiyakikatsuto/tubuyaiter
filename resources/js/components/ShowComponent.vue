<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card w-50">
        <form>
          <div class="card-header">
            <router-link :to="{ name: 'list' }">
              <button class="btn btn-outline-secondary">戻る</button>
            </router-link>
          </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="form-group row border-bottom p-3">
                <textarea
                  class="form-control"
                  name="contents"
                  rows="7"
                  v-model="tubuyaki.contents"
                >
                </textarea>
              </div>
              <div class="form-group row border-bottom">
                <label for="title" class="col-sm-3 col-form-label">画像</label>
                <p v-for="(image, index) in tubuyaki.images" :key="index">
                    {{ image.file_path }}
                </p>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <div class="row">
              <div class="col-6 d-flex flex-row-reverse">
                <button class="btn btn-primary" @click="updateTubuyaki">
                  更新する
                </button>
              </div>
              <div class="col-6 d-flex flex-row">
                <router-link :to="{ name: 'list' }" @click="deleteTubuyaki">
                  <button type="button" class="btn btn-primary">
                    削除する
                  </button>
                </router-link>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "show",
  props: {
    tubuyakiId: String,
  },
  data: function () {
    return {
      tubuyaki: {},
    };
  },
  methods: {
    getTubuyaki() {
      axios.get("/api/tubuyakies/" + this.tubuyakiId).then((res) => {
        this.tubuyaki = res.data;
      });
    },
    updateTubuyaki() {
      axios
        .put("/api/tubuyakies/" + this.tubuyakiId, {
          contents: this.tubuyaki.contents,
        })
        .then((res) => {
          alert("更新しました");
        });
    },
    deleteTubuyaki() {
      axios.delete("/api/tubuyakies/" + this.tubuyakiId).then((res) => {
        alert("削除しました");
      });
    },
  },
  mounted() {
    this.getTubuyaki();
  },
};
</script>
