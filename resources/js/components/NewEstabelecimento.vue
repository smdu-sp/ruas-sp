<template>
    <div class="container">
        <h2>Cadastrar Estabelecimento</h2>
        <p>Preencha os dados abaixo para realizar o pré-cadastro do seu estabelecimento:</p>
        <form id="formulario" @submit="checkForm" action="#" method="post">
            <td>{{ estabelecimento.id }}</td>
            <td>{{ estabelecimento.nome }}</td>
            <td>{{ estabelecimento.email }}</td>
            <td>{{ estabelecimento.celular }}</td>
            <td>{{ estabelecimento.endereco }}</td>
            <td>{{ estabelecimento.cep }}</td>
            <td>{{ estabelecimento.coords_xy }}</td>
            <td>{{ estabelecimento.sql }}</td>
            <td>{{ estabelecimento.razao_social }}</td>
            <td>{{ estabelecimento.cnpj }}</td>
            <td>{{ estabelecimento.licenca_funcionamento }}</td>
            <td>{{ estabelecimento.created_at }}</td>
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
                celular: 'Número de celular inválido.',
                endereco: 'Por favor, preencha o endereço completo.',
                razao_social: 'Preencha a razão social.',
                cnpj: 'CNPJ inválido.',
                licenca: 'Por favor, preencha a licença de funcionamento.'
            }
        }
    },
    methods: {
        checkForm: function(e) {
            let item = this.estabelecimento
            if(!valNome())
                this.errors.push(this.valErrors.nome)
            
            if(!valEmail())
                this.errors.push(this.valErrors.email)

            if(!valCelular())
                this.errors.push(this.valErrors.celular)
            
            if(!valEndereco())
                this.errors.push(this.valErrors.endereco)
            
            if(!valRazaoSocial())
                this.errors.push(this.valErrors.razao_social)

            if(!valCnpj())
                this.errors.push(this.valErrors.cnpj)
            
            if(!valLicenca())
                this.errors.push(this.valErrors.licenca)
                
            if(!this.errors.length)
                this.sendForm()
            else
                document.querySelector('#formulario').focus()

            e.preventDefault()
        },
        sendForm: function() {
            // Prepara objeto Estabelecimento e envia para o servidor
        }
    }
}
</script>