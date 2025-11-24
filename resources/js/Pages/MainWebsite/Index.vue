
<script>    
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

export default {
  data() {
    return {
      year: new Date().getFullYear(),
      produce: ['Maize', 'Wheat', 'Legumes', 'Vegetables'],
      services: [
        { title: 'Seed Supply', desc: 'High germination certified seeds.' },
        { title: 'Training & Extension', desc: 'Hands-on workshops and field demos.' },
        { title: 'Market Access', desc: 'Aggregation and buyer linkage.' },
      ],
      form: {
        name: '',
        email: '',
        message: ''
      }
    };
  },
  methods: {
    submitForm() {
      // Replace with Inertia POST
      console.log('Submit:', this.form);
    }
  }
};
</script>

<template>

    <GuestLayout>
        <div class="min-h-screen text-gray-800 bg-white antialiased">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg bg-green-700 flex items-center justify-center text-white font-bold">MF</div>
                <div>
                    <h1 class="text-lg font-semibold">Massa Farms</h1>
                    <p class="text-sm text-gray-500">Sustainable seeds • Quality produce • Farmer-first</p>
                </div>
                </div>
                <nav class="hidden md:flex gap-6 items-center text-sm">
                <a href="#about" class="hover:text-green-700">About</a>
                <a href="#produce" class="hover:text-green-700">Produce</a>
                <a href="#services" class="hover:text-green-700">Services</a>
                <a href="#contact" class="hover:text-green-700">Contact</a>
                <a class="px-4 py-2 rounded-md bg-green-700 text-white text-sm" href="#">Buy / Order</a>
                </nav>
                <button class="md:hidden p-2 rounded-md border">☰</button>
            </div>
            </header>

            <!-- Hero -->
            <section class="bg-[url('/hero-placeholder.jpg')] bg-cover bg-center">
            <div class="bg-green-900/60">
                <div class="max-w-7xl mx-auto px-6 py-24 text-white">
                <h2 class="text-3xl md:text-5xl font-extrabold leading-tight">Massa Farms — Growing resilience, harvests, and livelihoods</h2>
                <p class="mt-4 max-w-2xl text-lg text-green-100">We provide certified seeds, training, and sustainable farming inputs to smallholder farmers across Ethiopia.</p>
                <div class="mt-8 flex gap-4">
                    <a href="#contact" class="rounded-md bg-white text-green-800 px-5 py-3 font-semibold shadow">Get in touch</a>
                    <a href="#produce" class="rounded-md border border-white/60 px-5 py-3 text-white">See produce</a>
                </div>
                </div>
            </div>
            </section>

            <!-- Stats -->
            <section class="py-12">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-6 border rounded-lg">
                <div class="text-3xl font-bold text-green-700">6+</div>
                <div class="mt-2 text-sm text-gray-600">Years of operation</div>
                </div>
                <div class="p-6 border rounded-lg">
                <div class="text-3xl font-bold text-green-700">10k+</div>
                <div class="mt-2 text-sm text-gray-600">Farmers reached</div>
                </div>
                <div class="p-6 border rounded-lg">
                <div class="text-3xl font-bold text-green-700">Top 3</div>
                <div class="mt-2 text-sm text-gray-600">Innovation challenge award</div>
                </div>
            </div>
            </section>

            <!-- About -->
            <section id="about" class="py-12 bg-gray-50">
            <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
                <div>
                <h3 class="text-2xl font-bold">About Massa Farms</h3>
                <p class="mt-4 text-gray-700">Massa Farms works with smallholder farmers to improve seed quality, post-harvest handling, and market access.</p>
                <ul class="mt-4 space-y-2 text-gray-700">
                    <li>• Seed production & certification support</li>
                    <li>• Farmer training programs and extension</li>
                    <li>• Farm-to-market aggregation and logistics</li>
                </ul>
                </div>
                <div>
                <img src="/about-placeholder.jpg" class="rounded-lg shadow-md w-full object-cover h-64" />
                </div>
            </div>
            </section>

            <!-- Produce -->
            <section id="produce" class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                <h3 class="text-2xl font-bold">Our Produce</h3>
                <p class="mt-2 text-gray-600">High-quality seeds and fresh produce grown by partner farmers.</p>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div v-for="item in produce" :key="item" class="border rounded-lg overflow-hidden">
                    <img :src="`/produce-${item.toLowerCase()}.jpg`" :alt="item" class="w-full h-40 object-cover" />
                    <div class="p-4">
                    <h4 class="font-semibold">{{ item }}</h4>
                    <p class="mt-2 text-sm text-gray-600">Certified seed and fresh harvests.</p>
                    </div>
                </div>
                </div>
            </div>
            </section>

            <!-- Services -->
            <section id="services" class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <h3 class="text-2xl font-bold">Services</h3>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white border rounded-lg" v-for="service in services" :key="service.title">
                    <h4 class="font-semibold">{{ service.title }}</h4>
                    <p class="mt-2 text-sm text-gray-600">{{ service.desc }}</p>
                </div>
                </div>
            </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="py-12 bg-green-50">
            <div class="max-w-4xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
                <div>
                <h3 class="text-2xl font-bold">Contact us</h3>
                <p class="mt-2 text-gray-700">Send us a message and we'll reply within 48 hours.</p>
                <ul class="mt-4 text-gray-700 text-sm space-y-2">
                    <li>Phone: +251 9XX XXX XXX</li>
                    <li>Email: info@massa-farms.com</li>
                    <li>Address: Addis Ababa, Ethiopia</li>
                </ul>
                </div>

                <form @submit.prevent="submitForm" class="bg-white p-6 rounded-lg shadow-md">
                <label class="block">
                    <span class="text-sm font-medium text-gray-700">Name</span>
                    <input v-model="form.name" class="mt-1 block w-full rounded-md border-gray-200" />
                </label>
                <label class="block mt-4">
                    <span class="text-sm font-medium text-gray-700">Email</span>
                    <input v-model="form.email" type="email" class="mt-1 block w-full rounded-md border-gray-200" />
                </label>
                <label class="block mt-4">
                    <span class="text-sm font-medium text-gray-700">Message</span>
                    <textarea v-model="form.message" rows="4" class="mt-1 block w-full rounded-md border-gray-200"></textarea>
                </label>
                <button class="mt-4 rounded-md bg-green-700 text-white px-4 py-2">Send message</button>
                </form>
            </div>
            </section>

            <footer class="border-t py-8">
            <div class="max-w-7xl mx-auto px-6 flex justify-between text-sm text-gray-600">
                <div>© {{ year }} Massa Farms — All rights reserved.</div>
                <div class="flex gap-4">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Careers</a>
                </div>
            </div>
            </footer>
        </div>
    </GuestLayout>
</template>


<style scoped>
</style>
