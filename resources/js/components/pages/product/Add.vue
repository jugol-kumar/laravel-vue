<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveProduct()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" v-model="from.title" class="form-control form-control-solid" placeholder="Enter Product Title">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Buying price</label>
                                <input type="number" v-model="from.buying_price" class="form-control form-control-solid" placeholder="Enter Buying price">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Selling price</label>
                                <input type="number" v-model="from.selling_price" class="form-control form-control-solid" placeholder="Enter Selling price">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Supplier id</label>
                                <select class="form-control form-control-solid"  v-model="from.supplier_id">
                                    <option value="" selected disabled="true">~~Select Brand Id~~</option>
                                    <option v-for="(supp, i) in suppliers" :value="supp.id">{{ supp.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Category id</label>
                                <select class="form-control form-control-solid" v-model="from.cat_id">
                                    <option value="" selected disabled="true">~~Select Category Id~~</option>
                                    <option v-for="(cat, i) in categories" :value="cat.id">{{ cat.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Brand id</label>
                                <select class="form-control form-control-solid" v-model="from.brand_id">
                                    <option value="" selected disabled="true">~~Select Supplier Id~~</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Summary</label>
                                <textarea type="text" v-model="from.summary" class="form-control form-control-solid" rows="5" placeholder="Enter sum product summery"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea type="text" v-model="from.description" class="form-control form-control-solid" rows="5" placeholder="Enter product Details"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Product Stoke</label>
                                <input type="number" v-model="from.stock" class="form-control form-control-solid" placeholder="Enter Product Title">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Godwin Root</label>
                                <input type="text" v-model="from.root" class="form-control form-control-solid" placeholder="Enter Product Title">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control"  @change="uploadFile">
                    </div>
                    <img :src="from.photo" alt="" style="width: 180px;height: 120px;">
                    <span @click="deleteImage()" class="deleteImage" v-show="from.photo">x</span>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>


    </div>
</template>

<script>
export default {
    name: "Add",
    data(){
        return{
            from: {
                title: '',
                summary: '',
                description:'',
                stock: '',
                brand_id: '',
                cat_id : '',
                supplier_id:'',
                photo:'',
                root:'',
                buying_price:'',
                selling_price:'',
            },
            errors:{},
            categories:{},
            suppliers:{},
        }
    },
    methods: {
        uploadFile(event){
            let File = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                this.from.photo = event.target.result
            }
            reader.readAsDataURL(File);
        },
        saveProduct(){
            axios.post('api/product', this.from)
            .then( res => {
                this.from= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        deleteImage(){
            this.from.photo = ''
        },
        allCategory(){
            axios.get('/api/category')
            .then(res => {
                console.log(res.data)
                this.categories = res.data
            })
            .catch(err => {
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
        allSuppliers(){
            axios.get('/api/supplier')
            .then(res => {
                console.log(res.data)
                this.suppliers = res.data
            })
            .catch(err => {
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        },
    },
    created() {
        this.allCategory();
        this.allSuppliers();
    }
}
</script>

<style scoped>
.deleteImage{
    position: relative;
    top: -41px;
    left: -31px;
    width: 20px;
    height: 20px;
    background: #00000014;
    display: inline-block;
    color: #efcdcd;
    border-radius: 15px;
    border: none;
    padding: 2px 6px;
    transition: 0.3s all ease;
    cursor:pointer;
}
.deleteImage:hover{
    background: #000;
}
</style>
