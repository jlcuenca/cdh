<template>
    <!--#Header-->
    <div class="h-20 bg-white px-2 md:px-10 py-6 flex justify-between items-center fixed z-20 w-full shadow-md md:shadow-none">
        <button @click="showSidebar" class="flex focus:outline-none md:hidden items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="32" height="32"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                 stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
        </button>
        <div class="w-24">
            <Link :href="route('webapp.index')">
                <img src="/images/logo.png" alt="">
            </Link>
        </div>
        <div class="text-gray-600 text-lg hidden md:flex space-x-8 items-center">

          <menu-component />

          <button @click="showMenu" class="hidden md:flex space-x-2 items-center focus:outline-none">
            <div class="rounded-full h-12 w-12 bg-maroon-600 text-white flex justify-center items-center content-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="400" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="7" r="4"></circle>
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
              </svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M12 21l-12-18h24z"/></svg>
          </button>
        </div>

        <!--#Sm button-->
        <button @click="showMenuSm" class="flex md:hidden space-x-2 items-center focus:outline-none">
            <div class="rounded-full h-12 w-12 bg-maroon-600 text-white flex justify-center items-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="400"
                     height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                </svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                <path d="M12 21l-12-18h24z"/>
            </svg>
        </button>
    </div>
    <!--#Menu-->
    <div v-show="menu" class="fixed z-10 top-12 menu transform translate-y-0 transition duration-400 right-8 hidden md:block bg-white shadow-xl border border-gray-100 py-8 space-y-6 rounded opacity-0 text-lg">
      <Link :href="route('webapp.profile.index')">
        <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z"/></svg>
          <h2>Mi perfil</h2>
        </div>
      </Link>
      <Link :href="route('webapp.evaluation.index')">
        <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="9" y1="12" x2="9.01" y2="12"></line><line x1="13" y1="12" x2="15" y2="12"></line><line x1="9" y1="16" x2="9.01" y2="16"></line><line x1="13" y1="16" x2="15" y2="16"></line></svg>
          <div>Diagnóstico</div>
        </div>
      </Link>
      <Link :href="route('webapp.awards')">
        <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award" width="24"
               height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
               stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="9" r="6"></circle>
            <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(-30 12 9)"></polyline>
            <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(30 12 9)"></polyline>
          </svg>
          <div>Recompensas</div>
        </div>
      </Link>
      <Link :href="route('logout')" method="post" as="button">
        <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-power" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
            <line x1="12" y1="4" x2="12" y2="12"></line>
          </svg>
          <div>Cerrar sesión</div>
        </div>
      </Link>
    </div>

  <div v-show="menuSm" class="fixed z-10 top-0 menuSm transform -translate-y-full transition duration-500 block md:hidden bg-white shadow-md border border-gray-100 py-8 space-y-6 rounded text-lg w-full">
        <Link>
            <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z"/>
                </svg>
                <h2>Mis perfil</h2>
            </div>
        </Link>
        <Link :href="route('webapp.evaluation.index')">
            <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                    <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                    <line x1="9" y1="12" x2="9.01" y2="12"></line>
                    <line x1="13" y1="12" x2="15" y2="12"></line>
                    <line x1="9" y1="16" x2="9.01" y2="16"></line>
                    <line x1="13" y1="16" x2="15" y2="16"></line>
                </svg>
                <h2>Diagnóstico</h2>
            </div>
        </Link>
        <Link :href="route('webapp.awards')">
            <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="9" r="6"></circle>
                    <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(-30 12 9)"></polyline>
                    <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(30 12 9)"></polyline>
                </svg>
                <h2>Recompensas</h2>
            </div>
        </Link>
        <Link :href="route('webapp.mail')">
            <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path>
                    <path d="M3 6l9 6l9 -6"></path>
                    <path d="M15 18h6"></path>
                    <path d="M18 15l3 3l-3 3"></path>
                </svg>
                <h2>Buzón anónimo</h2>
            </div>
        </Link>
      <Link :href="route('logout')" method="post" as="button">
        <div class="flex space-x-3 hover:bg-gray-100 px-8 py-4">
          Cerrar sesión
        </div>
      </Link>
    </div>

    <!--#Sidebar-->
    <div @click="hideSidebar" v-show="bgSide" class="w-full h-full fixed z-20 bg-black opacity-50 top-0 block md:hidden"></div>
    <div v-show="sideBar" class="w-1/2 sidebar transform transition duration-900 -translate-x-full h-full fixed z-30 bg-white p-6 space-y-4 block md:hidden">
        <div class="flex justify-end">
            <button @click="hideSidebar" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-left" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="4" y1="12" x2="14" y2="12"></line>
                    <line x1="4" y1="12" x2="8" y2="16"></line>
                    <line x1="4" y1="12" x2="8" y2="8"></line>
                    <line x1="20" y1="4" x2="20" y2="20"></line>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-1 space-y-3 text-lg">
          <menu-component/>
        </div>
    </div>

    <!--#Content-->
    <div class="px-10 py-6 space-y-4 pt-24 transition duration-400 anim transform -translate-y-16 opacity-0">
        <div class="w-full rounded text-base md:text-2xl font-bold px-2 md:px-10 h-24 space-x-2 uppercase bg-white flex items-center justify-center shadow">
            <slot name="section"></slot>
        </div>
        <slot name="content"></slot>
    </div>
