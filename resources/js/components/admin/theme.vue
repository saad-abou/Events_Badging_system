<template>
  <v-app>
       <v-card>
            <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            </v-card-title>
            <v-data-table
            :headers="headers"
            :items="themes"
            :search="search"
            >
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                    v-if="item.state==0"
                    small
                    class="mr-1"
                    @click="show(item)"
                >
                    mdi-eye
                </v-icon>

                <v-icon
                    v-if="item.state==1"
                    small
                    class="mr-1"
                    @click="hide(item)"
                >
                    mdi-eye-off
                </v-icon>
            </template>

            </v-data-table>
        </v-card>
  </v-app>
</template>

<script>
export default {
    data(){
        return{
            themes:[],
            search: '',
            headers: [
            {
            text: 'Theme',
            align: 'start',
            filterable: false,
            value: 'theme',
            },
            { text: 'State', value: 'state' },
            { text: 'Actions', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            editedItem: {
                theme: '',
                state: 0,
            },
        }
    },
    mounted(){
        axios.get('/getthemes').then((response) => {
            this.themes=response.data
        });
    },
    methods:{
        show(item){
            this.editedIndex = this.themes.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.editedItem.state=1

            //Object.assign(this.themes[this.editedIndex], this.editedItem)

            axios.post('/showtheme/'+this.editedItem.id).then(() => {
                for(let i=0;i<this.themes.length;i++){
                    if(i!=this.editedIndex){
                        this.themes[i].state=0;
                    }else{
                        this.themes[this.editedIndex].state=1;
                    }
                }
            })
      },
      hide(item){
            this.editedIndex = this.themes.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.editedItem.state=0
            //Object.assign(this.themes[this.editedIndex], this.editedItem)

            axios.post('/hidetheme/'+this.editedItem.id).then(Object.assign(this.themes[this.editedIndex], this.editedItem))
      }
    }
}
</script>

<style>

</style>
