import AllEstabelecimentos from './components/AllEstabelecimentos.vue';
import NewEstabelecimento from './components/NewEstabelecimento.vue';
import Home from './components/Home.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'pre-cadastro',
        path: '/pre-cadastro',
        component: NewEstabelecimento
    },
    {
        name: 'cadastrados',
        path: '/lista-cadastrados',
        component: AllEstabelecimentos
    }
];
