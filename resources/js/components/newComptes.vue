<template>
    <v-app>
        <v-container >
            <v-data-table :headers="headers"  :items="comptes" :search="search" sort-by="calories"  class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat >
                    <v-toolbar-title>Ajouter une liste</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-text-field   v-model="search" append-icon="mdi-magnify"
                                        label="Search" single-line
                                        hide-details >
                        </v-text-field>
                    <v-dialog  v-model="dialog" max-width="500px" >
                    <v-card>
                        <v-card-title>
                        <span class="headline"> Edit Item </span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-form ref="form" lazy-validation>
                                    <v-row>
                                        <v-col cols="12" md="3" sm="6">
                                            <v-text-field v-model="editedItem.statut"  counter="250"
                                            :rules="[v => !!v || 'statut vide']"
                                            label="Statut*"
                                            required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12"  md="3" sm="6">
                                            <v-text-field label="Nom*" v-model='editedItem.nom' counter="250"
                                            :rules="[v => !!v || 'nom vide']"
                                            required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12"  md="3" sm="6">
                                            <v-text-field label="prenom*"
                                            v-model='editedItem.prenom'
                                            counter="250"
                                            :rules="[v => !!v || 'prenom vide']"
                                            required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="12"  md="4" sm="12">
                                            <v-text-field label="Email*"
                                            v-model='editedItem.email'
                                            counter="250"
                                            :rules="[checkExiste]"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12"  md="4" sm="6">
                                            <v-text-field label="Ville*"
                                            v-model='editedItem.ville'
                                            counter="250"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12"  md="4" sm="6">
                                            <v-text-field label="Gsm*"
                                            v-model='editedItem.gsm'
                                            counter="250"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text  @click="close" >
                                Fermer
                            </v-btn>
                            <v-btn  color="blue darken-1" text  @click="save" >
                                Modifier
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="headline">Êtes-vous sûr de bien vouloir supprimer ce compte?</v-card-title>
                            <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Fermer</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">Suprimer</v-btn>
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
                                <span>Nom :<b>{{existeEmailInfo.nom}}</b></span><br>
                                <span>Ville :<b>{{existeEmailInfo.ville}}</b></span><br>
                                <span>Statut :<b>{{existeEmailInfo.statut}}</b></span><br>
                                <span>Email :<b>{{existeEmailInfo.email}}</b></span>
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
            <template v-slot:item.actions="{ item }">
                <v-icon  small class="mr-2" @click="editItem(item)" >
                    mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:item.existe="{ item }">
                <v-chip color="red" v-if="checkDuplicate(item.email) == 'D'" dark >
                    Email double
                </v-chip>
                 <v-chip color="amber accent-4" v-if="checkDuplicate(item.email) == 'E'" dark >
                    Deja enregistrer
                </v-chip>
                <v-icon v-if="checkDuplicate(item.email) == 'E'" @click="getEmailInfo(item)">
                    mdi-text-box-search
                </v-icon>
                <v-chip color="green" v-if="checkDuplicate(item.email) == 'U'" dark >
                    Unique
                </v-chip>
                <v-chip color="black" v-if="checkDuplicate(item.email) == 'L'" dark >
                    N'existe pas
                </v-chip>
            </template>
            <template v-slot:no-data>
                <v-btn  color="primary" >
                    Reset
                </v-btn>
            </template>
        </v-data-table>
        <v-alert class="mt-3" v-show="errorMsg" dense outlined type="error">
            {{ errorMsg }}
        </v-alert>
        <v-row >
            <v-col cols="12" md="3">
                <input class="form-control" @change="addInput()" type="file" id="input" accept=".xls,.xlsx,.csv"  >
            </v-col>
            <v-col cols="12" md="2">
                <button class="btn btn-primary" @click="addExcelList()">Upload</button>
            </v-col>
            <v-col cols="12" md="6" >
                <v-btn   color="blue-grey" :disabled="addBlock"
                class="ma-2 white--text" @click="addComptes" :loading="loading">
                    Ajouter
                <v-icon right dark>
                    mdi-cloud-download
                </v-icon>
                </v-btn>
            </v-col>
        </v-row>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        data() {
            return {
               dialog: false,
               dialogDelete: false,
               dialogInfo:false,
               accountsEmails:[],
               user:[],
               search:'',
               existeEmailInfo:'',
               addBlock:true,
               errorMsg:'',
               loading: false,
               comptes :[{
                    statut:'',
                    nom:'',
                    prenom:'',
                    ville:'',
                    gsm:'',
                    email:'',
                }],
                emailRules: {
                   /* required: v => !!v || 'E-mail vide',
                   email: v => /.+@.+\..+/.test(v) || 'Email doit être valide', */
                },
                selectedFile:'',
                headers: [
                    {
                    text: 'Nom',
                    align: 'start',
                    value: 'nom',
                    },
                    { text: 'Prenom', value: 'prenom' },
                    { text: 'Statut', value: 'statut' },
                    { text: 'Email', value: 'email' },
                    { text: 'Gsm', value: 'gsm' },
                    { text: 'Existe', value: 'existe' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                statuts: [
                    'Dr',
                    'Pr',
                    'Staff',
                ],
                editedItem: {
                    statut:'',
                    nom:'',
                    prenom:'',
                    ville:'',
                    gsm:'',
                    email:'',
                },
                defaultItem: {
                    statut:'',
                    nom:'',
                    prenom:'',
                    ville:'',
                    gsm:'',
                    email:'',
                },
            }
        },
        watch: {
            comptes: {
            handler: 'checkComptes',
            deep: true
            }
        },
        methods: {
            editItem (item) {
                this.editedIndex = this.comptes.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                this.editedIndex = this.comptes.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },

            deleteItemConfirm () {
                this.comptes.splice(this.editedIndex, 1)
                this.closeDelete()
            },

            close () {
                this.dialog = false
                this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                })
            },

            closeDelete () {
                this.dialogDelete = false
                this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                })
            },
            save(){
                if(this.$refs.form.validate()){
                    if (this.editedIndex > -1) {
                        Object.assign(this.comptes[this.editedIndex], this.editedItem)
                    } else {
                        this.comptes.push(this.editedItem)
                    }
                    this.close()
                }
            },  

           supStaff(index){
            this.comptes.splice(index,1)
           },
            checkDuplicate(val) {
                if(val){
                const count = this.comptes.filter(item => item.email === val).length
                const count2 = this.accountsEmails.filter(item => item.email === val).length
                    if (count>1) {
                        return `D`;
                    } 
                    else if(count2>0){
                        return `E`;
                    }
                    else {
                        return `U`;
                    }
                }
                else{
                    return `L`;
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
            getEmailInfo(val){
                this.existeEmailInfo = val
                this.dialogInfo = true
            },
            closeInfodialog(){
                this.existeEmailInfo = ''
                this.dialogInfo = false
            },
            checkComptes(){
                //email check
                const uniqueEmails = new Set(this.comptes.map(v => v.email != null && v.email != "" ? v.email :this.comptes.indexOf(v) ));
                const compteNewEmails = this.comptes.map(item => item.email  );
                const accountsOldEmails = this.accountsEmails.map(item => item.email )
                //comptes nom prenom email check
                const uniqueComptes = new Set(this.comptes.map(v => v.nom+v.prenom));
                const comptesNew = this.comptes.map(item => item.nom+item.prenom);
                const accountsExiste = this.accountsEmails.map(item => item.nom+item.prenom)
                function findCommonElements(arr1, arr2) {
                    return arr1.some(item => arr2.includes(item))
                }
                 //email check
                if (uniqueEmails.size < this.comptes.length) {
                    this.errorMsg = "Un ou plusieurs email(s) sont utilisé(s) deux fois"
                    this.addBlock = true
                }
                else if(findCommonElements(compteNewEmails,accountsOldEmails)){
                    this.errorMsg = "Un ou plusieurs emails(s) sont déjà enregistré(s)"
                    this.addBlock = true
                }
                //comptes nom prenom email check
                else if (uniqueComptes.size < this.comptes.length) {
                    this.errorMsg = "Un ou plusieurs compte(s) sont utilisé(s) deux fois"
                    this.addBlock = true
                }
                else if(findCommonElements(comptesNew,accountsExiste)){
                    this.errorMsg = "Un ou plusieurs compte(s) sont déjà enregistré(s)"
                    this.addBlock = true
                }
                else if(this.comptes.some(item => item.statut == null) || 
                        this.comptes.some(item => item.nom == null) ||
                        this.comptes.some(item => item.prenom == null)){
                            this.errorMsg = "Un ou plusieurs champ(s) sont vide(s)"
                            this.addBlock = true
                }
                else {
                    this.errorMsg = ''
                    this.addBlock = false
                }            
            },

            addComptes () {
                this.loading = true
                if (!this.addBlock && this.comptes.length>1){
                    axios.post('addNewComptes', {'comptes':this.comptes }).then(()=>{
                        this.comptes = [{
                            statut:'',
                            nom:'',
                            prenom:'',
                            ville:'',
                            gsm:'',
                            email:'',
                        }]
                        this.loading = false,
                        this.addBlock = true
                    })
                }
                else{
                    this.loading = false,
                    this.addBlock = true
                }
            },

            addExcelList() {
                var XLSX = require("xlsx");
                if(!this.comptes[0].nom && !this.comptes[0].email )
                    {
                        this.comptes.splice(this.comptes[0])
                    }
                let data=[{
                        "name":"jayanth",
                        "data":"scd",
                        "abc":"sdef"
                    }]
                XLSX.utils.json_to_sheet(data, 'out.xlsx');
                if(this.selectedFile){
                    let fileReader = new FileReader();
                    fileReader.readAsBinaryString(this.selectedFile);
                    fileReader.onload = (event)=>{
                    let data = event.target.result;
                    let workbook = XLSX.read(data,{type:"binary"});
                    /* console.log(workbook); */
                    workbook.SheetNames.forEach(sheet => {
                        let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                        const keys = ["nom", "prenom", "statut", "email"]
                        let checkKeys
                        keys.every((e)=>{
                           checkKeys = Object.keys(rowObject[0]).includes(e);
                           if (!checkKeys) {
                                window.alert('L\'entête de votre fichier Excel doit respecter cet ordre "nom", "prenom" , "statut", "email"')
                                this.comptes = [{
                                    statut:'',
                                    nom:'',
                                    prenom:'',
                                    ville:'',
                                    gsm:'',
                                    email:'',
                                }]
                                this.selectedFile = ''
                                return false;
                            }
                            return true;
                        })
                        /* console.log(Object.keys(rowObject[0])); */
                        if (checkKeys) {
                            rowObject.forEach((e)=>{
                                this.comptes.push(e)
                            });
                        }
                       
                    });
                    }
                }
            },
            addInput(){
                 this.selectedFile = event.target.files[0];
            }

        },
        created() {
            axios.get('getuser').then((res) =>{ this.user = res.data })
            axios.get('getAccountsEmails').then((res) =>{this.accountsEmails = res.data})
        },
        mounted() {
            /* console.log(window.XLSX); */
        },
    }
</script>
