<template>
  <v-app>
      <div>
          <nav class="myNavbar noprint">
              <ul class="myNavbar-nav">
					<li class="logo">
						<a href="#" class="myNav-link" @click="goTo('/')">
						<span class="link-text logo-text">Menu</span>
						<svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="angle-double-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x">
							<g class="fa-group">
								<path fill="currentColor" class="fa-secondary"
									d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z">
								</path>
								<path fill="currentColor" class="fa-primary"
									d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z">
								</path>
							</g>
						</svg>
						</a>
					</li>
					<li class="myNav-item">
						<a href="#" @click="goTo('/')" class="myNav-link">
							<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="address-book" class="svg-inline--fa fa-address-book fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<g class="fa-group">
								<path fill="currentColor" class="fa-secondary"
										d="M436 160c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20zm-68 304H48V48h320v416zM208 256c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm-89.6 128h179.2c12.4 0 22.4-8.6 22.4-19.2v-19.2c0-31.8-30.1-57.6-67.2-57.6-10.8 0-18.7 8-44.8 8-26.9 0-33.4-8-44.8-8-37.1 0-67.2 25.8-67.2 57.6v19.2c0 10.6 10 19.2 22.4 19.2z">
								</path>
								</g>
							</svg>
							<span class="link-text">
								Liste Enregistrer
							</span>
						</a>
					</li>
					<li class="myNav-item">
						<a href="#" @click="goTo('/comptesToPrint')" class="myNav-link">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="account-multiple-check" class="svg-inline--fa fa-account-multiple-check fa-w-20" role="img"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<g class="fa-group">
									<path  fill="currentColor" class="fa-secondary"
									d="M19 17V19H7V17S7 13 13 13 19 17 19 17M16 8A3 3 0 1 0 13 11A3 3 0 0 0 16 8M19.2 13.06A5.6 5.6 0 0 1 21 17V19H24V17S24 13.55 19.2 13.06M18 5A2.91 2.91 0 0 0 17.11 5.14A5 5 0 0 1 17.11 10.86A2.91 2.91 0 0 0 18 11A3 3 0 0 0 18 5M7.34 8.92L8.5 10.33L3.75 15.08L1 12.08L2.16 10.92L3.75 12.5L7.34 8.92">
									</path>
								</g>
							</svg>
							<span class="link-text">
								Comptes à imprimer
							</span>
						</a>
					</li>
					<li class="myNav-item">
						<a href="#" @click="goTo('/newcomptes')" class="myNav-link">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="users-cog" class="svg-inline--fa fa-users-cog fa-w-20" role="img"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
								<g class="fa-group">
									<path  fill="currentColor" class="fa-secondary"
									d="M610.5 341.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 368.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm224 32c1.9 0 3.7-.5 5.6-.6 8.3-21.7 20.5-42.1 36.3-59.2 7.4-8 17.9-12.6 28.9-12.6 6.9 0 13.7 1.8 19.6 5.3l7.9 4.6c.8-.5 1.6-.9 2.4-1.4 7-14.6 11.2-30.8 11.2-48 0-61.9-50.1-112-112-112S208 82.1 208 144c0 61.9 50.1 112 112 112zm105.2 194.5c-2.3-1.2-4.6-2.6-6.8-3.9-8.2 4.8-15.3 9.8-27.5 9.8-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-10.7-34.5 24.9-49.7 25.8-50.3-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-3.8-2.2-7-5-9.8-8.1-3.3.2-6.5.6-9.8.6-24.6 0-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h255.4c-3.7-6-6.2-12.8-6.2-20.3v-9.2zM173.1 274.6C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z">
									</path>
								</g>
							</svg>
							<span class="link-text">
								Ajouter une liste
							</span>
						</a>
					</li>
					<li class="myNav-item">
						<a href="#" @click="goTo('/allSeances')" class="myNav-link">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list-check" class="svg-inline--fa fa-list-check fa-w-20" role="img"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
								<g class="fa-group">
									<path fill="currentColor" class="fa-secondary"
									d="M152.1 38.16C161.9 47.03 162.7 62.2 153.8 72.06L81.84 152.1C77.43 156.9 71.21 159.8 64.63 159.1C58.05 160.2 51.69 157.6 47.03 152.1L7.029 112.1C-2.343 103.6-2.343 88.4 7.029 79.03C16.4 69.66 31.6 69.66 40.97 79.03L63.08 101.1L118.2 39.94C127 30.09 142.2 29.29 152.1 38.16V38.16zM152.1 198.2C161.9 207 162.7 222.2 153.8 232.1L81.84 312.1C77.43 316.9 71.21 319.8 64.63 319.1C58.05 320.2 51.69 317.6 47.03 312.1L7.029 272.1C-2.343 263.6-2.343 248.4 7.029 239C16.4 229.7 31.6 229.7 40.97 239L63.08 261.1L118.2 199.9C127 190.1 142.2 189.3 152.1 198.2V198.2zM224 96C224 78.33 238.3 64 256 64H480C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H256C238.3 128 224 113.7 224 96V96zM224 256C224 238.3 238.3 224 256 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H256C238.3 288 224 273.7 224 256zM160 416C160 398.3 174.3 384 192 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H192C174.3 448 160 433.7 160 416zM0 416C0 389.5 21.49 368 48 368C74.51 368 96 389.5 96 416C96 442.5 74.51 464 48 464C21.49 464 0 442.5 0 416z">
									</path>
								</g>
							</svg>
							<span class="link-text">
								Tracks
							</span>
						</a>
					</li>
				  	<li class="myNav-item">			  
						<v-dialog v-model="dialog"  width="500" persistent>
							<template v-slot:activator="{ on, attrs }">
								<a href="#" v-bind="attrs" v-on="on" class="myNav-link">
									<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-plus" class="svg-inline--fa fa-user-plus fa-w-20" role="img"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
										<g class="fa-group">
											<path fill="currentColor" class="fa-secondary"
											d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z">
											</path>
										</g>
									</svg>
									<span class="link-text">
										Ajouter
									</span>
								</a>
							</template>
							<newcompteform v-on:close="dialog = false" v-on:newCompte="reload"></newcompteform>
						</v-dialog>
                  	</li>
              </ul>
          </nav>
          <main class="appMain">
              <router-view ref="reload"></router-view>
          </main>
      </div>
  </v-app>
