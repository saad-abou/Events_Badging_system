<template>
    <v-container>
        <v-card width="500">
            <v-card-title>
                <div>
                <span class="text-h5" style="font-family: 'Montserrat', sans-serif;color:#165274" >Nouveau compte</span><br>
                </div>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation >
                    <v-row>
                    <v-col  cols="12" md="6" sm="12"  >
                        <v-text-field label="Nom*" :rules="allRule"  color="blue darken-4" v-model="user.nom" required></v-text-field>
                    </v-col>
                    <v-col  cols="12" md="6" sm="12"  >
                        <v-text-field label="Prenom*" :rules="allRule"  color="blue darken-4" v-model="user.prenom" required></v-text-field>
                    </v-col>
                    <v-col cols="12" md="12" sm="12" >
                        <v-text-field label="Email*" oninput="this.value = this.value.toLowerCase()" :rules="[emailRules.email,checkExiste]"  color="blue darken-4" v-model="user.email" class="my-input" required>
                        </v-text-field>
                    </v-col>
                    <v-col  cols="12" md="12" sm="12" >
                        <v-select label="Statut" oninput="this.value = this.value.toLowerCase()" v-model="user.statut"  :items="items"  ></v-select>
                    </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-4" text  @click="close()">
                    Fermer
                </v-btn>
                <v-btn color="blue darken-4" text  :loading="loading" :disabled="loading" @click="validate()">
                    Ajouter
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script>
    export default {
        data () {
            return {
                dialog: false,
                loading: false,
                accountsEmails:[],
                items: ['participant', 'speaker', 'comite', 'sponsor'],
                user:{
                    nom:'',
                    premom:'',
                    email:'',
                    statut:''
                },
                defaultItem: {
                    nom:'',
                    premom:'',
                    email:'',
                    statut:''
                },
                allRule: [v => !!v || 'Ce champ est requis',],
                emailRules: {
                   required: v => !!v || 'E-mail vide',
                   email: v => /.+@.+\..+/.test(v) || 'Email doit être valide',
                },
                valid: true,
                
                
            }
        },
        computed: {
           
        },
        methods:{
            validate () {
                if(this.$refs.form.validate()){
                        this.loading = true
                        axios.post('addNewCompte', {
                            'user':this.user 
                        }).then((res)=>{
                            axios.post('confirmUser',{'editedItem':res.data}).then(()=>{
                                this.user = Object.assign({}, this.defaultItem)
                                this.$emit('close');
                                this.$emit('newCompte');
                                this.loading = false
                                this.dialog = false
                            })
                        })
                }
            },
            checkExiste(val) {
                if (val && val.length>9){
                    const count2 = this.accountsEmails.filter(item => item.email === val).length
                    if(count2>0){
                        return `email enregistrer`;
                    }
                    else {
                        return true;
                    }
                }
                else{
                    return true;
                }
            },
            close(){
                this.user = Object.assign({}, this.defaultItem)
                this.$emit('close');
            }
        },
        created() {
            axios.get('getAccountsEmails').then((res) =>{this.accountsEmails = res.data})
        },
    }
</script>
<style >
.textremerciment{
    padding: 10px;
    font-family: 'Montserrat', sans-serif;
    color: #ffffff;
    background-color: #E4A837;
    border-radius: 20px;
}
</style>