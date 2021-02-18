<template>
    <div class="container">
        <h2>Cadastrar Estabelecimento</h2>
        <p>Preencha os dados abaixo para realizar o pré-cadastro do seu estabelecimento:</p>
        <form id="formulario" class="g-3 needs-validation" method="post" novalidate>
            <div class="card">
                <div class="card-header">Informações do estabelecimento</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="tel" class="form-control" id="cnpj" v-model="estabelecimento.cnpj" v-mask="'##.###.###/####-##'" @change="checkCnpj" required />
                            <div class="invalid-feedback">{{ valErrors.cnpj }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="razao_social" class="form-label">Razão Social</label>
                            <input type="text" class="form-control" id="razao_social" v-model="estabelecimento.razao_social" required  disabled />
                            <div class="invalid-feedback">{{ valErrors.razao_social }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="licenca_funcionamento" class="form-label">Licença de funcionamento</label>
                            <input type="text" class="form-control" id="licenca_funcionamento" v-model="estabelecimento.licenca_funcionamento" required />
                            <div class="invalid-feedback">{{ valErrors.licenca_funcionamento }}</div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="tel" class="form-control" id="cep" v-model="estabelecimento.cep" @blur="getCepAddress" v-mask="'#####-###'" required />
                            <div class="invalid-feedback">{{ valErrors.cep }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" v-model="estabelecimento.endereco" disabled required />
                            <div class="invalid-feedback">{{ valErrors.endereco }}</div>
                        </div>
                        <div class="col-md-2">
                            <label for="numero" class="form-label">Número</label>
                            <input type="tel" class="form-control" id="numero" v-model="estabelecimento.numero" v-mask="'#######'" required />
                            <div class="invalid-feedback">{{ valErrors.numero }}</div>
                        </div>
                        <div class="col-md-2">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" v-model="estabelecimento.complemento" />
                        </div>
                        <div class="col-md-2">
                            <label for="sql" class="form-label">SQL</label>
                            <input type="text" class="form-control" id="sql" v-model="estabelecimento.sql" title="Cadastro do imóvel ou SQL (Setor, Quadra, Lote)" v-mask="['###.###.####','###.###.####-#']" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Contato</div>
                <div class="row card-body">                
                    <div class="col-md-4">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="nome" v-model="estabelecimento.nome" required />
                        <div class="invalid-feedback">{{ valErrors.nome }}</div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" v-model="estabelecimento.email" required />
                        <div class="invalid-feedback">{{ valErrors.email }}</div>
                    </div>
                    <div class="col-md-3">
                        <label for="email-confirm" class="form-label">Confirme seu e-mail</label>
                        <input type="email-confirm" class="form-control" id="email-confirm" v-model="estabelecimento.email_confirm" @blur="valEmail" required />
                        <div class="invalid-feedback">{{ valErrors.email_confirm }}</div>
                    </div>
                    <div class="col-md-2">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="tel" class="form-control" id="celular" v-model="estabelecimento.celular" v-mask="['(##) ##### ####', '(##) #### ####']" placeholder="11 99999 9999" required />
                        <div class="invalid-feedback">{{ valErrors.celular }}</div>
                    </div>
                </div>
            </div>
            <center><button class="btn btn-lg btn-primary" type="submit" @click="checkForm($event)">Enviar</button></center>
        </form>

        <!-- Modal sucesso -->
        <div id="modal-sucesso" class="modal-custom" @click="redirectSite" v-if="modalSucesso">
            <div class="card">
                <div class="card-header">
                    Dados enviados
                </div>
                <div class="card-body">
                    <center><p>As informações foram enviadas com sucesso!</p></center>
                    <center><button class="btn btn-success btn-lg">Sair</button></center>
                </div>
            </div>
        </div>
        <div id="modal-erro" class="modal-custom" @click="modalErro = false" v-if="modalErro">
            <div class="card">
                <div class="card-header">
                    Falha no envio
                </div>
                <div class="card-body">
                    <center><p>{{errorMsg}}</p></center>
                    <center><button class="btn btn-danger btn-lg">OK</button></center>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {TheMask} from 'vue-the-mask'

export default {
    data() {
        return {
            estabelecimento: {},
            errors: [],
            valErrors: {
                nome: 'Por favor, insira seu nome completo.',
                email: 'Endereço de e-mail inválido.',
                email_confirm: 'Os e-mails não batem.',
                celular: 'Número de celular inválido.',
                endereco: 'Por favor, preencha o endereço completo.',
                numero: 'Preencha o número',
                razao_social: 'Preencha a razão social.',
                cep: 'CEP inválido',
                cnpj: 'CNPJ inválido.',
                licenca_funcionamento: 'Por favor, preencha a licença de funcionamento.'
            },
            cep_api: 'api/cep/',
            cnpj_api: 'api/cnpj/',
            waitingCep : false,
            modalSucesso: false,
            modalErro: false,
            errorMsg: ''
        }
    },
    components: {
        TheMask
    },
    methods: {
        checkForm: function(e) {
            if (e) {
                e.preventDefault()
            }
            let forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(form => {
                if (!form.checkValidity()) {
                    e.preventDefault()
                    e.stopPropagation()
                }
                else
                    this.sendForm()
                form.classList.add('was-validated')
            }, false)
                
            document.querySelector('#formulario').focus()

        },
        sendForm: function() {
            // Prepara objeto Estabelecimento e envia para o servidor
            axios.post('api/estabelecimento/store', this.estabelecimento)
            .then(response => {
                if(response.data.success === 1) {
                    this.showModal("Sucesso")
                }
                else if(response.data.success === 0) {
                    if (response.data.message === 'razao_social'){
                        document.querySelector('#razao_social').removeAttribute('disabled')
                        document.querySelector('#razao_social').classList.add('is-invalid')
                        document.querySelector('#razao_social').focus()
                        return
                    }
                    if (response.data.message === 'cnpj_ja_cadastrado'){
                        this.errorMsg = "Estabelecimento já cadastrado!"
                        this.showModal("Erro")
                        return
                    }
                }
                
            })
            .catch(err => {
                if(err.data === 'razao_social'){
                    document.querySelector('#razao_social').removeAttribute('disabled')
                }
            })
        },
        valEmail: function() {
            // Valida e-mail 
            let mail = this.estabelecimento.email
            const mailField = document.querySelector('#email')
            const mailConfirmField = document.querySelector('#email-confirm')
            
            if(!mailField.checkValidity()){
                mailField.classList.remove('is-valid')
                mailField.classList.add('is-invalid')
            }

            if(mail !== this.estabelecimento.email_confirm){
                mailConfirmField.classList.remove('is-valid')
                mailConfirmField.classList.add('is-invalid')
                return false
            }
            mailConfirmField.classList.remove('is-invalid')
            mailConfirmField.classList.add('is-valid')
        },
        getCepAddress: function() {
            let cepUrl = this.cep_api + this.cleanNumber(this.estabelecimento.cep)
            this.waitingCep = true
            window.setTimeout(() => {
                if(this.waitingCep) {
                    document.querySelector('#cep').classList.remove('is-invalid')
                    document.querySelector('#endereco').removeAttribute('disabled')
                }
                // else
                //     console.log("Cep obtido")
            }, 3000)
            
            axios.
                get(cepUrl)
                .then(response => {
                    this.waitingCep = false
                    if(response.data.erro) {
                        document.querySelector('#cep').classList.add('is-invalid')
                        return
                    }
                    let endereco = response.data.logradouro + " - " + response.data.bairro
                    document.querySelector('#cep').classList.remove('is-invalid')
                    Vue.set(this.estabelecimento, 'endereco', endereco)
                })
                .catch(err => document.querySelector('#endereco').removeAttribute('disabled'))
        },
        cleanNumber: function(dirtyNumber) {
            if(!dirtyNumber)
                return

            if (!dirtyNumber.length > 0)
                throw "Número inválido"
            
            let clean = dirtyNumber.match(/\d+/g).join('');
            return clean
        },
        checkCnpj: function() {
            if(this.estabelecimento.cnpj && this.estabelecimento.cnpj.length === 18) {
                let cnpjUrl = this.cnpj_api + this.cleanNumber(this.estabelecimento.cnpj)
                axios.get(cnpjUrl)
                .then(response => {
                    if(response.data.status === "ERROR") {
                        document.querySelector('#cnpj').classList.add('is-invalid')
                        // console.log(response.data.message)
                        return
                    }
                    // Atualiza CEP e busca endereço a partir dele
                    Vue.set(this.estabelecimento, 'cep', response.data.cep)
                    Vue.set(this.estabelecimento, 'razao_social', response.data.nome)
                    Vue.set(this.estabelecimento, 'email', response.data.email)
                    this.getCepAddress()
                    Vue.set(this.estabelecimento, 'numero', response.data.numero)
                    document.querySelector('#licenca_funcionamento').focus()
                    
                })
                .catch(err => {
                    // console.error("Não foi possível consultar CNPJ")
                    document.querySelector('#cnpj').classList.remove('is-invalid')
                    document.querySelector('#razao_social').removeAttribute('disabled')
                })
            }
        },
        showModal: function(tipo){
            if(tipo === "Sucesso"){
                this.modalSucesso = true
                return
            }
            if(tipo === "Erro"){
                this.modalErro = true
                return
            }
        },
        redirectSite: function() {
            window.location.href = 'https://www.prefeitura.sp.gov.br/cidade/secretarias/licenciamento/'
        }
    }
}
</script>