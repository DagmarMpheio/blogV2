<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Coins Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Add New <i class="fa fa-plus-circle fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive table-striped p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Price</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>

                            <tr v-for="coin in coins.data" :key="coin.id">
                                <td>{{ coin.id }}</td>
                                <td>{{ coin.name }}</td>
                                <td>{{ coin.year }}</td>
                                <td>{{ coin.price}}</td>
                                <td>{{ coin.created_at | formatDate}}</td>

                                <td>
                                    <a href="#" data-id="coin.id" @click="editModalWindow(coin)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteCoin(coin.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="coins" @pagination-change-page="loadCoins">
                            <span slot="prev-nav">&lt;Previous</span>
                            <span slot="next-nav">Next&gt;</span>
                        </pagination>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>

            </div>
        </div>

        <!--Modal-->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New Coin</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update Coin</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateCoin() : createCoin()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.year" type="number" name="year"
                                       placeholder="Year"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('year') }"
                                       min="1900" max="2090">
                                <has-error :form="form" field="year"></has-error>
                            </div>


                            <div class="form-group">
                                <input v-model="form.price" type="number" name="price"
                                       placeholder="Price"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                            <button v-show="!editMode" type="submit" class="btn btn-success">Create</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <!--<h1 class="text-center text-danger">Ola</h1>-->
    <!--<div class="container">-->
    <!--<div class="row justify-content-center">-->
    <!--<div class="col-md-8">-->
    <!--<div class="card card-default">-->
    <!--<div class="card-header">Add Coin</div>-->
    <!--<div class="card-body">-->
    <!--<div class="card-body table-responsive table-striped p-0">-->
    <!--<table class="table table-hover">-->
    <!--<tbody>-->
    <!--<tr>-->
    <!--<th>ID</th>-->
    <!--<th>Name</th>-->
    <!--<th>Year</th>-->
    <!--<th>Price</th>-->
    <!--<th>Registered At</th>-->
    <!--<th>Modify</th>-->
    <!--</tr>-->

    <!--<tr v-for="coin in coins.data" :key="coin.id">-->
    <!--<td>{{ coin.id }}</td>-->
    <!--<td>{{ coin.name }}</td>-->
    <!--<td>{{ coin.year }}</td>-->
    <!--<td>{{ coin.price }}</td>-->
    <!--<td>{{ coin.created_at | formatDate}}</td>-->

    <!--<td>-->
    <!--<a href="#" data-id="coin.id" @click="editModalWindow(coin)">-->
    <!--<i class="fa fa-edit blue"></i>-->
    <!--</a>-->
    <!--|-->
    <!--<a href="#" @click="deleteCoin(coin.id)">-->
    <!--<i class="fa fa-trash red"></i>-->
    <!--</a>-->

    <!--</td>-->
    <!--</tr>-->
    <!--</tbody>-->
    <!--</table>-->
    <!--<pagination :data="users" @pagination-change-page="loadTableData">-->
    <!--<span slot="prev-nav">&lt;Previous</span>-->
    <!--<span slot="next-nav">Next&gt;</span>-->
    <!--</pagination>-->
    <!--</div>-->

    <!--<form @submit.prevent="addCoin">-->
    <!--<div class="form-group row">-->
    <!--<label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>-->
    <!--<div class="col-md-6">-->
    <!--<input type="text" name="" id="name" class="form-control" v-model="coin.name"-->
    <!--required-->
    <!--autofocus>-->
    <!--</div>-->
    <!--</div>-->

    <!--<div class="form-group row">-->
    <!--<label for="year" class="col-sm-4 col-form-label text-md-right">Year</label>-->
    <!--<div class="col-md-6">-->
    <!--<input type="text" name="" id="year" class="form-control" v-model="coin.year"-->
    <!--required-->
    <!--autofocus>-->
    <!--</div>-->
    <!--</div>-->

    <!--<div class="form-group row">-->
    <!--<label for="price" class="col-sm-4 col-form-label text-md-right">Price</label>-->
    <!--<div class="col-md-6">-->
    <!--<input type="text" name="" id="price" class="form-control" v-model="coin.price"-->
    <!--required-->
    <!--autofocus>-->
    <!--</div>-->
    <!--</div>-->

    <!--<div class="form-group row mb-0">-->
    <!--<div class="col-md-8 offset-md-4">-->
    <!--<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add</button>-->
    <!--</div>-->
    <!--</div>-->
    <!--</form>-->
    <!--</div>-->
    <!--</div>-->

    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                coins: {},
                form: new Form({
                    id: '',
                    name: '',
                    year: '',
                    price: '',

                })
            }
        },
        mounted() {
            //mostra o resultado inicial
            this.loadCoins();
        },
        methods: {

            editModalWindow(coin) {
                this.form.clear();
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(coin)
            },
            updateCoin() {
                this.$Progress.start()

                this.form.put('api/coin/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Coin updated successfully'
                        })

                        this.$Progress.finish()

                        Fire.$emit('AfterCreatedCoinLoadIt');

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        console.log("Error.....")
                    })
            },
            openModalWindow() {
                this.editMode = false
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadCoins(page = 1) {
                //our get results from a laravel endpoint
                axios.get("api/coin?page=" + page)
                    .then(data => (this.coins = data.data));

                //pick data from controller and push it into users object

            },

            createCoin() {

                this.$Progress.start()

                this.form.post('api/coin')
                    .then(() => {

                        Fire.$emit('AfterCreatedCoinLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Coin created successfully'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                    })
                    .catch(() => {
                        console.log("Error......")
                    })


                //this.loadUsers();
            },
            deleteCoin(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.value) {
                        //Send Request to server
                        this.form.delete('api/coin/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Deleted!',
                                    'Coin deleted successfully',
                                    'success'
                                )
                                this.loadCoins();

                            }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })
                        })
                    }

                })
            }
        },

        created() {
            this.loadCoins();

            Fire.$on('AfterCreatedCoinLoadIt', () => { //custom events fire on
                this.loadCoins();
            });

        }

    }
</script>

<style scoped>

</style>