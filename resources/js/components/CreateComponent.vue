<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <router-link :to="{name:'list'}"><button class="btn btn-primary">戻る</button></router-link>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form>
                    <div class="form-group row border-bottom">
                        <label for="id" class="col-sm-3 col-form-label">つぶやき</label>
                        <textarea name="" id="id" cols="30" rows="10" v-bind:value="taskId"></textarea>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="title" class="col-sm-3 col-form-label">画像</label>
                        <input type="file">
                    </div>
                    <div class="row border-bottom">
                        <div class="col-6">
                            <router-link :to="{name:'list'}"><button class="btn btn-primary">投稿</button></router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:"show",
    props: {
        taskId: String
    },
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            validationErrors:{},
            processing:false
        }
    },
    methods:{
        async login(){
            alert('logun');
        },
    }
}
</script>
