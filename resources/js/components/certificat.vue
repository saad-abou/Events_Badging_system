<template >
    <v-app style="background-image: linear-gradient(to right top, #1a5174, #1d4161, #1d314f, #1a233c, #14152a);">
        <v-container>
        <v-card v-if="auth_user.statut == 'participant' && auth_user.confirme == 1">
            <div class="instructiontext p-3">
                <h3 style="color:#408DBE;text-align: center;"><b>Votre certificat est disponible !</b></h3>
                <div class="wrapper">
                    <div class="divider div-transparent"></div>
                </div>
                Cliquez sur "Télécharger" pour obtenir votre certificat !<br>
                <div class="wrapper">
                    <div class="divider div-transparent"></div>
                </div>
                <v-row>
                    <v-col cols="12" align="center">
                        <span style="color:#204563;white-space: pre-line;" class="sName"><b style="color:#E4A837">CERTIFICAT DE PARTICIPATION</b></span><br><br>
                        <a color="green" @click="getpdfparticip()" outlined>
                            TÉLÉCHARGER MON CERTIFICAT <v-icon>mdi-download-outline</v-icon>
                        </a>
                    </v-col>
                </v-row>
                <div class="wrapper">
                    <div class="divider div-transparent"></div>
                </div>
            </div>
        </v-card>
        <v-card v-else>
            <div class="instructiontext p-3">
                <h3 style="color:#408DBE;text-align: center;"><b>Certificat non disponible !</b></h3>
                <div class="wrapper">
                    <div class="divider div-transparent"></div>
                </div>
            </div>
        </v-card>
        <v-dialog v-model="pdfdialog" max-width="500px" persistent>
            <v-card min-height="50px">
                <v-card-text>
                    <v-row>
                        <v-col align="center">
                        <b v-if="starttelecharg" color="primary" >Téléchargement en cours...</b>
                        <a v-if="!starttelecharg" :href='"/storage/pdf/"+url' target="_blanck" @click="close" download> TÉLÉCHARGER MON CERTIFICAT <v-icon>mdi-download-outline</v-icon></a>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
        </v-container>
    </v-app>
</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        show:false,
        pdfdialog:false,
        starttelecharg:false,
        url:"",
        user:[],
        componentKey: 0,

    }),
    props:['auth_user'],
    methods: {
        getuser(){
            axios.get('userreservation').then((res) =>{ 
                this.user = res.data
            })
        },
        reload(){
            this.componentKey += 1; 
        },
        getpdfparticip(){
            this.snackbar = true
            this.pdfdialog = true
            this.starttelecharg = true
            axios.get('certificat-generate').then((res)=>{
                            this.url = res.data
                            this.starttelecharg = false
                        })
        },
        close(){
                this.pdfdialog = false
                this.starttelecharg = false
            }
    },
    created(){
    },
    mounted() {
    },
  }
</script>

<style>
.heurire{
    max-width: 120px;
    color: white;
    background-color: #E4A837;
    font-size: 15px;
}

.date{
    font-family: 'Montserrat', sans-serif;
    color: #165274;
    background-color: #E4A837;
    font-size: 19px;
}

.instructiontext{
    font-size: 14px;
    font-family: 'Montserrat', sans-serif;
    word-break: keep-all;
  }


.wrapper
{
	padding-bottom: 20px;
}

.divider
{
	position: relative;
	margin-top: 40px;
	height: 1px;
}

.div-transparent:before
{
	content: "";
	position: absolute;
	top: 0;
	left: 5%;
	right: 5%;
	width: 90%;
	height: 1px;
	background-image: linear-gradient(to right, transparent, rgb(0, 0, 0), transparent);
}
  
@media (min-width: 1263px) {
    .margebnt{
    margin-left: -90px!important;
    }

}

@media (max-width: 767px) {
  .instructiontext{
      font-size: 12px;
      font-family: 'Montserrat', sans-serif;
  }
}

@media (max-width: 380px) {
  .timeline{
      margin-left: -20px!important;
  }
}
</style>