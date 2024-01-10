<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title text-white font-weight-bolder" style="text-shadow: 3px 1px 15px #e61a8d">
                            Tabela de
                            Grupos Corais</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                    @click="openModalWindow">Adicionar Novo <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive table-striped p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Número de Integrantes</th>
                                <th>Estilo(s)</th>
                                <th>Registado Em</th>
                                <th>Modificar</th>
                            </tr>

                            <tr v-for="grupo in grupos.data" :key="grupo.id">
                                <td>{{ grupo.id }}</td>
                                <td>{{ grupo.nome }}</td>
                                <td>{{ grupo.integrantes }}</td>
                                <td>{{ grupo.estilo}}</td>
                                <td>{{ grupo.created_at | formatDate}}</td>

                                <td>
                                    <router-link :to="{name:'/grupoInfo/id',params:{id:grupo.id},hash:'#item'}">
                                        <i class="fa fa-eye text-success"></i>
                                    </router-link>
                                    |
                                    <a href="#" data-id="grupo.id" @click="editModalWindow(grupo)">
                                        <i class="fa fa-edit text-blue"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteGrupo(grupo.id)" class="text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :data="grupos" @pagination-change-page="loadGrupos">
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

                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Novo Grupo</h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabel">Actualizar Grupo</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editMode ? updateGrupo() : createGrupo()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nome" type="text" name="nome"
                                       placeholder="Nome"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('nome') }">
                                <has-error :form="form" field="nome"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.integrantes" type="number" name="integrantes"
                                       placeholder="Número de Integrantes"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('integrantes') }"
                                       max="200" min="3">
                                <has-error :form="form" field="integrantes"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.estilo" type="text" name="estilo" id="password"
                                       placeholder="Estilos de Música"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('estilo') }">
                                <has-error :form="form" field="estilo"></has-error>
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
                grupos: {},
                form: new Form({
                    id: '',
                    nome: '',
                    integrantes: '',
                    estilo: '',
                })
            }
        },
        mounted() {
            //mostra o resultado inicial
            this.loadGrupos();
        },
        methods: {

            editModalWindow(grupo) {
                this.form.clear();
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(grupo)
            },
            updateGrupo() {
                this.$Progress.start()

                this.form.put('api/grupo/' + this.form.id)

                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Grupo Coral actualizado com sucesso.'
                        })

                        this.$Progress.finish()

                        Fire.$emit('AfterCreatedGrupoLoadIt');

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

            loadGrupos(page = 1) {
                //our get results from a laravel endpoint
                axios.get("api/grupo?page=" + page)
                    .then(data => (this.grupos = data.data));

                //pick data from controller and push it into users object

            },

            infoGrupo() {
                //our get results from a laravel endpoint
                axios.get("api/grupo/" + this.$route.params.id)
                    .then(result => (this.grupos = result.data));
                console.log(this.grupos);

                //pick data from controller and push it into users object

            },
            createGrupo() {

                this.$Progress.start()

                this.form.post('api/grupo')
                    .then(() => {

                        Fire.$emit('AfterCreatedGrupoLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Grupo Coral cadastrado com successo'
                        })

                        this.$Progress.finish()

                        $('#addNew').modal('hide');

                    })
                    .catch(() => {
                        console.log("Erro......");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel guardar os dados!'
                        });
                    })


                //this.loadUsers();
            },
            deleteGrupo(id) {
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
                        this.form.delete('api/grupo/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Excluído!',
                                    'Grupo Coral excluído com sucesso!',
                                    'success'
                                )
                                this.loadGrupos();

                            }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo correu mal!',
                                footer: '<a href>Porque tenho esse erro?</a>'
                            })
                        })
                    }

                })
            }
        },

        created() {
            this.loadGrupos();

            Fire.$on('AfterCreatedGrupoLoadIt', () => { //custom events fire on
                this.loadGrupos();
            });

        }

    }
</script>