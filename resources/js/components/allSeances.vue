<template>
    <v-container>
        <v-row class="mt-4">
            <v-col cols="12" md="4" sm="12" class="mb-2">
                <v-card>
                    <v-card style="margin-top:-20px;margin-right:20px;" width="30%" class="text-center p-4 orange darken-2 float-right">
                        <v-icon style="font-size:30px" dark >mdi-clipboard-arrow-down</v-icon>
                    </v-card>
                    <v-card-title class="mb-5" primary-title>
                        <div>
                          <h3 class="headline mb-0">choisi votre seance </h3>
                        </div>
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12"  v-for="seance in seances" :key="seance.id">
                <v-hover v-slot="{ hover }">
                <v-btn @click="goto(seance.id)"  block>
                   <b> {{ seance.nom }} jour: {{ seance.jour }} track: {{ seance.track }}</b>
                    <v-icon v-if="hover">mdi-arrow-right-bold-outline</v-icon>
                </v-btn>
                </v-hover>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
  export default {
    data: () => ({
        user:[],
        seances:[],

    }),
    methods: {
        getTotal(){
            axios.get('gettotalusers').then((res) => {
                this.users=res.data
                console.log(this.users)
            })
        },
        getseances(){
            axios.get('getAllSeances').then((res) =>{ 
                this.seances = res.data
                console.log(this.seances)
            })
        },
        goto(id){
            this.$router.push({path:"seanceTrack/"+id})
        },
    },
    created(){
        this.getTotal()
        this.getseances()
    },
    mounted() {
    },
  }
</script>