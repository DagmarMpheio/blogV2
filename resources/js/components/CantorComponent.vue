<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-header">Adicionar Novo Cantor</div>

                    <div class="card-body">
                        <router-link to="/addGroup" class="btn btn-outline-danger"><i class="fa fa-backward"></i> Voltar
                        </router-link>
                        <br><br>
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle rounded-circle" :src="getFoto()"
                                         alt="Foto do cantor" width="250" height="250">
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal" enctype="multipart/form-data" id="formInicial">
                                <div class="form-group row">
                                    <label for="inputNome" class="col-sm-2 col-form-label">Nome Completo</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="form.nomeCompleto" class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('nomeCompleto') }"
                                               name="nomeCompleto" placeholder="Nome Completo" id="inputNome">
                                        <has-error :form="form" field="nomeCompleto"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputNomeArtistico" class="col-sm-2 col-form-label">Nome
                                        Artistíco</label>
                                    <div class="col-sm-10">
                                        <input v-model="form.nomeArtistico" type="text" name="nomeArtistico"
                                               placeholder="Nome Artistíco"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('nomeArtistico') }"
                                               style="height: auto;" id="inputNomeArtistico">
                                        <has-error :form="form" field="nomeArtistico"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputDataN" class="col-sm-2 col-form-label">Data de Nascimento</label>
                                    <div class="col-sm-10">
                                        <input v-model="form.dataNascimento" type="date" name="dataNascimento"
                                               placeholder="Data de Nascimento"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('dataNascimento') }"
                                               id="inputDataN">
                                        <has-error :form="form" field="dataNascimento"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="genero" class="col-sm-2 col-form-label">Genêro</label>
                                    <div class="col-sm-10">
                                        <select name="genero" v-model="form.genero" id="genero" class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('genero') }">
                                            <option value="">Seleccione o Gênero</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                        <has-error :form="form" field="genero"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="instrumento" class="col-sm-2 col-form-label">Tipo de
                                        Instrumento</label>
                                    <div class="col-sm-10">
                                        <select name="instrumento" id="instrumento" class="form-control">
                                            <option value="">Seleccione Tipo de Instrumento</option>
                                            <option value="1">Vocal</option>
                                            <option value="2">Musical</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="categoriaDiv" class="col-sm-2 col-form-label">Categoria
                                        Instrumental</label>
                                    <div class="col-sm-10">
                                        <select name="categoriaInstrumento" v-model="form.categoriaInstrumento"
                                                id="categoriaDiv"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('categoriaInstrumento') }">
                                            <option value="">Seleccione Categoria de Instrumento</option>
                                        </select>
                                        <has-error :form="form" field="categoriaInstrumento"></has-error>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputGrupo" class="col-sm-2 col-form-label">Grupo Coral</label>
                                    <div class="col-sm-10">
                                        <select name="idGrupo" id="inputGrupo" class="form-control"
                                                v-model="form.idGrupo">
                                            <option value="">Seleccione o Grupo Coral</option>
                                            <option v-for="grupo in grupos.data" :value="grupo.id">
                                                {{grupo.nome}}
                                            </option>
                                        </select>
                                        <has-error :form="form" field="idGrupo"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" @change='uploadfoto' name="foto" class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('foto') }" id="inputSkills">
                                        <has-error :form="form" field="foto"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" @click.prevent="SubmiFoto"
                                                class="btn btn-outline-primary">
                                            <i class="fa fa-save"></i> Cadastrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-responsive ">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Grupo Coral</th>
                                    <th>Tipo de Instrumento</th>
                                    <th>Categoria Instrumental</th>
                                    <th>Foto</th>
                                    <th>Modify</th>
                                </tr>

                                <tr v-for="item in tabledata.data" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{item.nomeCompleto}}</td>
                                    <td>{{ item.nome }}</td>
                                    <td>{{ item.nomeInstrumento}}</td>
                                    <td>{{ item.tipoCategoria }}</td>
                                    <td><img :src="`uploads/${item.foto}`"
                                             class="profile-user-img img-fluid img-circle rounded-circle"
                                             style="height:60px; width:60px;"></td>

                                    <td>
                                        <!-- <router-link :to="{name:'/cantorInfo/id/singer',params:{id:item.id},hash:'#item'}">
                                             <i class="fa fa-eye text-success"></i>
                                         </router-link>-->
                                        <a v-bind:href="'/dashboard#/cantorInfo/'+item.id+'#item'">
                                            <i class="fa fa-eye text-success"></i>
                                        </a>
                                        |
                                        <a v-bind:href="'/dashboard#/addSinger/'" @click="editFotoModal(item)">
                                            <i class="fa fa-edit text-primary"></i>
                                        </a>
                                        |
                                        <a v-bind:href="'/dashboard#/addSinger/'" @click="deletefoto(item.id)">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination :data="tabledata" @pagination-change-page="getResults">
                                <span slot="prev-nav">&lt;Anterior</span>
                                <span slot="next-nav">Próximo&gt;</span>
                            </pagination>
                        </div>

                        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="addNewLabel">Actualizar Cantor</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form @submit.prevent="UpdateCantor" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <center><img class="profile-user-img img-fluid img-circle rounded"
                                                         :src="getFoto()"
                                                         alt="User profile picture" width="300" height="200"></center>


                                            <div class="form-group">
                                                <label for="inputNomeCompleto" class="col-form-label">Nome
                                                    Completo</label>
                                                <input v-model="form.nomeCompleto" type="text" name="nomeCompleto"
                                                       placeholder="Nome Completo"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': form.errors.has('nomeCompleto') }"
                                                       id="inputNomeCompleto">
                                                <has-error :form="form" field="nomeCompleto"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputNomeArtistico" class="col-form-label">Nome
                                                    Artistíco</label>
                                                <input v-model="form.nomeArtistico" type="text" name="nomeArtistico"
                                                       placeholder="Nome Artistíco"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': form.errors.has('nomeArtistico') }"
                                                       style="height: auto;" id="inputNomeArtistico">
                                                <has-error :form="form" field="nomeArtistico"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputDataN" class="col-form-label">Data de
                                                    Nascimento</label>
                                                <input v-model="form.dataNascimento" type="date"
                                                       name="dataNascimento"
                                                       placeholder="Data de Nascimento"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': form.errors.has('dataNascimento') }"
                                                       id="inputDataN">
                                                <has-error :form="form" field="dataNascimento"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="genero" class="col-form-label">Genêro</label>
                                                <select name="genero" v-model="form.genero" id="genero"
                                                        class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('genero') }">
                                                    <option value="">Seleccione o Gênero</option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                                <has-error :form="form" field="genero"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <label for="instrumento" class="col-form-label">Tipo de
                                                    Instrumento</label>
                                                <select name="instrumento" id="instrumento" class="form-control">
                                                    <option value="">Seleccione Tipo de Instrumento</option>
                                                    <option value="1">Vocal</option>
                                                    <option value="2">Musical</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="categoriaDiv" class="col-form-label">Categoria
                                                    Instrumental</label>
                                                <select name="categoriaInstrumento"
                                                        v-model="form.categoriaInstrumento"
                                                        id="categoriaDiv"
                                                        class="form-control"
                                                        :class="{ 'is-invalid': form.errors.has('categoriaInstrumento') }">
                                                    <option value="">Seleccione Categoria de Instrumento</option>
                                                </select>
                                                <has-error :form="form" field="categoriaInstrumento"></has-error>
                                            </div>


                                            <div class="form-group">
                                                <label for="inputGrupo" class="col-form-label">Grupo
                                                    Coral</label>
                                                <select name="idGrupo" id="inputGrupo" class="form-control"
                                                        v-model="form.idGrupo">
                                                    <option value="">Seleccione o Grupo Coral</option>
                                                    <option v-for="grupo in grupos.data" :value="grupo.id">
                                                        {{grupo.nome}}
                                                    </option>
                                                </select>
                                                <has-error :form="form" field="idGrupo"></has-error>
                                            </div>

                                            <!--<div class="form-group">
                                                <label for="inputSkills" class="col-form-label">Avatar</label>
                                                <input type="file" @change='uploadfoto' name="foto"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': form.errors.has('foto') }">
                                                <has-error :form="form" field="foto"></has-error>
                                            </div>-->
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </form>
                                </div>
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

        data() {
            return {
                tabledata: {},
                grupos: {},

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
            this.loadTableData();
            this.loadGrupos();

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

            uploadfoto(e) {
                let file = e.target.files[0];
                let reader = new FileReader();

                if (file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.foto = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert('O tamanho do ficheiro não pode ser maior que 2MB');
                    /* Toast.fire({
                         icon: 'error',
                         title: 'Não foi possivel alterar a foto!'
                     });*/
                }
            },

            //For getting Instant Uploaded foto
            getFoto() {
                let foto = (this.form.foto.length > 100) ? this.form.foto : "uploads/" + this.form.foto;
                return foto;
            },

            //Insert foto
            SubmiFoto() {
                this.$Progress.start()

                this.form.post('api/singer')
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Cantor cadastrado com sucesso'
                        })

                        this.$Progress.finish();
                        this.loadTableData()
                    })
                    .catch(() => {
                        console.log("Erro.....");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel cadastrar!'
                        });
                    })

            },

            //get Table data and do the pagination
            loadTableData() {

                axios.get('api/singer')
                    .then(({data}) => (this.tabledata = data))
                    .catch(() => {
                        console.log("Error...");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel carregar os dados da base de dados!'
                        });
                    })
            },

            //get Table data and do the pagination
            loadGrupos() {
                //our get results from a laravel endpoint
                axios.get("api/grupo")
                    .then(data => (this.grupos = data.data));

                //pick data from controller and push it into users object

            },

            //Pagination
            getResults(page = 1) {
                axios.get('api/singer?page=' + page)
                    .then(response => {
                        this.tabledata = response.data;
                    });
            },

            //Edit Option
            editFotoModal(item) {
                this.form.clear();
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(item);
            },

            UpdateCantor() {
                this.$Progress.start();

                this.form.put('api/singer/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Cantor actualizado com sucesso'
                        })

                        this.$Progress.finish();
                        this.loadTableData()

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        console.log("Error.....");
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel alterar os dados!'
                        });
                    })
            },

            //Delete foto
            deletefoto(id) {
                Swal.fire({
                    title: 'Tem a certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluí-o!'
                }).then((result) => {

                    if (result.value) {
                        //Send Request to server
                        this.form.delete('api/singer/' + id)
                            .then((response) => {
                                Swal.fire(
                                    'Excluído!',
                                    'Cantor excluído com sucesso',
                                    'success'
                                )
                                this.loadTableData();

                            }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo correu mal!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })
                        })
                    }

                })
            }

        },

        created() {

            //LoadTableData
            this.loadTableData()

        }

    }
</script>
