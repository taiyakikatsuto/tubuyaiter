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
                                    maxlength="140"
                                    rows="7"
                                    v-model="contents"
                                ></textarea>
                            </div>
                            <div class="form-group row border-bottom pt-2 pb-2">
                                <div v-if="showImages">
                                    画像が出る予定
                                    <img :src="imagePathes[0]" />
                                </div>
                                    <p
                                        v-for="(path, index) in imagePathes"
                                        :key="index"
                                    >{{ path }}</p>
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
                            <div class="col-12 d-flex justify-content-center">
                                <router-link :to="{ name: 'list' }">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        @click="createTubuyaki"
                                    >つぶやく</button>
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
    name: "create",
    data: function () {
        return {
            contents: null,
            fileInfo: null,
            showImages: false,
            imagePathes: null,
        };
    },
    methods: {
        // つぶやき作成
        createTubuyaki() {
            axios
                .post("/api/tubuyakies", {
                    contents: this.contents,
                    imagePathes: this.imagePathes,
                })
                .then((res) => {
                    alert("つぶやきました");
                });
        },
        // ファイルアップロード
        // 選択と同時にアップロードする
        fileUpload(event) {
            // ファイルがアップロードされていなければ終了
            if (event.target.files.length == 0) {
                return null;
            }
            if (event.target.files.length > 4) {
                alert("4まいまでだよ");
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
    },
};
</script>
