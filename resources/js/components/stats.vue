<template>
  <v-app>
    <v-container class="noprint">
        <v-row class="mt-4">
            <div class="col-md-4 col-sm-12 mb-2">
                <v-card>
                    <v-card style="margin-top:-20px;margin-right:20px;" width="30%" class="text-center p-4 orange darken-2 float-right">
                        <v-icon style="font-size:30px" dark >mdi-speedometer</v-icon>
                    </v-card>
                    <v-card-title class="mb-5" primary-title>
                        <div>
                          <h3 class="headline mb-0">Inscrits : <span class=" orange--text text--darken-2">{{users.length}}</span></h3>
                        </div>
                    </v-card-title>
                </v-card>
            </div>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        <!-- <v-btn class="p-3 mr-3" @click="dialogCode = true" color="blue-grey darken-2">
                            <v-icon color="white" >
                                mdi-barcode-scan
                            </v-icon>
                        </v-btn> -->
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialogCode" >
                            <v-card align="center">
                                <stream v-if="dialogCode" @decode="onDecode" @loaded="onLoaded"></stream>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" text @click="dialogCode = false">Fermer</v-btn>
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
                                    <span v-if="existeEmailInfo.admin">Admin :<b>{{existeEmailInfo.admin.name}}</b></span><br>
                                    <v-btn v-if="confirme(existeEmailInfo)" @click="print(existeEmailInfo)" outlined color="green">
                                        <v-icon small >
                                            mdi-printer
                                        </v-icon>
                                    </v-btn>
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
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="all_headers" :items="users" :search="search" sort-by="calories"  class="elevation-1" >
                        <template v-slot:[`item.confirme`]="{ item }">
                            <v-chip :color="getConfirme(item.confirme)" dark >
                                <v-icon>{{ getConfirmeIcon(item.confirme) }}</v-icon>
                            </v-chip>
                        </template>
                        <template v-slot:[`item.statut`]="{ item }">
                            <v-chip :color="getStatut(item.statut)" dark >
                                <b>{{ item.statut }}</b>
                            </v-chip>
                        </template>
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-divider class="mx-4" inset vertical ></v-divider>
                                    <v-spacer></v-spacer>
                                <v-dialog v-model="dialogconfirmation" max-width="500px" persistent>
                                    <v-card>
                                        <v-form ref="form" v-model="valid" lazy-validation >
                                            <v-card-title class="text-h5" style="white-space:nowrap;">Confirmation de {{ editedItem.name }} {{ editedItem.prenom }} </v-card-title>
                                            <v-card-text>
                                                <b v-if="!newEmail">{{ editedItem.email }} </b>
                                                <v-col cols="12" md="12" sm="12" v-if="newEmail">
                                                    <v-text-field label="Email*" oninput="this.value = this.value.toLowerCase()"  :rules="[emailRules.email,checkExiste]"  color="blue darken-4" v-model="editedItem.email" class="my-input" required>
                                                    </v-text-field>
                                                </v-col>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                    <v-btn color="blue darken-1" text @click="close">Annuler</v-btn>
                                                    <v-btn color="blue darken-1" text @click="confirmItem" v-if="editedItem.email" :loading="loading">Confirmer</v-btn>
                                                <v-spacer></v-spacer>
                                            </v-card-actions>
                                        </v-form>
                                    </v-card>
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:[`item.actions`]="{ item }" >
                            <v-col cols="12" align="right">
                                <v-icon large class="" v-if="!item.confirme || item.confirme == 0" @click="editItemConfirm(item)" >
                                    mdi-check-bold
                                </v-icon>
                                <v-icon large @click="getEmailInfo(item)">
                                    mdi-text-box-search
                                </v-icon>
                            </v-col>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
        <div class="col-md-4 col-sm-12 mb-2">
            <a href="/users/export/" style="text-decoration:none">
            <v-btn color="green" style="color:white">Export</v-btn>
            </a>
        </div>
    </v-container>
     <v-container class="print">
        <v-row >
            <v-col align="center" class="printName" cols="12">
                <b >{{getallname}}</b><br>
            </v-col>
        </v-row>
    </v-container>
  </v-app>
</template>

<script>
/* import { StreamBarcodeReader } from "vue-barcode-reader"; */
export default {
    /* components: {StreamBarcodeReader}, */
    data(){
        return{
            dialogconfirmation: false,
            dialog:false,
            dialogCode:false,
            dialogInfo:false,
            users:[],
            search:'',
            loading: false,
            newEmail:false,
            valid: true,
            emailRules: {
                   required: v => !!v || 'E-mail vide',
                   email: v => /.+@.+\..+/.test(v) || 'Email doit être valide',
                },
            existeEmailInfo:'',
            editedIndex: -1,
            all_headers:[
                { text: 'Nom', align: 'start', value: 'name', },
                { text: 'Prenom', value: 'prenom' },
                /* { text: 'Email', value: 'email' }, */
                { text: 'Statut', value: 'statut' },
                { text: 'Confirme', value: 'confirme' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            editedItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                payproof:'',
                etudeproof:'',
                email:'',
                pdf:'',
                pdfetud:''
            },
            defaultItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                payproof:'',
                etudeproof:'',
                email:'',
                pdf:'',
                pdfetud:''
            },
            printPrenom:'',
            printNom:''
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
         window.setInterval(() => {
                this.getTotal()
            }, 100000)
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
            !this.editedItem.email ? this.newEmail = true : this.newEmail = false
            this.dialogconfirmation = true
        },

        confirmItem () {
            if(this.$refs.form.validate()){
                this.loading = true
                axios.post('confirmUser',{'editedItem':this.editedItem}).then(()=>{
                    this.close()
                    this.loading = false
                    this.getTotal()
                })
            }
            else{
                this.loading = false
                return false
            }
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
           if(confirme && confirme > 0){
               return "green"
           }
           else{
               return "red"
           }
        },
        getConfirmeIcon (confirme) {
           if(confirme && confirme > 0){
               return "mdi-check-bold"
           }
           else{
               return "mdi-close-thick"
           }
        },
        getStatut(statut){
            if(statut =="participant"){
               return "#0D47A1"
           }
           else if(statut =="speaker"){
                return "#4527A0"
           }
            else if(statut =="comite"){
                return "#B71C1C"
           }
           else if(statut =="sponsor"){
                return "green"
           }
           else{
            return "#000000"
           }
        },

        print (item) {
            this.printPrenom = item.prenom
            this.printNom = item.name
            this.closeInfodialog()
            setTimeout(function() { 
                window.print();
            }, 700)
            axios.post('addBadge',{'id':item.id}).then(()=>{
                    this.getTotal()
                })
        },
        confirme(val){
           return val.confirme ? true : false
        },
        onDecode(barecode) {
            this.dialogCode = false
            this.search = barecode
        },
        onLoaded() {
            console.log(`Ready to start scanning barcodes`)
        }, 
        getData(){
            this.getTotal();
        },
        getEmailInfo(val){
            this.existeEmailInfo = val
            this.dialogInfo = true
        },
        closeInfodialog(){
                this.existeEmailInfo = ''
                this.dialogInfo = false
            },
        checkExiste(val) {
                if (val && val.length>9){
                    const count2 = this.users.filter(item => item.email === val).length
                    if(count2>0){
                        return `email deja existe`;
                    }
                    else {
                        return true;
                    }
                }
                else{
                    return true;
                }
            },
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
