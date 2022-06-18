<template>
  <v-app>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-4 col-sm-12 text-center">
                    <img width="130px" src="/unnamed.png" alt="">
                    <h4 class="white--text mt-2">Ascrea Congres</h4>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-4 col-sm-12 text-center">
                    <v-form  ref="form" v-model="valid" lazy-validation>
                        <v-text-field color="white" v-model="email" :rules="emailRules" label="E-mail" outlined dark required></v-text-field>
                        <v-text-field :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required]" :type="show ? 'text' : 'password'" name="input-10-2" label="Mot de passe" v-model="password" class="input-group--focused" @click:append="show = !show" dark outlined></v-text-field>
                        <v-btn :disabled="!valid" color="#E92625" class="mr-4 white--text" @click="validate">S'identifier</v-btn>
                    </v-form>
                </div>

                <div class="col-md-8 mt-4 col-sm-12 text-center">
                    <v-alert id="msg-alert" class="d-none" border="right" colored-border type="error" elevation="2">
                        Votre email n'est pas enregistré, vous pouvez vous inscrire ici: <a style="text-decoration: none;" href="http://adn.ascrea.ma">http://adn.ascrea.ma</a>
                    </v-alert>
                    <v-alert id="pwd-alert" class="d-none" border="right" colored-border type="error" dismissible elevation="2">
                        Votre mot de passe est erronée. Veuillez vérifier votre email pour le mot de passe correct
                    </v-alert>
                </div>

            </div>
        </div>
  </v-app>
</template>

<script>
export default {
    data(){
            return{
                valid: true,
                email:'',
                password:'',
                show:false,
                rules: {
                    required: value => !!value || 'Mot de passe est requis',
                },
                emailRules: [
                    v => !!v || 'E-mail est requis',
                    v => /.+@.+\..+/.test(v) || 'L\'email doit être valide',
                ],
            }
        },
        methods:{
            validate () {
               //console.log(this.email);
               if(this.password=='EADN@2020'){
                    axios.post('/login',{
                        email:this.email,
                    }).then((response) => {
                        //console.log(response.data)
                        if(response.data==0){
                            document.getElementById('msg-alert').classList.remove('d-none');
                            document.getElementById('msg-alert').classList.remove('d-block');
                        }else{
                            window.location.href='/stream?user='+response.data;
                        }
                    })
                }else{
                    document.getElementById('pwd-alert').classList.remove('d-none');
                    document.getElementById('pwd-alert').classList.remove('d-block');
                }
            },
        },
}
</script>

<style>
.input{
    color: white;
}
.input:focus{
    color: white;

}

</style>
