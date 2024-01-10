<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white font-weight-bolder text-center"
                            style="text-shadow: 3px 1px 15px #e61a8d">Dados do Grupo</h3>
                        <router-link to="/addGroup" class="btn btn-outline-danger"><i class="fa fa-backward"></i> Voltar
                        </router-link>
                    </div>
                    <div class="card-body" v-for="grupo in grupos" :key="grupo.id">
                        <div class="row">
                            <div class="col-lg-auto">
                                <p class="card-text"><b>Nome:</b> {{grupo.nome}}</p>
                                <p class="card-text"><b>Número de Integrantes:</b> {{grupo.integrantes}}</p>
                                <p class="card-text"><b>Estilo(s):</b> {{grupo.estilo}}</p>

                                <button class="btn btn-success" data-toggle="modal" data-target="#addNew"
                                        @click="openModalWindow">Novo Membro
                                    <i class="fa fa-plus-circle fa-fw"></i>
                                </button>

                            </div>
                            <br><br>
                            <div class="col-lg-9">
                                <h3 class="card-title text-center">Membros do grupo</h3>
                                <table class="table table-hover table-responsive table-stripped">
                                    <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome Completo</th>
                                        <th>Nome Artistíco</th>
                                        <th>Genero</th>
                                        <th>Idade</th>
                                        <th>Instrumento</th>
                                        <th>Categoria de Instrumento</th>
                                        <th>Foto</th>
                                        <th>Modificar</th>
                                    </tr>
                                    <tr v-for="singer in singers.data" :key="singer.id">
                                        <td>{{singer.id}}</td>

                                        <td>{{singer.nomeCompleto}}</td>
                                        <td>{{singer.nomeArtistico}}</td>
                                        <td>{{singer.genero}}</td>
                                        <td>{{singer.dataNascimento|formatDate}}</td>
                                        <td>{{singer.nomeInstrumento}}</td>
                                        <td>{{singer.tipoCategoria}}</td>
                                        <td><img :src="`uploads/${singer.foto}`" alt="" class="rounded-circle"
                                                 width="70" height="70"></td>

                                        <td>
                                            <a v-bind:href="'/dashboard#/cantorInfo/'+singer.id+'#item'">
                                                <i class="fa fa-eye text-success"></i>
                                            </a>
                                            |
                                            <router-link :to="{name:'/grupoInfo/id',params:{id:singer.id},hash:'#item'}"
                                                         data-id="singer.id" @click.native="editModalWindow(singer)">
                                                <i class="fa fa-edit text-primary"></i>
                                            </router-link>
                                            |
                                            <router-link :to="{name:'/grupoInfo/id',params:{id:singer.id},hash:'#item'}"
                                                         data-id="singer.id" @click.native="deleteSinger(singer.id)">
                                                <i class="fa fa-trash text-danger"></i>
                                            </router-link>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <pagination :data="singers" @pagination-change-page="loadSingers">
                                    <span slot="prev-nav">&lt;Anterior</span>
                                    <span slot="next-nav">Próximo&gt;</span>
                                </pagination>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Novo Membro do Grupo</h5>
                            <h5 v-show="editMode" class="modal-title" id="addNewLabel">Actualizar Membro do Grupo</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!--mostrar a- foto escolhida-->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" :src="getPhoto()"
                                         alt="Foto do cantor" width="250" height="200">
                                </div>
                            </div>
                        </div>

                        <form @submit.prevent="editMode ? updateMember() : createMember()"
                              enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.nomeCompleto" type="text" name="nomeCompleto"
                                           placeholder="Nome Completo"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('nomeCompleto') }"
                                           style="height: auto;">
                                    <has-error :form="form" field="nomeCompleto"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.nomeArtistico" type="text" name="nomeArtistico"
                                           placeholder="Nome Artistíco"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('nomeArtistico') }"
                                           style="height: auto;">
                                    <has-error :form="form" field="nomeArtistico"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="inputDataN" class="col-form-label">Data de Nascimento</label>
                                    <input v-model="form.dataNascimento" type="date" name="dataNascimento"
                                           placeholder="Data de Nascimento"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('dataNascimento') }" id="inputDataN">
                                    <has-error :form="form" field="dataNascimento"></has-error>
                                </div>

                                <div class="form-group">
                                    <select name="genero" v-model="form.genero" id="genero" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('genero') }">
                                        <option value="">Seleccione o Gênero</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    <has-error :form="form" field="genero"></has-error>
                                </div>

                                <div class="form-group">
                                    <select name="instrumento" id="instrumento" class="form-control">
                                        <option value="">Seleccione Tipo de Instrumento</option>
                                        <option value="1">Vocal</option>
                                        <option value="2">Musical</option>
                                    </select>
                                </div>

                                <div class="form-group" id="">
                                    <select name="categoriaInstrumento" v-model="form.categoriaInstrumento"
                                            id="categoriaDiv"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('categoriaInstrumento') }">
                                        <option value="">Seleccione Categoria de Instrumento</option>
                                    </select>
                                    <has-error :form="form" field="categoriaInstrumento"></has-error>
                                </div>

                                <div class="form-group row" id="divFoto">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Foto</label>

                                    <div class="col-sm-10">
                                        <input type="file" @change='uploadPhoto' name="foto"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('foto') }">
                                        <has-error :form="form" field="foto"></has-error>
                                    </div>
                                </div>

                                <!--ID do grupo-->
                                <div class="form-group" v-for="grupo in grupos">
                                    <input type="text" v-model="form.idGrupo=grupo.id.toString()" name="idGrupo"
                                           placeholder="Id Do grupo"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('idGrupo') }"
                                           id="inputGrupo">
                                    <has-error :form="form" field="idGrupo"></has-error>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fa fa-close"></i> Fechar
                                </button>
                                <button v-show="editMode" type="submit" class="btn btn-primary"><i
                                        class="fa fa-edit"></i>
                                    Actualizar
                                </button>
                                <button v-show="!editMode" type="submit" class="btn btn-primary"><i
                                        class="fa fa-save"></i>
                                    Criar
                                </button>
                            </div>

                        </form>

                    </div>
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
                singers: {},
                nome: '',
                integrantes: '',
                estilo: '',

                /*dados do cantor*/
                id: '',
                nomeCompleto: '',
                nomeArtistico: '',
                genero: '',
                dataNascimento: '',
                nomeInstrumento: '',
                tipoCategoria: '',
                foto: '',
                idGrupo: '',

                //campos do formalario
                form: new Form({
                    id: '',
                    nomeCompleto: '',
                    nomeArtistico: '',
                    genero: '',
                    dataNascimento: '',
                    categoriaInstrumento: '',
                    foto: '',
                    idGrupo: '',
                })
            }
        },
        mounted() {
            this.getInfoGrupo();//pegar os dados pelo id

            this.loadSingers();//pegar todos os cantores
            /*this.loadSingers2();*/

            /*preencher o select de categoria*/
            $(document).ready(function () {
                //enquanto mudar de valores faca:
                $('#instrumento').change(function () {
                    $('#categoriaDiv').load('conteudo/listarCategorias.php?instrumento=' + $('#instrumento').val());//pegar o valor selecionado e procura na bd e carregar nno select
                    console.log($('#instrumento').val());
                });
            });
        },
        methods: {
            //pegar os dados pelo id
            getInfoGrupo() {
                axios.get("api/grupo/" + this.$route.params.id)
                    .then(result => (this.grupos = result.data));
            },
            //abrir a modal com os dados para actualizar
            editModalWindow(singer) {
                //this.form.clear();//limpar tudo
                this.editMode = true;//activar o modo de edicao
                this.form.reset();//limpar os campos com os dados anteriores
                $('#addNew').modal('show');//mostrar a modal
                this.form.fill(singer);//preencher os campos com dados
                var div = document.getElementById("divFoto");
                div.hidden = true;//ocultar o campo de foto
            },

            //actualizar dados do membro do grupo
            updateMember() {
                this.$Progress.start()//iniciar o progressBar

                this.form.put('api/singer/' + this.form.id)

                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Cantor actualizado com sucesso.'
                        })

                        this.$Progress.finish()

                        Fire.$emit('AfterCreatedSingerLoadIt');

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        console.log("Erro.....")
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel alterar os dados!'
                        });
                    })
            },
            openModalWindow() {
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
                var div = document.getElementById("divFoto");
                div.hidden = false;//mostrar o campo de foto
            },

            loadSingers(page = 1) {
                //our get results from a laravel endpoint
                axios.get("api/singer/" + this.$route.params.id + "?page=" + page)
                    .then(data => (this.singers = data.data));

                //pick data from controller and push it into users object

            }, /*
            loadSingers2() {
                axios.get("api/grupo/" + this.$route.params.id)
                    .then(result => (this.grupos = result.data));
            },*/
            //cadastrar cantor
            createMember() {

                this.$Progress.start()

                this.form.post('api/singer')
                    .then(() => {

                        Fire.$emit('AfterCreatedSingerLoadIt'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Cantor cadastrado com sucesso'
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
            deleteSinger(id) {
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
                        this.form.delete('api/singer/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Excluído!',
                                    'Cantor excluído com sucesso!',
                                    'success'
                                )
                                this.loadSingers();

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
            },
            //retornar a foto carregada
            getPhoto() {
                let foto = (this.form.foto.length > 100) ? this.form.foto : "uploads/" + this.form.foto;
                return foto;
            },
            //carregar a foto
            uploadPhoto(e) {
                let file = e.target.files[0];
                let reader = new FileReader();

                if (file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.foto = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert('File size can not be bigger than 2 MB')
                }
            }
        },
        //criar o cadastro
        created() {
            this.loadSingers();

            Fire.$on('AfterCreatedSingerLoadIt', () => { //custom events fire on
                this.loadSingers();
            });

        }

        //name: "ProfileComponent"
    }
</script>

<style scoped>
</style>