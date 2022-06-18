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
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
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
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }" >
                            <v-icon small class="" @click="editItemConfirm(item)" >
                                mdi-check-bold
                            </v-icon>
                            <v-icon small v-if="confirme(item)" @click="print(item)" >
                                mdi-printer
                            </v-icon>
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
        <v-row align="center" justify="center">
            <v-col align="center" class="printName">
            <b>{{getallname}}</b>
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
            users:[],
            search:'',
            pdf:false,
            editedIndex: -1,
            all_headers:[
                { text: 'Nom', align: 'start', value: 'name', },
                { text: 'Prenom', value: 'prenom' },
                { text: 'Statut', value: 'statut' },
                { text: 'Email', value: 'email' },
                { text: 'GSM', value: 'tlf' },
                { text: 'Barecode', value: 'barecode' },
                { text: 'Badge', value: 'badge' },
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

        print (item) {
            this.printPrenom = item.prenom
            this.printNom = item.name
            setTimeout(function() { 
                window.print();
            }, 500)
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
