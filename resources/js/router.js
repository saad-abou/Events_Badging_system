import Vue from 'vue';
import VueRouter from 'vue-router';
import newcomptes from './components/newComptes';
import stats from './components/stats';
import comptesToPrint from './components/usersToPrint';
import allSeances from './components/allSeances';
import seanceTrack from './components/seanceTrack';

Vue.use(VueRouter);

export default new VueRouter({
        routes:[
            {
                path:'/',
                name:'',
                component:stats,
            },
            {
                path:'/stats',
                component:stats,
            },
            {
                path:'/newcomptes',
                component:newcomptes
            },
            {
                path:'/comptesToPrint',
                component:comptesToPrint
            },
            {
                path:'/allSeances',
                component:allSeances
            },
            {
                path:"/seanceTrack/:id?",
                component:seanceTrack
            },

          
      ],
      mode:'history'
});

