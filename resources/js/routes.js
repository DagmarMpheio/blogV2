import Dashboard from './components/DashboardComponent.vue'
import GrupoInfo from './components/GroupInfoComponent.vue'
import User from './components/UserComponent.vue'
import Grupo from './components/GrupoCoralComponent.vue';
import Cantor from './components/CantorComponent.vue';
import Perfil from './components/CantorInfoComponent';

export const routes = [
    {
        path: '/',
        component: Dashboard
    },
    {
        path: '/users',
        component: User
    },
    {
        path: '/addGroup',
        component: Grupo
    },
    {
        name: '/grupoInfo/id',
        path: '/grupoInfo/:id/',
        component: GrupoInfo,
        mode: 'history'
    },
    {
        path: '/addSinger',
        component: Cantor
    },
    {
        name: '/cantorInfo/id',
        path: '/cantorInfo/:id/',
        component: Perfil
    }
];