</template>

<script>
  export default {
    data () {
      return {
          dialog: false,
          drawer:false
      }
    },
    methods: {
        goTo(path){
           this.$router.push(path).catch(()=>{});
        },
        reload(){
          this.$refs.reload.getData()
        }
    },
    
  }
</script>
<style>
    :root {
  font-size: 16px;
  font-family: 'Open Sans';
  --text-primary: #b6b6b6;
  --text-secondary: #ececec;
  --bg-primary: #49b865;
  --bg-secondary: #679436;
  --transition-speed: 600ms;
}



body::-webkit-scrollbar {
  width: 0.25rem;
}

body::-webkit-scrollbar-track {
  background: #679436;
}

body::-webkit-scrollbar-thumb {
  background: #49b865;
}

.appMain {
    margin-left: 5rem;
    padding: 1rem;
}

.myNavbar {
  width: 5rem;
  height: 100vh;
  position: fixed;
  background-color: var(--bg-primary);
  transition: width 600ms ease;
  z-index: 12;

}
.v-application ul, .v-application ol {
    padding-left: 0!important;
}

.myNavbar-nav {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;
}

.myNav-item {
  width: 100%;
}


.myNav-link {
  text-decoration: none;
  display: flex;
  align-items: center;
  height: 5rem;
  color: var(--text-primary);
  text-decoration: none;
  filter: grayscale(100%) opacity(0.7);
  transition: var(--transition-speed);
  
}

.myNav-link:hover {
  filter: grayscale(0%) opacity(1);
  background: var(--bg-secondary);
  color: var(--text-secondary);
}

.myNav-item a {
    color:var(--text-primary);
     text-decoration: none;
}

.link-text {
  list-style: none;
  display: none;
  margin-left: 1rem;
}

.myNav-link svg {
  width: 2rem;
  min-width: 2rem;
  margin: 0 1.5rem;
}

.fa-primary {
  color: #43A047;
}

.fa-secondary {
  color: #0eb817;
}

.fa-primary,
.fa-secondary {
  transition: var(--transition-speed);
  color: white;
}

.logo {
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 1rem;
  text-align: center;
  color: var(--text-secondary);
  background: var(--bg-secondary);
  font-size: 1.5rem;
  letter-spacing: 0.3ch;
  width: 100%;
}

.logo svg {
  transform: rotate(0deg);
  transition: var(--transition-speed);
}


.navbar:hover .logo svg {
  transform: rotate(-180deg);
}

.link-text{
  color: white;
}

/* Small screens */
@media only screen and (max-width: 800px) {
  .myNavbar {
    bottom: 0;
    width: 100vw;
    height: 5rem;
  }

  .logo {
    display: none;
  }

  .myNavbar-nav {
    flex-direction: row;
  }

  .myNav-link {
    justify-content: center;
  }

  .appMain {
    margin: 0;
  }
}


/* Large screens */
@media only screen and (min-width: 801px) {
  
  .myNavbar {
    width: 5rem;
    height: 100vh;
    top: o;
    }

    .myNavbar:hover .logo svg {
     transform: rotate(-180deg);
    }

    .myNavbar:hover{
        width: 16rem;
    }

    .myNavbar:hover .link-text {
        display: inline;
        transition: opacity var(--transition-speed);
    }

    

  }

</style>
