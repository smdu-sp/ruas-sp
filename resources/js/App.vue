<template>
    <div class="container">
        <div id="header" class="row">
            <div class="col-6">
                <img src="/img/logo_ruassp.png" alt="Ruas SP" width="248" height="176">
            </div>
            <div class="col-6 text-right">
                <img src="/img/logo_smul.png" class="mt-3" alt="SMUL">
            </div>
            <div id="link-bt-container">
                <div class="col-4 text-center" v-for="link in links" v-bind:key="link.url">
                    <!-- <div class="link-bt text-center">
                        <a :href="link.url" target="_blank">{{link.nome}}</a>
                    </div> -->
                    <a :href="link.url" target="_blank"><button class="btn btn-secondary">{{ link.nome }}</button></a>
                </div>
            </div>
            
            <!-- <h1 style="line-height: 3">Projeto Ruas SP</h1> -->
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                links: [
                    {
                        nome: 'SOBRE O PROJETO',
                        url: 'https://www.prefeitura.sp.gov.br/cidade/secretarias/licenciamento/noticias/index.php?p=308573'
                    },
                    {
                        nome: 'CONFIRA AS VIAS APROVADAS',
                        url: 'https://www.prefeitura.sp.gov.br/cidade/secretarias/licenciamento/servicos/index.php?p=308717'
                    },
                    {
                        nome: 'MAIS INFORMAÇÕES',
                        url: 'https://www.prefeitura.sp.gov.br/cidade/secretarias/licenciamento/servicos/index.php?p=308717'
                    }
                ]
            }
        }
    }
</script>