<template>
  <v-app>
      <div class="container">
          <v-row>
              <v-col class="col-md-12 col-sm-12 text-center">
                  <img width="300px" src="/athlasAmou.png">
              </v-col>
              <div class="col-md-12 ">
                   <v-icon @click="reload()" style="font-size:25px;cursor: pointer;" class="float-right blue--text lighten-3">mdi-refresh</v-icon>
              </div>

              <div class="col-md-12">
                    <v-expansion-panels>
                        <v-expansion-panel class="white">
                                <v-expansion-panel-header class=" font-weight-bold">
                                    Archive
                                </v-expansion-panel-header>
                                <v-expansion-panel-content v-for="(i,index) in sent" :key="index">
                                    <v-card outlined>
                                            <v-card-title primary-title>
                                                <span>{{i.name}}</span>
                                            </v-card-title>
                                            <v-card-text id="dis_2">
                                            <p style="font-size:16px" class="font-weight-light">
                                                {{i.question}}
                                            </p>
                                        </v-card-text>
                                    </v-card>
                                </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
              </div>

              <div class="col-md-12">
                  <h3 class=" white--text">Questions </h3>
              </div>

              <v-col v-for="question in questions" :key="question.id" class="col-md-12 col-sm-12">
                  <v-card>
                        <v-card-title primary-title>
                            <span>{{question.name}}</span>
                        </v-card-title>
                        <v-card-text id="dis_2">
                           <p style="font-size:16px" class="font-weight-light">
                               {{question.question}}
                                <v-icon @click="send(question.id)" style="font-size:25px;cursor: pointer;" color="cyan" class="float-right">mdi-send</v-icon>
                           </p>

                       </v-card-text>
                   </v-card>
              </v-col>
          </v-row>
      </div>
  </v-app>
</template>

<script>
export default {
    data(){
        return{
            questions:[],
            sent:[],
        }
    },
    mounted(){
        this.getData()

        window.setInterval(() => {
                this.getData()
            }, 3000)
    },
    methods:{
        reload(){
            this.getData()
        },
        send(id){
            for (let i = 0; i < this.questions.length; i++) {
                if(this.questions[i].id==id){
                    this.sent.push(this.questions[i])
                    this.questions.splice(i,1)
                }
            }
            axios.post('/sharescreen/'+id);
        },
        getData(){
            axios.get('/getquestions').then((e) => {
            this.questions=e.data;
            }).then(() => {
                axios.get('/getarchive').then((e) => {
                    this.sent=e.data;
                })
            })
        }
    }
}
</script>
