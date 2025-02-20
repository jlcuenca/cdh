<template>
  <page-layout>
    <template v-slot:section>
      <h1>Añadidos recientemente</h1>
    </template>
    <template v-slot:content>
      <div class="md:flex no-wrap md:-mx-2 ">
        <div class="w-full md:w-3/12 md:mx-2">
          <div class="bg-white p-3 border-t-4 border-green-400">
            <div class="image overflow-hidden">
              <img class="h-auto w-full mx-auto" src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg" alt="">
            </div>
            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">Jane Doe</h1>
            <h3 class="text-gray-600 font-lg text-semibold leading-6">Owner at Her Company Inc.</h3>
            <p class=" text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit amet
              consectetur adipisicing elit.
              Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
            <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
              <li class="flex items-center py-3">
                <span>Status</span>
                <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white ">Active</span></span>
              </li>
              <li class="flex items-center py-3">
                <span>Member since</span>
                <span class="ml-auto">Nov 07, 2016</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="w-full md:w-9/12 md:mx-2">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut culpa distinctio eaque, fugit illo incidunt, inventore ipsam minima nulla perspiciatis porro, quibusdam quod unde? Nisi quisquam ratione sit suscipit vel!
        </div>
      </div>

      <!--
      <div class="w-full px-0 md:px-20 space-y-4 grid grid-cols-1">
        <div class="rounded shadow grid grid-cols-1 md:grid-cols-2">
          <div class="relative">
            <div class="absolute top-2 md:top-10 right-0 rounded-l-full text-white uppercase font-bold items-center text-2xl p-2 bg-maroon-600">Cuerpo</div>
            <img src="https://dam.smashmexico.com.mx/wp-content/uploads/2020/09/The-Flash-sus-posibles-cameos-nos-encantaria-verlos-en-la-pantalla-grande.jpg" alt="" class="bg-contain rounded-t rounded-l-none md:rounded-t-none md:rounded-l">
          </div>
          <div class="p-8 flex justify-center bg-white rounded">
            <div class="text-center space-y-8">
              <h1 class="font-bold text-2xl uppercase">Intensity</h1>
              <p class="text-gray-400 text-xl text-justify">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut corporis deserunt dolorem dolorum, earum est fuga ipsa ipsam maiores modi necessitatibus nemo porro quaerat quas quo quod rem totam ullam!
              </p>
              <div class="w-full flex justify-center">
                <Link class="rounded shadow-md px-6 py-2 flex space-x-2 items-center bg-maroon-600 hover:bg-maroon-700 transition duration-100 text-white font-bold text-lg  ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="fill-current" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-3 18v-12l10 6-10 6z"/></svg>
                  <h2 class="uppercase">Ver ahora</h2>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
      -->
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";

export default {
  components: {PageLayout},
  props: {
    records: {
      type: Object
    },
    trainer: {
      type: Object
    }
  }
}
</script>
