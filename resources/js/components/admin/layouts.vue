<template>
    <v-app>
        <div class="container">
            <div class="row justify-content-center text-center">
                <!-- theme -->
                <v-col class="col-md-3 col-sm-6" >
                <v-dialog
                    v-model="Dtheme"
                    scrollable
                    persistent :overlay="false"
                    max-width="500px"
                    transition="dialog-transition"
                >

                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="success"
                    fab
                    x-large
                    dark
                    v-bind="attrs"
                    v-on="on"
                    @click="Theme()"
                    >
                    <v-icon>mdi-page-layout-body</v-icon>
                    </v-btn>
                    <h5 class="mt-2" >Theme</h5>

                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">Theme</span>
                    </v-card-title>
                    <v-card-text>
                    <v-container>
                        <v-row>



                        <v-col cols="12">
                            <v-text-field
                            label="Theme"
                            v-model="theme"
                            required
                            ></v-text-field>
                        </v-col>

                        </v-row>
                    </v-container>

                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="Dtheme = false"
                    >
                        Quitter
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addTheme()"
                    >
                        Enregistrer
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
                </v-col>



                <v-col class="col-md-3 col-sm-6" >
                    <v-dialog
                    v-model="Itheme"
                    scrollable
                    persistent :overlay="false"
                    max-width="500px"
                    transition="dialog-transition"
                >

                <template v-slot:activator="{ on, attrs }">
                   <v-btn
                        color="warning"
                        fab
                        x-large
                        v-bind="attrs"
                        v-on="on"
                        dark
                        @click="Image()"
                        >
                        <v-icon>mdi-folder-image</v-icon>
                    </v-btn>

                    <h5 class="mt-2">Image</h5>

                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">Images</span>
                    </v-card-title>
                    <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-select
                                    :items="Themes"
                                    v-model="STheme"
                                    item-text="theme"
                                    label="Theme"
                                    dense
                                    outlined
                                ></v-select>
                            </v-col>

                            <v-col v-if="STheme" cols="12">
                                <v-row>
                                    <v-col cols="12">
                                        <input type="file" id="file" class="form-control" v-on:change="addImages">
                                        <!-- <v-file-input
                                            show-size
                                            counter
                                            name="file"
                                            id="file"
                                            ref="file"
                                            multiple
                                            label="File input"
                                            v-on:change="addImages"
                                        ></v-file-input> -->
                                        <!-- <v-btn
                                        color="primary"
                                        class="float-right"
                                        dark
                                        text
                                        @click="addImages"
                                        >
                                            <v-icon>mdi-plus</v-icon>
                                        </v-btn> -->
                                    </v-col>
                                    <v-col cols="12">
                                        <p color="black" class="font-weight-bold">Nombre des images ajouté : {{Images.length}}</p>
                                        <v-alert
                                        v-if="Images.length==200"
                                        border="right"
                                        colored-border
                                        type="error"
                                        elevation="2"
                                        >
                                        Vous avez atteint le nombre maximum de photos ajoutées
                                        </v-alert>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-container>

                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="Itheme = false"
                    >
                        Quitter
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="SendImages()"
                    >
                        Enregistrer
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
                </v-col>


                <v-col class=" col-md-3 col-sm-6" >
                    <v-dialog
                    v-model="Rtheme"
                    scrollable
                    persistent :overlay="false"
                    max-width="500px"
                    transition="dialog-transition"
                >

                <template v-slot:activator="{ on, attrs }">
                   <v-btn
                    color="dark"
                    fab
                    x-large
                    dark
                    v-bind="attrs"
                    v-on="on"
                    @click="OpenResume()"
                    >
                    <v-icon>mdi-account</v-icon>
                    </v-btn>

                    <h5 class="mt-2">Resume</h5>

                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">Resume</span>
                    </v-card-title>
                    <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-select
                                    :items="Themes"
                                    v-model="SRTheme"
                                    item-text="theme"
                                    label="Theme"
                                    dense
                                    outlined
                                ></v-select>
                            </v-col>


                            <v-col v-if="SRTheme" cols="12">
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="horraire"
                                            label="Horraire"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="titre"
                                            label="Titre de session"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="sujet"
                                            label="Speaker et Moderateur"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="desc"
                                            label="Description"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="nom"
                                            label="Nom de speaker"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="prenom"
                                            label="Prenom de speaker"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-chip label color="primary" text-color="light">
                                            Image de Profile
                                        </v-chip>
                                        <input type="file" id="file" class="form-control" v-on:change="addProfile">
                                    </v-col>



                                </v-row>
                            </v-col>
                        </v-row>
                    </v-container>

                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="Rtheme = false"
                    >
                        Quitter
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="SendResume()"
                    >
                        Enregistrer
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
                </v-col>

                <!-- Colors -->
                <v-col class=" col-md-3 col-sm-6">
                    <v-dialog
                    v-model="Dcolor"
                    scrollable
                    persistent :overlay="false"
                    max-width="500px"
                    transition="dialog-transition"
                >

                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="error"
                    fab
                    x-large
                    v-bind="attrs"
                    v-on="on"
                    dark
                    @click="Color()"
                    >
                    <v-icon>mdi-palette</v-icon>
                    </v-btn>

                    <h5 class="mt-2">Colors</h5>

                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">Color</span>
                    </v-card-title>
                    <v-card-text>
                    <v-container>
                        <v-row justify="space-around">

                            <v-col cols="12">
                                <v-select
                                    :items="Themes"
                                    v-model="SCTheme"
                                    item-text="theme"
                                    label="Theme"
                                    dense
                                    outlined
                                ></v-select>
                            </v-col>

                        <v-col v-if="SCTheme" cols="12">
                            <v-color-picker
                            class="ml-14"
                            dot-size="17"
                            hide-mode-switch
                            mode="hexa"
                            v-model="color"
                            swatches-max-height="188"
                            ></v-color-picker>
                        </v-col>

                        </v-row>
                    </v-container>

                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="Dcolor = false"
                    >
                        Quitter
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addColor()"
                    >
                        Enregistrer
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
                </v-col>
            </div>
            <Table></Table>
        </div>
    </v-app>
