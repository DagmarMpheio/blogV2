<template>
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white font-weight-bolder text-center"
                            style="text-shadow: 3px 1px 15px #e61a8d">Dados Pessoais</h3>
                        <router-link to="/addSinger" class="btn btn-outline-danger"><i class="fa fa-backward"></i>
                            Voltar
                        </router-link>
                    </div>
                    <div class="card-body" v-for="singer in singers" :key="singer.id">
                        <div class="row">
                            <div class="col-lg-auto">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 :src="`uploads/${singer.foto}`"
                                                 alt="Foto do cantor" width="250" height="250"
                                                 style="border-bottom-left-radius: 20px; border-top-right-radius: 20px;">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text"><b>Nome Completo:</b> {{singer.nomeCompleto}}</p>
                                <p class="card-text"><b>Nome Artistíco:</b> {{singer.nomeArtistico}}</p>
                                <p class="card-text"><b>Idade:</b> {{dataActual.diff(singer.dataNascimento,'year')}}</p>
                                <p class="card-text"><b>Data de Nascimento</b> {{singer.dataNascimento|formatDate}}</p>
                                <p class="card-text"><b>Grupo Coral:</b> {{singer.nome}}</p>
                                <p class="card-text"><b>Tipo de Instrumento:</b> {{singer.nomeInstrumento}}</p>
                                <p class="card-text"><b>Categoria Instrumental:</b> {{singer.tipoCategoria}}</p>
                            </div>
                            <div class="col-6">
                                <a v-bind:href="'/dashboard#/cantorInfo/'+singer.id+'#item'"
                                   @click="editDadosModal(singer)"
                                   class="btn btn-outline-success">
                                    <i class="fa fa-pencil-square-o"></i> Editar Dados</a>
                                <a v-bind:href="'/dashboard#/cantorInfo/'+singer.id+'#item'"
                                   @click="editFotoModal(singer)" data-id="singer.id"
                                   class="btn btn-outline-primary">
                                    <i class="fa fa-file-photo-o"></i> Alterar Foto</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--modal para alterar foto-->
                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="addNewLabel">Alterar a Foto</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form @submit.prevent="updateFoto" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="inputFoto" class="col-form-label">Foto</label>
                                        <input type="file" @change='uploadfoto' name="foto"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('foto') }" id="inputFoto">
                                        <has-error :form="form" field="foto"></has-error>
                                    </div>

                                    <center><img class="profile-user-img img-fluid img-circle rounded"
                                                 :src="getFoto()"
                                                 alt="User profile picture" width="300" height="300"></center>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fa fa-close"></i>Fechar
                                    </button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Alterar
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--modal para editar os dados-->
                <div class="modal fade" id="addNew2" tabindex="-1" role="dialog" aria-labelledby="addNewLabel2"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="addNewLabel2">Actualizar Cantor</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form @submit.prevent="UpdateCantor" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <center><img class="profile-user-img img-fluid img-circle rounded"
                                                 :src="getFoto()"
                                                 alt="Foto do cantor" width="300" height="200"></center>

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
        <br><br>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "ProfileComponent",
        data() {
            return {
                //array dos dos
                singers: {},
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
                /*dia: new Date().getDate(),
                mes: new Date().getMonth() + 1,//0 é Janeiro
                ano: new Date().getFullYear()*/
                dataActual: moment(moment()),//data actual

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
            this.getSinger();//carregar os dados na tela
            this.loadGrupos();//carregar os dados na tela

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
            //pegar dados pelo id do cantor
            getSinger() {
                axios.get("api/singer2/" + this.$route.params.id)
                    .then(result => (this.singers = result.data));
            },

            //alterar foto
            editFotoModal(item) {
                this.form.clear();
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(item);
            },

            //alterar dados excepto a foto
            editDadosModal(item) {
                this.form.clear();
                this.form.reset();
                $('#addNew2').modal('show');
                this.form.fill(item);
            },

            updateFoto() {
                this.$Progress.start();

                this.form.put('api/singer2/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                            icon: 'success',
                            title: 'Foto alterada com sucesso!'
                        })

                        this.$Progress.finish();
                        this.getSinger();//carregar os dados na tela

                        $('#addNew').modal('hide');
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel alterar a foto!'
                        });
                        console.log("Erro");
                    })
            },

            //Para mostrar a foto no instante que foi escolhida
            getFoto() {
                let foto = (this.form.foto.length > 100) ? this.form.foto : "uploads/" + this.form.foto;
                return foto;
            },

            //para o upload da foto
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
                    alert('O tamanho do ficheiro não pode ser maior que 2MB')
                }
            },

            /*alterar dados excepto a foto*/
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

                        $('#addNew2').modal('hide');
                    })
                    .catch(() => {
                        console.log("Error.....");
                        /*Toast.fire({
                            icon: 'error',
                            title: 'Não foi possivel alterar os dados!'
                        });*/
                    })
            },

            /*pegar os grupos*/
            loadGrupos() {
                //our get results from a laravel endpoint
                axios.get("api/grupo")
                    .then(data => (this.grupos = data.data));

                //pick data from controller and push it into users object

            }
        }
    }
</script>

<style scoped>

</style>