</template>

<script>
import Button from "@/Components/Button";
import MenuComponent from "@/Components/Menu";

export default {
    components: {
      Button,
      MenuComponent
    },
  data() {
    return {
      menu: false,
      menuSm: false,
      bgSide: false,
      sideBar: false
    }
  },
    methods: {
        showMenu() {
            if (!this.menu) {
                this.menu = !this.menu
                let opac = document.querySelector('.menu.opacity-0')
                let slide = document.querySelector('.menu.translate-y-0')
                setTimeout(() => {
                    opac.classList.remove('opacity-0')
                    opac.classList.add('opacity-100')
                    slide.classList.remove('translate-y-0')
                    slide.classList.add('translate-y-4')
                }, 40)
            } else {
                this.menu = !this.menu
                let opac = document.querySelector('.menu.opacity-100')
                let slide = document.querySelector('.menu.translate-y-4')

                opac.classList.remove('opacity-100')
                opac.classList.add('opacity-0')
                slide.classList.remove('translate-y-4')
                slide.classList.add('translate-y-0')
            }
        },
        showMenuSm() {
            if (!this.menuSm) {
                this.menuSm = !this.menuSm

                let slide = document.querySelector('.menuSm.-translate-y-full')
                setTimeout(() => {
                    slide.classList.remove('-translate-y-full')
                    slide.classList.add('translate-y-20')
                }, 100)
            } else {
                if (document.querySelector('.menuSm.translate-y-20')) {
                    let slide = document.querySelector('.menuSm.translate-y-20')
                    slide.classList.remove('translate-y-20')
                    slide.classList.add('-translate-y-full')

                    setTimeout(() => this.menuSm = !this.menuSm, 400)
                }
            }
        },
        showSidebar() {
            this.bgSide = !this.bgSide
            this.sideBar = !this.sideBar

            let slider = document.querySelector('.sidebar.-translate-x-full')
            setTimeout(() => {
                slider.classList.remove('-translate-x-full')
                slider.classList.add('translate-x-0')
            }, 200)

        },
        hideSidebar() {
            if (document.querySelector('.sidebar.translate-x-0')) {
                let hideSlider = document.querySelector('.sidebar.translate-x-0')
                setTimeout(() => {
                    hideSlider.classList.remove('translate-x-0')
                    hideSlider.classList.add('-translate-x-full')
                }, 200)
                setTimeout(() => {
                    this.bgSide = !this.bgSide
                    this.sideBar = !this.sideBar
                }, 500)
            }
        }
    },
    mounted() {
        let mountedSlide = document.querySelector('.anim.-translate-y-16');
        setTimeout(() => {
            mountedSlide.classList.remove('-translate-y-16')
            mountedSlide.classList.add('translate-y-0')
        }, 300)

        let mountedOpacity = document.querySelector('.anim.opacity-0');
        setTimeout(() => {
            mountedOpacity.classList.remove('opacity-0')
            mountedOpacity.classList.add('opacity-100')
        }, 350)
    }
}
</script>