</template>

<script>
import Table from './theme'
export default {
    data(){
        return{
            Dtheme:false,
            theme:'',
            Themes:[],
            Dcolor:false,
            color:'',
            Itheme:false,
            Images:[],
            STheme:'',
            Rtheme:false,
            SRTheme:'',
            Resume:[],
            horraire:'',
            titre:'',
            sujet:'',
            desc:'',
            nom:'',
            prenom:'',
            link:'',
            SCTheme:'',

        }
    },
    mounted(){
        axios.get('/getthemes').then((response) => {
            this.Themes=response.data
        })
    },
    methods:{
        Theme(){
            this.Dtheme=true;
        },
        addTheme(){
            axios.post('addtheme',{
                'theme': this.theme
            }).then(this.Dtheme=false)
        },
        Color(){
            this.Dcolor=true;
        },
        addColor(){
            //console.log(this.color)
            axios.post('addcolor',{
                'theme' : this.SCTheme,
                'color': this.color

            }).then(this.Dcolor=false)
        },
        Image(){
            this.Itheme=true
        },
        addImages(e){
            if(this.Images.length<200){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                    // var json = {'theme' : this.STheme, file:document.getElementById('file').files[0]}
                    // this.Images.push(json)
            }

        },
        createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    var json = {'theme' : this.STheme, file:e.target.result}
                    this.Images.push(json)
                    document.getElementById('file').value='';
                    //vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
        },
        SendImages(){
            // console.log(this.Images)
            axios.post('/addimages',{
                data: this.Images
            })
            this.Images=[]
            this.STheme=''
        },
        OpenResume(){
            this.Rtheme=true
        },
        addProfile(e){
            if(this.Images.length<200){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                this.createProfile(files[0]);
                    // var json = {'theme' : this.STheme, file:document.getElementById('file').files[0]}
                    // this.Images.push(json)
            }

        },
        createProfile(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    var json = {'theme' : this.SRTheme, file:e.target.result,'title':this.titre,'horraire':this.horraire,'sujet':this.sujet,'desc':this.desc,'state':1}
                    this.Resume.push(json)
                    //vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
        },
        SendResume(){

            if(document.getElementById('file').value==""){
                this.link='https://ui-avatars.com/api/?background=3F37C9&color=fff&name='+this.nom+'+'+this.prenom
                var json = {'theme' : this.SRTheme, 'file':this.link,'title':this.titre,'horraire':this.horraire,'sujet':this.sujet,'desc':this.desc,'state':0}
                this.Resume.push(json)

                this.nom=this.prenom=this.link=this.SRTheme=this.titre=this.horraire=this.sujet=this.desc=''
            }

            axios.post('/addresume',{
                resume:this.Resume
            })

            // console.log(this.Resume)
        }
    },
    components: {
        Table
    }
}
</script>

<style>

</style>

