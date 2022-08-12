<template>
    <div class="container">
        <div class="row justify-content-center" v-for="(tubuyaki, index) in tubuyakis" :key="index">
            <div class="card w-50 mb-2">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ tubuyaki.id }}
                        <span class="text-muted small">{{ getIsEdited(tubuyaki) }}</span>
                    </div>
                    <router-link v-bind:to="{ name: 'show', params: { tubuyakiId: tubuyaki.id } }">
                        <button class="btn btn-primary">編集</button>
                    </router-link>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ tubuyaki.contents }}</p>
                    <div class="container">
                        <div class="row">


                    <div
                        class="mb-2 col-6"
                        v-for="(image, index) in tubuyaki.images"
                        :key="index"
                        >
                        <img
                            :src="image.file_path"
                        />
                    </div>
                </div>
            </div>

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
        getIsEdited(tubuyaki) {
            return tubuyaki.is_edited ? '編集済み' : '';
        }
    },
    mounted() {
        this.getTubuyakies();
    },
};
</script>
