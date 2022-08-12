<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-50">
                <form>
                    <div class="card-header d-flex justify-content-between">
                        <router-link :to="{ name: 'list' }">
                            <button class="btn btn-outline-secondary">戻る</button>
                        </router-link>
                        <span class="text-muted small">{{ isEdited }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group row border-bottom p-3">
                                <textarea
                                    class="form-control"
                                    name="contents"
                                    rows="7"
                                    v-model="tubuyaki.contents"
                                ></textarea>
                            </div>
                            <div class="form-group row border-bottom pt-2 pb-2">
                                <div class="container">
                                    <div class="row">
                                        <div
                                            class="mb-2 col-6"
                                            v-for="(image, index) in tubuyaki.images"
                                            :key="index"
                                        >
                                            <img :src="image.file_path" />
                                        </div>
                                        <div
                                            class="mb-2 col-6"
                                            v-for="(path, index) in imagePathes"
                                            :key="index"
                                        >
                                            <img :src="path" />
                                        </div>
                                    </div>
                                </div>

                                <input
                                    @change="fileUpload"
                                    class="form-control"
                                    type="file"
                                    id="formFileMultiple"
                                    multiple
                                    accept="image/*"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-6 d-flex flex-row-reverse">
                                <button class="btn btn-primary" @click="updateTubuyaki">更新する</button>
                            </div>
                            <div class="col-6 d-flex flex-row">
                                <router-link :to="{ name: 'list' }" @click="deleteTubuyaki">
                                    <button type="button" class="btn btn-primary">削除する</button>
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
            imagePathes: []
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
                    imagePathes: this.imagePathes,
                })
                .then((res) => {
                    alert("更新しました");
                });
        },
        // ファイルアップロード
        // 選択と同時にアップロードする
        fileUpload(event) {
            // ファイルがアップロードされていなければ終了
            if (event.target.files.length == 0) {
                return null;
            }
            // 既存のファイルと合わせて４枚以上なら終了
            const existFileCount = Object.keys(this.tubuyaki.images).length;
            if (event.target.files.length + existFileCount > 4) {
                alert("写真は4枚までです");
                this.imagePathes = [];
                return null;
            }

            // ヘッダー定義
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            this.fileInfo = Object.keys(event.target.files).map(function (key) {
                return event.target.files[key];
            });
            const formData = new FormData();
            // FormDataにアップロードファイルを追加していく
            this.fileInfo.forEach((file, index) => {
                formData.append("images[" + index + "]", file);
            });
            axios.post("/api/images/upload", formData, config).then((response) => {
                console.log(response);
                this.imagePathes = response.data.imagePathes;
                if (response.data.imagePathes.length) {
                    this.showImages = true;
                }
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
    computed: {
        isEdited: function () {
            return this.tubuyaki.is_edited ? '編集済み' : '';
        }
    }
};
</script>
