<template>
  <v-app>
      <div class="container">
          <v-row class=" justify-content-center">
              <v-col class="col-md-12 text-center col-sm-12 mb-3">
                    <img  width="120px" src="/logo-adn.png">
                    <p class="h4 white--text">7<sup>éme</sup> Congrès National de l'ADN</p>
                </v-col>

            <v-col class="col-md-8 col-sm-12">
                    <v-card v-ripple="{ center: true }" >
                            <v-card-title primary-title>
                                <span>{{question.name}}</span>
                                <v-spacer></v-spacer>
                                <v-icon large color="blue darken-2" >mdi-help</v-icon>
                            </v-card-title>
                            <v-card-text id="dis_2">
                            <p style="font-size:16px" class="font-weight-light">
                                {{question.question}}
                            </p>
                        </v-card-text>
                    </v-card>
            </v-col>
          </v-row>
      </div>
  </v-app>
</template>

<script>
export default {
    data(){
        return{
            question:[]
        }
    },
    mounted(){
        axios.get('/getlatestshares').then((e) => {
            this.question=e.data
        })
    },
    methods: {

    },
}
</script>

<style>

</style>
