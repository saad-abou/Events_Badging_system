<template>
  <v-app>
      <v-card>
    <v-card-title>
      Numbre of users online : {{users.length}}
      <v-spacer></v-spacer>
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
      :items="users"
      :search="search"
    ></v-data-table>
  </v-card>
  </v-app>
</template>

<script>
 export default {
    data(){
        return{
            search: '',
            count:0,
            headers: [
            {
                text: 'Nom',
                align: 'start',
                value: 'name',
            },
            {
                text: 'Email',
                value: 'email',
            },
            ],
            users:[],
        }
    },
    mounted(){
      this.listen()
    },
    methods:{
        listen(){
            let presence = Echo.join('joined')

            presence.here((users) => {
                this.users=users
            })

            presence.joining((user) => {
                this.users.push(user)
            })

            presence.leaving((user) => {
                this.users= this.users.filter(e => (e.id !==user.id))
            })
        },
    }
  }
</script>

<style>

</style>
