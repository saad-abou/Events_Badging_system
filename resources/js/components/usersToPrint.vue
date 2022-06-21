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
                            <h3 class="headline mb-0">Attendez : <span class=" orange--text text--darken-2">{{usersWithoutBadge.length}}</span></h3>
                            </div>
                        </v-card-title>
                    </v-card>
                </v-col>
                <!-- <v-col cols="12" md="8" sm="12" align="right">
                    <v-btn class="p-3" @click="dialogCode = true" color="blue-grey darken-2">
                        <v-icon color="white" large>
                            mdi-barcode-scan
                        </v-icon>
                    </v-btn>
                </v-col> -->
                <!-- <v-dialog v-model="dialogCode" >
                <v-card align="center">
                    <stream v-if="dialogCode" @decode="onDecode" @loaded="onLoaded"></stream>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="dialogCode = false">Fermer</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
                </v-dialog> -->
                <v-snackbar absolute bottom v-model="snackError" :color="snackColor"  timeout="3000" >
                    {{ msgError }}
                </v-snackbar>
            </v-row>
            <v-row>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>
                            Liste attente
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="all_headers" :items="usersWithoutBadge" :search="search" sort-by="calories"  class="elevation-1" >
                            <template v-slot:item.statut="{ item }">
                                <v-chip :color="getStatut(item.statut)" dark >
                                    <b>{{ item.statut }}</b>
                                </v-chip>
                            </template>
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-divider class="mx-4" inset vertical ></v-divider>
                                        <v-spacer></v-spacer>
                                </v-toolbar>
                            </template>
                            <template v-slot:item.actions="{ item }" >
                                <v-icon small class="" @click="print(item)" >
                                    mdi-printer
                                </v-icon>
                                <v-icon small class="" @click="editItem(item,'new')" >
                                    mdi-sticker-check
                                </v-icon>
                            </template>
                        </v-data-table>
                    </v-card>
                </v-col>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>
                            Badges imprimer
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="all_headers" :items="usersWithBadge" :search="search" sort-by="calories"  class="elevation-1" >
                            <template v-slot:item.statut="{ item }">
                                <v-chip :color="getStatut(item.statut)" dark >
                                    <b>{{ item.statut }}</b>
                                </v-chip>
                            </template>
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-divider class="mx-4" inset vertical ></v-divider>
                                        <v-spacer></v-spacer>
                                </v-toolbar>
                            </template>
                            <template v-slot:item.actions="{ item }" >
                                <v-icon small class="" @click="print(item)" >
                                    mdi-printer
                                </v-icon>
                                <v-icon small class="" @click="editItem(item,'old')" >
                                    mdi-sticker-plus
                                </v-icon>
                            </template>
                        </v-data-table>
                    </v-card>
                </v-col>
            </v-row>
            <v-snackbar absolute top right v-model="snackbar" timeout="4000" color="success" elevation="24">
                {{ msg }} est confirmer
            </v-snackbar>
            <audio id="audio"  src="notif.wav"></audio>
            <v-dialog v-model="dialog" max-width="500px">
            <v-card>
                <v-card-title class="text-h5">{{ formTitle }}{{editedItem.prenom}} {{editedItem.name}}</v-card-title>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Fermer</v-btn>
                <v-btn color="blue darken-1" text @click="confirmeBadge()">Oui</v-btn>
                <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
            </v-dialog>
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
            dialog:false,
            dialogCode:false,
            users:[],
            admin:[],
            usersWithBadge:[],
            usersWithoutBadge:[],
            search:'',
            snackbar:false,
            snackError:false,
            snackColor:'',
            msg:'',
            msgError:'',
            editedIndex: '',
            all_headers:[
                { text: 'Nom', align: 'start', value: 'name', },
                { text: 'Prenom', value: 'prenom' },
                { text: 'Badge', value: 'badge' },
                { text: 'Statut', value: 'statut' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            editedItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                barecode:'',
                email:'',
            },
            defaultItem: {
                id:'',
                name:'',
                prenom:'',
                statut:'',
                barecode:'',
                email:'',
            },
            printPrenom:'',
            printNom:'',
            printBare:''
        }
    },
    created(){
        this.getTotal();
        axios.get('getuser').then((res) =>{ this.admin = res.data })
    },
    mounted(){
        Echo.channel('newbadge')
         .listen('badgeEvent', (e) => {
                if(e.user['admin_id'] == this.admin.id){
                    this.snackbar = true
                    this.play()
                    this.msg = e.user['name']+' '+e.user['prenom']
                    this.getAttents()
                }
                else if(e.user['first_admin'] == this.admin.id){
                    this.getTotal()
                }
         });
        window.setInterval(() => {
                this.getAttents();
            }, 10000)
    },
    methods:{
        getTotal(){
            axios.get('getUsersPrint').then((res) => {
                this.users = res.data
                this.usersWithBadge=this.users.filter(user => user.badge )
            })
            axios.get('getUsersAttents').then((res) => {
                this.usersWithoutBadge=res.data
            })
        },
        getAttents(){
            axios.get('getUsersAttents').then((res) => {
                this.usersWithoutBadge=res.data
            })
        },
        editItem (item,statut) {
            this.editedIndex = statut
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },
        confirmeBadge () {
            axios.post('addBadgeAdmin',{'item':this.editedItem}).then(()=>{
                    this.getTotal()
                    this.close()
            })
        },

        editItemConfirm (item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = ''
            })
        },

        onDecode(barecode) {
            this.dialogCode = false
            const existeWaiting = this.usersWithoutBadge.find(user => user.barecode == barecode);
            if(existeWaiting)
            {
                this.editItem(existeWaiting,'new')
                this.snackError = true
                this.snackColor = 'green'
                this.msgError = "Badge ajouter avec succe"
            }
            else{
                const existe = this.usersWithBadge.find(user => user.barecode == barecode);
                if(existe){
                    this.editItem(existe,'old')
                    this.snackError = true
                    this.snackColor = 'green'
                    this.msgError = "Badge ajouter avec succe"
                }
                else{
                    this.snackError = true
                    this.snackColor = 'red'
                    this.msgError = "user n'existe pas dans votre liste"
                }
                
            }
        },
        onLoaded() {
            console.log(`Ready to start scanning barcodes`)
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
            this.printBare = item.barecode
            setTimeout(function() {
                window.print();
            }, 500)  
        },
        play() {
            var audio = document.getElementById("audio");
            audio.play();
        },
        getData(){
            this.getTotal();
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === 'new' ? 'Vous avez imprimer le badge de Mr(Mme) ' : 'Vous avez ajouter un badge pour Mr(Mme) '
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
.pdflink{
    color: white!important;;
    text-decoration: none!important;;
}
.print{
    display: none;
}

.printName{
        text-transform: uppercase;
        font-size:100px!important;
        margin-left: -15px!important;
        position: absolute;
        top: 40%;
        -ms-transform: translateY(-40%);
        transform: translateY(-40%);
        font-family: 'Poppins', sans-serif;
    }
@media print{
    .print{
        display: block;
    }
    .noprint{
        display: none;
    }
    .printName{
        text-transform: uppercase;
        font-size:100px!important;
        margin-left: -20px!important;
        position: absolute;
        top: 40%;
        -ms-transform: translateY(-40%);
        transform: translateY(-40%);
        font-family: 'Poppins', sans-serif;
    }
}
</style>
