<template>
  <v-app>
      <h1>Lien de la video live </h1>
      <v-container grid-list-md>
          <div class="row justify-content-center">
              <div class="col-md-12 text-center">
                  <h1>Ajouter le lien de video</h1>
              </div>
              <div class="col-md-8">
                  <v-alert
                    dense
                    text
                    class="d-none"
                    id="alert"
                    dismissible
                    type="success"
                    >
                    Le lien est ajouté
                    </v-alert>
              </div>
              <div class="col-md-8">
                    <v-text-field
                        label="Lien de video"
                        v-model="link"
                        outlined>
                    </v-text-field>
              </div>
              <div class="col-md-5 text-center">
                  <v-btn class="w-50" @click="addlink()" color="primary">Ajouter</v-btn>
              </div>
          </div>
      </v-container>
  </v-app>
</template>

<script>
export default {
    data(){
        return{
            link:'',
        }
    },
    methods:{
        addlink(){
            axios.post('/addlink',{
                link:this.link,
            }).then((e) => {
                document.getElementById('alert').classList.remove('d-none')
                this.link=''
            })

        }
    }

}
</script>

<style>

</style>
