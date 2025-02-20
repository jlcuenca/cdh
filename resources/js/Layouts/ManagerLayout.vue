<template>
  <div class="w-full h-full grid-cols-1 md:grid grid-cols-5">
    <div class="min-h-full">
      <!--Left sidebar-->
      <div class="h-20 w-full bg-white own-shadow hidden md:flex px-2 items-center">
        <div class="w-full flex ">
          <Link :href="route('manager.index')">
            <div class="w-32">
              <img src="/images/logo_default.png">
            </div>
          </Link>
        </div>
      </div>
      <div class="w-full h-full py-6 bg-gray-700 hidden md:block text-white font-light text-xl">
        <sidebar></sidebar>
      </div>
    </div>
    <div class="col-span-4">
      <!--#Header-->
      <div class="w-full h-20 bg-white py-6 px-2 md:px-10 flex justify-between md:justify-end items-center fixed md:relative z-20 shadow-md md:shadow-none">
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
        <div class="block md:hidden">
          <Link :href="route('manager.index')">
            <div class="w-32">
              <img src="/images/logo.png">
            </div>
          </Link>
        </div>
        <div class="text-gray-600 text-lg hidden md:flex space-x-8 items-center">
          <button @click="showMenu" class="hidden md:flex space-x-2 items-center focus:outline-none">
            <div
                class="rounded-full h-12 w-12 bg-maroon-600 text-white flex justify-center items-center content-center">
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
      <div v-show="menu" class="fixed z-10 top-12 menu transform translate-y-0 transition duration-400 right-8 hidden md:block bg-white shadow-xl border border-gray-100 py-8 space-y-6 px-4 rounded opacity-0 text-lg">
        <Link :href="route('logout')" method="post" as="button">
          Cerrar sesión
        </Link>
      </div>
      <div v-show="menuSm" class="fixed z-10 top-0 menuSm transform -translate-y-full transition duration-500 block md:hidden bg-white shadow-md border border-gray-100 py-8 px-4 space-y-6 rounded text-lg w-full">
        <Link :href="route('logout')" method="post" as="button">
          Cerrar sesión
        </Link>
      </div>

      <!--#Sidebar-->
      <div @click="hideSidebar" v-show="bgSide"
           class="w-full h-full fixed z-20 bg-black opacity-50 top-0 block md:hidden"></div>
      <div v-show="sideBar"
           class="w-1/2 sidebar transform transition duration-900 -translate-x-full h-full fixed z-30 bg-gray-700 font-light text-base text-white space-y-4 block md:hidden overflow-y-auto">
        <div class="flex justify-end p-4">
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
        <div class="w-full h-full space-y-4">
          <sidebar></sidebar>
        </div>
      </div>
      <main>
        <slot name="announce"></slot>
        <div class="px-10 py-5 space-y-4 transition duration-400 anim transform -translate-y-16 opacity-0">
          <slot/>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Sidebar from "@/Components/Sidebar";

export default {
  components: {
    Sidebar,
    Link
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
