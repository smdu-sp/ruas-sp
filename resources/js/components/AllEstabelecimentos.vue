<template>
    <div>
        <h3 class="text-center">Todos os estabelecimentos</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    <th>Coordenadas</th>
                    <th>SQL</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Licença de funcionamento</th>
                    <th>Data cadastro</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="estabelecimento in estabelecimentos" :key="estabelecimento.id">
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
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: {id: estabelecimento.id }}" class="btn btn-primary">
                                Editar
                            </router-link>
                            <button class="btn btn-danger" @click="deleteEstabelecimento(estabelecimento.id)">
                                Deletar
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
const apiUrl = 'http://localhost:8000/api/'

export default {
    data() {
        return {
            estabelecimentos: []
        }
    },
    created() {
        this.axios
            .get(apiUrl+'estabelecimentos')
            .then(response => {
                this.estabelecimentos = response.data
            })
    },
    methods: {
        deleteEstabelecimento(id) {
            this.axios
                .delete(`${apiUrl}estabelecimento/delete/${id}`)
                .then(response => {
                    let i = this.estabelecimentos.map(item => item.id).indexOf(id)
                    this.estabelecimentos.splice(i, 1)
                })
        }
    }
}
</script>