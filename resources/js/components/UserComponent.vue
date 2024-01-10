<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Tabela Usuários</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Adicionar Novo <i class="fa fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive table-striped p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Registado Em</th>
                                <th>Modificar</th>
                            </tr>

                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type | strToUpper}}</td>
                                <td>{{ user.created_at | formatDate}}</td>

                                <td>
                                    <a href="#" data-id="user.id" @click="editModalWindow(user)">
                                        <i class="fa fa-edit text-blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteUser(user.id)" class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="users" @pagination-change-page="loadUsers">
                            <span slot="prev-nav">&lt;Anterior</span>
                            <span slot="next-nav">Próximo&gt;</span>
                        </pagination>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Novo Usuário</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabel">Actualizar Usuário</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Nome"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="exemplo@user.com"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>


                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password"
                                       placeholder="Introduza a senha"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                                       autocomplete="new-password">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Seleccione o Tipo de Usuário</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Fechar
                            </button>
                            <button v-show="editMode" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                Actualizar
                            </button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                Criar
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',

                })
            }
        },
        mounted() {
            //mostra o resultado inicial
            this.loadUsers();
        },
        methods: {

            editModalWindow(user) {
                this.form.clear();
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user)
            },
            updateUser() {
                this.$Progress.start()

                this.form.put('api/user/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Usuário actualizado com sucesso.'
                        })

                        this.$Progress.finish()

                        Fire.$emit('AfterCreatedUserLoadIt');

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        console.log("Erro.....");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel alterar os dados!'
                        });
                    })
            },
            openModalWindow() {
                this.editMode = false
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadUsers(page = 1) {
                //our get results from a laravel endpoint
                axios.get("api/user?page=" + page)
                    .then(data => (this.users = data.data));

                //pick data from controller and push it into users object

            },

            createUser() {

                this.$Progress.start()

                this.form.post('api/user')
                    .then(() => {

                        Fire.$emit('AfterCreatedUserLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Usuário cadastrado com successo'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                    })
                    .catch(() => {
                        console.log("Error......");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel guardar os dados!'
                        });
                    })


                //this.loadUsers();
            },
            deleteUser(id) {
                Swal.fire({
                    title: 'Tem a certeza?',
                    text: "Você não será permitido para reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim, exclua-o!'
                }).then((result) => {

                    if (result.value) {
                        //Send Request to server
                        this.form.delete('api/user/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Excluído!',
                                    'Usuário excluído com sucesso!',
                                    'success'
                                )
                                this.loadUsers();

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
            this.loadUsers();

            Fire.$on('AfterCreatedUserLoadIt', () => { //custom events fire on
                this.loadUsers();
            });

        }

    }
</script>