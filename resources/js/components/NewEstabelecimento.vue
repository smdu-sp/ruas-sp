<template>
    <div class="container">
        <h2>Cadastrar Estabelecimento</h2>
        <p>Preencha os dados abaixo para realizar o pré-cadastro do seu estabelecimento:</p>
        <form id="formulario" class="g-3 needs-validation" method="post" novalidate>
            <div class="card">
                <div class="card-header">Informações do estabelecimento</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="number" class="form-control" id="cep" v-model="estabelecimento.cep" @blur="getCepAddress" required />
                            <div class="invalid-feedback">{{ valErrors.cep }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" v-model="estabelecimento.endereco" required />
                            <div class="invalid-feedback">{{ valErrors.endereco }}</div>
                        </div>
                        <div class="col-md-2">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" v-model="estabelecimento.numero" required />
                            <div class="invalid-feedback">{{ valErrors.numero }}</div>
                        </div>
                        <div class="col-md-2">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" v-model="estabelecimento.complemento" />
                        </div>
                        <div class="col-md-2">
                            <label for="sql" class="form-label">SQL</label>
                            <input type="text" class="form-control" id="sql" v-model="estabelecimento.sql" title="SQL (Setor, Quadra, Lote)" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="razao_social" class="form-label">Razão Social</label>
                            <input type="text" class="form-control" id="razao_social" v-model="estabelecimento.razao_social" required />
                            <div class="invalid-feedback">{{ valErrors.razao_social }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" v-model="estabelecimento.cnpj" required />
                            <div class="invalid-feedback">{{ valErrors.cnpj }}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="licenca" class="form-label">Licença de funcionamento</label>
                            <input type="text" class="form-control" id="cnpj" v-model="estabelecimento.licenca" required />
                            <div class="invalid-feedback">{{ valErrors.licenca }}</div>
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
                        <input type="email" class="form-control" id="email" @focus="conlog($event)" v-model="estabelecimento.email" required />
                        <div class="invalid-feedback">{{ valErrors.email }}</div>
                    </div>
                    <div class="col-md-3">
                        <label for="email-confirm" class="form-label">Confirme seu e-mail</label>
                        <input type="email" class="form-control" id="email-confirm" v-model="estabelecimento.email_confirm" @blur="valEmail" required />
                        <div class="invalid-feedback">{{ valErrors.email_confirm }}</div>
                    </div>
                    <div class="col-md-2">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celular" v-model="estabelecimento.celular" required />
                        <div class="invalid-feedback">{{ valErrors.celular }}</div>
                    </div>
                </div>
            </div>
            <center><button class="btn btn-lg btn-primary" type="submit" @click="checkForm($event)">Enviar</button></center>
        </form>
    </div>
</template>
<script>
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
                cnpj: 'CNPJ inválido.',
                licenca: 'Por favor, preencha a licença de funcionamento.'
            }
        }
    },
    methods: {
        checkForm: function(e) {
            if (e) {
                e.preventDefault()
            }
            let item = this.estabelecimento
            let forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(form => {
                if (!form.checkValidity()) {
                    e.preventDefault()
                    e.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false);
            // if(!valNome())
            //     this.errors.push(this.valErrors.nome)
            
            // if(!valEmail())
            //     this.errors.push(this.valErrors.email)

            // if(!valCelular())
            //     this.errors.push(this.valErrors.celular)
            
            // if(!valEndereco())
            //     this.errors.push(this.valErrors.endereco)
            
            // if(!valRazaoSocial())
            //     this.errors.push(this.valErrors.razao_social)

            // if(!valCnpj())
            //     this.errors.push(this.valErrors.cnpj)
            
            // if(!valLicenca())
            //     this.errors.push(this.valErrors.licenca)
                
            if(!this.errors.length)
                this.sendForm()
            else
                document.querySelector('#formulario').focus()

        },
        sendForm: function() {
            // Prepara objeto Estabelecimento e envia para o servidor
        },
        valEmail: function() {
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
                console.error("EMAIL ERRADO")
                return false
            }
            mailConfirmField.classList.remove('is-invalid')
            mailConfirmField.classList.add('is-valid')
            console.log("Email bate")
        },
        conlog: function(el) {
            console.log(el)
            el.target.classList.remove('is-invalid')
        }
    }
}
</script>