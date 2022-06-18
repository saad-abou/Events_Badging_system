<template>
  <v-app>
    <h4>Questions</h4>
    <v-container grid-list-md>
        <v-row>
            <v-col cols="12">
                <h5>Nombre des questions : {{Questions.length}}</h5>
            </v-col>

            <v-col cols="12">
                <v-btn color="warning" @click="clear" >Vider les questions de la session</v-btn>
            </v-col>

        </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
    data(){
        return{
            Questions:[]
        }
    },
    mounted(){
        axios.get('/getquestions').then((response) => {
            this.Questions=response.data;
        })
    },
    methods:{
        clear(){
            axios.post('/clear',{
                Questions:this.Questions,
            }).then( this.Questions=[])
        }
    }
}
</script>

<style>

</style>
