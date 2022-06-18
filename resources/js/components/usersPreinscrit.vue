<template>
  <v-app>
    <v-container class="noprint">
        <v-row class="mt-4">
            <v-col cols="12" md="4" sm="12" class="mb-2">
                <v-card>
                    <v-card style="margin-top:-20px;margin-right:20px;" width="30%" class="text-center p-4 orange darken-2 float-right">
                        <v-icon style="font-size:30px" dark >mdi-speedometer</v-icon>
                    </v-card>
                    <v-card-title class="mb-5" primary-title>
                        <div>
                          <h3 class="headline mb-0">Préinscrits : <span class=" orange--text text--darken-2">{{users.length}}</span></h3>
                        </div>
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        Préinscrits
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <new-compte-form v-on:addcompte="getTotal()"></new-compte-form>
                    <v-data-table :headers="all_headers" :items="users" :search="search" sort-by="calories"  class="elevation-1" >
                        <template v-slot:item.confirme="{ item }">
                            <v-chip :color="getConfirme(item.confirme)" dark >
                                <v-icon>{{ getConfirmeIcon(item.confirme) }}</v-icon>
                            </v-chip>
                        </template>
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-divider class="mx-4" inset vertical ></v-divider>
                                    <v-spacer></v-spacer>
                                <v-dialog v-model="dialogconfirmation" max-width="500px">
                                    <v-card>
                                        <v-card-title class="text-h5">Êtes-vous sûr de confirmer l'inscription de {{ editedItem.name }} {{ editedItem.prenom }} ?</v-card-title>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                                <v-btn color="blue darken-1" text @click="close">Annuler</v-btn>
                                                <v-btn color="blue darken-1" text @click="confirmItem">Confirmer</v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                                <v-dialog v-model="dialogInfo" width="500" >
                                    <v-card>
                                        <v-card-title class="text-h5 grey lighten-2">
                                            Compte Informations
                                        </v-card-title>
                                        <v-card-text>
                                            <span>Prenom :<b>{{existeEmailInfo.prenom}}</b></span><br>
                                            <span>Nom :<b>{{existeEmailInfo.name}}</b></span><br>
                                            <span>Statut :<b>{{existeEmailInfo.statut}}</b></span><br>
                                            <span>Email :<b>{{existeEmailInfo.email}}</b></span><br>
                                            <span>GSM :<b>{{existeEmailInfo.tlf}}</b></span><br>
                                            <span>Badge :<b>{{existeEmailInfo.badge}}</b></span><br>
                                            <span>Barecode :<b>{{existeEmailInfo.barecode}}</b></span><br>
                                            <span v-if="existeEmailInfo.admin">Admin :<b>{{existeEmailInfo.admin.name}}</b></span>
                                        </v-card-text>
                                        <v-divider></v-divider>
                                        <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="primary" text  @click="closeInfodialog">
                                            Fermer
                                        </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }" >
                            <v-row>
                            <v-col cols="4">
                            <v-icon large v-if="confirme(item)" @click="editItemConfirm(item)" >
                                mdi-check-bold
                            </v-icon>
                            </v-col>
                            <v-col cols="4" class="ml-4">
                            <v-icon @click="getEmailInfo(item)">
                                mdi-text-box-search
                            </v-icon>
                            </v-col>
                            </v-row>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <v-container class="print">
        <v-row align="center" justify="center">
            <v-col align="center" class="printName">
            <b>{{getallname}}</b>
            </v-col>
        </v-row>
    </v-container>
  </v-app>
</template>

<script>
import newCompteForm from './newCompteForm.vue';
export default {
  components: { newCompteForm },
    data(){
        return{
            dialogconfirmation: false,
            dialog:false,
            users:[],
            search:'',
            dialogInfo:false,
            existeEmailInfo:'',
            editedIndex: -1,
            all_headers:[
                { text: 'Nom', align: 'start', value: 'name', },
                { text: 'Prenom', value: 'prenom' },
                /* { text: 'Email', value: 'email' }, */
                { text: 'Barecode', value: 'barecode' },
                { text: 'Confirme', value: 'confirme' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            editedItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                email:'',
            },
            defaultItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                email:'',
            },
        }
    },
    created(){
        this.getTotal();
    },
    mounted(){
        Echo.channel('newbadge')
         .listen('badgeEvent', (e) => {
                this.getTotal()
         });
    },
    methods:{
        getTotal(){
            axios.get('gettotalusers').then((res) => {
                this.users=res.data
            })
        },
        editItem (item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        editItemConfirm (item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogconfirmation = true
        },

        confirmItem () {
            axios.post('confirmUser',{'editedItem':this.editedItem}).then(()=>{
                this.close()
                this.getTotal()
            })
        },

        close () {
            this.dialog = false
            this.dialogconfirmation = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        getConfirme (confirme) {
           if(confirme){
               return "green"
           }
           else{
               return "red"
           }
        },
        getConfirmeIcon (confirme) {
           if(confirme){
               return "mdi-check-bold"
           }
           else{
               return "mdi-close-thick"
           }
        },
        getEmailInfo(val){
            this.existeEmailInfo = val
            this.dialogInfo = true
        },
        closeInfodialog(){
                this.existeEmailInfo = ''
                this.dialogInfo = false
            },
        confirme(val){
           return val.confirme ? false : true
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nouveu Produit' : 'modifier produit'
        },
        getallname(){
            return this.printPrenom + ' ' + this.printNom
        }
    },

    watch: {
        dialog (val) {
        val || this.close()
        },
    },
    
}
</script>

<style>

</style>
