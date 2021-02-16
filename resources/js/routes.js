import AllEstabelecimentos from './components/AllEstabelecimentos.vue';
import NewEstabelecimento from './components/NewEstabelecimento.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: NewEstabelecimento
    },
    {
        name: 'cadastrados',
        path: '/lista-cadastrados',
        component: AllEstabelecimentos
    }
];
