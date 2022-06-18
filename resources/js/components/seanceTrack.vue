<template>
    <v-container>
        <v-row>
            <v-col cols="12" align='center'>
                <v-progress-circular v-if="load" indeterminate color="green" ></v-progress-circular>
            </v-col>
            <v-snackbar  v-model="snackbar" :color="snackColor"  timeout="3000" >
                {{ msg }}
            </v-snackbar>
        </v-row>
        <v-row>
            <v-col cols="6" @click="getEntrerDialog" align="center">
                <v-btn class="ma-2" outlined color="green" large>
                    Entrer
                </v-btn>
            </v-col>
            <v-col cols="6" @click="getSortieDialog" align="center">
                <v-btn class="ma-2" outlined color="red" large>
                    Sortie
                </v-btn>
            </v-col>
            <v-dialog v-model="dialogCode" max-width="500px">
                <v-card>
                    <stream v-if="dialogCode" @decode="onDecode" @loaded="onLoaded"></stream>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="dialogCode = false">Fermer</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                <v-card-title>
                    Seance Track
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details ></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="reservations" :search="search"  class="elevation-1" >
                </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
/* import { StreamBarcodeReader } from "vue-barcode-reader"; */
  export default {
    /* components: {StreamBarcodeReader}, */
    data: () => ({
        user:[],
        reservations:[],
        id:'',
        search:'',
        dialogCode:false,
        new:true,
        barecode:'',
        load:false,
        snackbar:false,
        snackColor:'',
        msg:'',
        headers:[
			{ text: 'Nom', align: 'start', value: 'user.name', },
			{ text: 'Prenom', value: 'user.prenom' },
			{ text: 'Email', value: 'user.email' },
			{ text: 'Entere', value: 'date_entre' },
            { text: 'Sortie', value: 'date_sortie' },
			{ text: 'Actions', value: 'actions', sortable: false },
		],

    }),
    methods: {
        getSeanceData(){
                axios.post('/getSeancesData',{'id':this.id}).then((res)=>{
                    this.reservations = res.data
                    console.log(this.reservations)
                })
        },
        getEntrerDialog(){
            this.new = true
            this.dialogCode = true
        },
        getSortieDialog(){
            this.new = false
            this.dialogCode = true
        },
        closeDialogCode(){
            this.dialogCode = false
            this.load = true
        },
        onDecode(barecode) {
            this.closeDialogCode()
            this.barecode = barecode
            console.log(this.barecode)
            if(this.new){
                const existe = this.reservations.find(element => element.user.barecode == this.barecode);
                !existe ? this.addNewTrack() : this.error('existe')
            }
            if(!this.new){
                const existe = this.reservations.find(element => element.user.barecode == this.barecode);
                existe ? this.addTrackEnd() : this.error('not existe')
            }
        },
        onLoaded() {
            console.log(`Ready to start scanning barcodes`)
        }, 
        addNewTrack(){
            axios.post('/addReservation',{'id':this.id,'barecode':this.barecode}).then(()=>{
                this.endOfScan()
            })
        },
        addTrackEnd(){
            const reservation = this.reservations.find(element => element.user.barecode == this.barecode);
            console.log(reservation)
            axios.post('/addReservationEnd',{'id':reservation.id}).then(()=>{
                this.endOfScan()
            })
        },
        endOfScan(){
            this.barecode = ''
            this.load = false
            this.snackbar = true
            this.snackColor = 'green'
            this.msg = "succes"
            this.getSeanceData()
        },
        error(msg){
            this.load = false
            this.snackbar = true
            this.snackColor = 'red'
            msg === "existe" ? this.msg = "user track existe deja" : this.msg = "user track n'existe pas" 
        },

    },
    created(){
        this.id = this.$route.params.id
        this.getSeanceData()
    },
    mounted() {
    },
  }
</script>