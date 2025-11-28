<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import {
  ShoppingBagIcon,
  Bars3Icon,
  XMarkIcon,
  ArrowRightIcon,
  StarIcon,
  SparklesIcon,
  HeartIcon
} from "@heroicons/vue/24/solid";
import { ArrowLongRightIcon, SunIcon, CloudIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
  canLogin: Boolean,
});

const showMobileMenu = ref(false);
const year = new Date().getFullYear();

// Data
const categories = [
  { title: "Vegetables", image: "/assets/website/vegetables.png", color: "bg-green-100 text-green-800" },
  { title: "Fruits", image: "/assets/website/fruits.png", color: "bg-orange-100 text-orange-800" },
  { title: "Grains", image: "/assets/website/grains.png", color: "bg-yellow-100 text-yellow-800" },
  { title: "Dairy", image: "/assets/website/dairy.png", color: "bg-blue-100 text-blue-800" },
];

const products = [
  { id: 1, name: "Red Onions", price: "80", unit: "kg", image: "/assets/website/onion.png", rating: 4.8 },
  { id: 2, name: "Fresh Kale", price: "70", unit: "bunch", image: "/assets/website/kale.png", rating: 5.0 },
  { id: 3, name: "Teft Flour (White)", price: "6,200", unit: "50kg", image: "/assets/website/teff.jpg", rating: 4.9 },
  { id: 4, name: "Organic Honey", price: "1,200", unit: "jar", image: "/assets/website/honey.png", rating: 5.0 },
];

// Newsletter State
const email = ref("");
const subscribed = ref(false);

const handleSubscribe = () => {
  if (!email.value) return;
  router.post(route('contacts.store'), { email: email.value }, {
    onSuccess: () => {
      subscribed.value = true;
      setTimeout(() => { subscribed.value = false; email.value = ""; }, 3000);
    }
  });
};

</script>

<style scoped>
/* Typography */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

.font-serif { font-family: 'Playfair Display', serif; }
.font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

/* Custom Textures & Utilities */
.bg-grain {
  position: relative;
}
.bg-grain::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}

.text-stroke-title {
  -webkit-text-stroke: 1px rgba(255,255,255,0.2);
  color: transparent;
}

/* Animations */
@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
  100% { transform: translateY(0px); }
}
.animate-float { animation: float 5s ease-in-out infinite; }

@keyframes scroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.animate-scroll { animation: scroll 20s linear infinite; }

.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<template>
  <Head title="MASSA FARMS — Nature's Best" />

  <WebLayout>
    <div class="font-sans text-slate-800 bg-[#FDFBF7] min-h-screen selection:bg-lime-300 selection:text-emerald-900">

      <!-- Header Section -->
      <header class="fixed top-6 left-0 right-0 z-50 flex justify-center px-4">
        <nav class="bg-emerald-950/90 backdrop-blur-md text-white px-2 pl-6 py-2 rounded-full shadow-2xl border border-white/10 flex items-center justify-between gap-8 max-w-4xl w-full transition-all duration-300">
          
          <div class="flex items-center gap-2">
            <SparklesIcon class="w-5 h-5 text-lime-400" />
            <span class="font-serif font-bold text-xl tracking-tight">MASSA Farms</span>
          </div>

          <div class="hidden md:flex items-center gap-8 text-sm font-medium text-emerald-100/80">
            <Link href="#" class="hover:text-white transition">Home</Link>
            <Link href="#shop" class="hover:text-white transition">Shop</Link>
            <Link href="#about" class="hover:text-white transition">Farmers</Link>
            <Link href="#contact" class="hover:text-white transition">Contact</Link>
          </div>

          <div class="flex items-center gap-2">
            <Link href="#" class="p-3 bg-white/10 hover:bg-white/20 rounded-full transition relative group">
              <ShoppingBagIcon class="w-5 h-5 text-white" />
              <span class="absolute top-2 right-2 w-2 h-2 bg-lime-400 rounded-full"></span>
            </Link>
            <Link :href="route('login')" class="hidden md:block bg-lime-400 hover:bg-lime-300 text-emerald-950 px-6 py-2.5 rounded-full text-sm font-bold transition">
              Sign In
            </Link>
            <button @click="showMobileMenu = !showMobileMenu" class="md:hidden p-3 hover:bg-white/10 rounded-full">
              <Bars3Icon class="w-6 h-6" />
            </button>
          </div>
        </nav>
      </header>

      <!-- Produces Section -->
      <section class="relative pt-32 pb-16 px-4 md:px-8 overflow-hidden bg-grain">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center">
          
          <div class="lg:col-span-7 relative z-10 pt-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
              <SunIcon class="w-4 h-4" /> 100% Organic Produce
            </div>
            
            <h1 class="font-serif text-6xl md:text-8xl text-emerald-950 leading-[0.95] mb-8">
              Eat Real <br/>
              <span class="italic text-emerald-800/80 font-light">Food Again.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-stone-600 max-w-lg mb-10 leading-relaxed">
              We bridge the gap between Ethiopia's finest smallholder farmers and your dining table. Fresh, fair, and incredibly flavorful.
            </p>

            <div class="flex flex-wrap gap-4">
              <Link href="#shop" class="bg-emerald-950 text-white px-8 py-4 rounded-full font-medium hover:scale-105 transition-transform duration-300 flex items-center gap-3 shadow-xl shadow-emerald-900/20">
                Start Shopping <ArrowRightIcon class="w-5 h-5" />
              </Link>
              <button class="px-8 py-4 rounded-full border border-stone-300 font-medium hover:bg-white transition flex items-center gap-2">
                <CloudIcon class="w-5 h-5" /> View Seasonal List
              </button>
            </div>

            <div class="mt-12 flex items-center gap-6">
              <div class="flex -space-x-3">
                <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full border-2 border-[#FDFBF7]" />
                <img src="https://i.pravatar.cc/100?img=5" class="w-10 h-10 rounded-full border-2 border-[#FDFBF7]" />
                <img src="https://i.pravatar.cc/100?img=8" class="w-10 h-10 rounded-full border-2 border-[#FDFBF7]" />
              </div>
              <div class="text-sm">
                <p class="font-bold text-emerald-950">1,200+ Happy Families</p>
                <p class="text-stone-500">Ordering weekly across Addis.</p>
              </div>
            </div>
          </div>

          <div class="lg:col-span-5 relative">
            <div class="relative rounded-[3rem] overflow-hidden aspect-[4/5] shadow-2xl rotate-2 hover:rotate-0 transition duration-700 ease-out">
              <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10"></div>
              <img src="/assets/img/banner.jpg" alt="Farmer holding harvest" class="w-full h-full object-cover scale-110" />
              
              <div class="absolute bottom-8 left-8 right-8 bg-white/95 backdrop-blur p-6 rounded-3xl z-20 shadow-lg animate-float">
                <div class="flex justify-between items-start">
                  <div>
                    <p class="text-xs text-stone-400 uppercase tracking-wider font-bold mb-1">Product of the Week</p>
                    <h3 class="font-serif text-2xl text-emerald-950">Avocado Box</h3>
                  </div>
                  <span class="bg-lime-400 text-emerald-900 text-xs font-bold px-2 py-1 rounded-md">ETB 350</span>
                </div>
              </div>
            </div>
            
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-lime-400 rounded-full blur-3xl opacity-50 -z-10"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-600 rounded-full blur-3xl opacity-30 -z-10"></div>
          </div>
        </div>
      </section>

      <div class="bg-lime-400 py-4 overflow-hidden -rotate-1 shadow-lg border-y-2 border-emerald-950">
        <div class="flex whitespace-nowrap animate-scroll">
          <span v-for="n in 10" :key="n" class="mx-6 font-bold text-emerald-950 uppercase tracking-widest text-sm flex items-center gap-6">
            Premium Quality <StarIcon class="w-4 h-4" /> Locally Sourced <StarIcon class="w-4 h-4" /> Fair Trade <StarIcon class="w-4 h-4" /> Sustainable <StarIcon class="w-4 h-4" /> Daily Available <StarIcon class="w-4 h-4" />
          </span>
        </div>
      </div>

      <!-- Catalog Section -->
      <section class="py-24 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
          <div class="flex justify-between items-end mb-12">
            <h2 class="font-serif text-4xl text-emerald-950">Curated Aisle</h2>
            <Link href="#" class="hidden md:flex items-center gap-2 text-sm font-bold border-b border-emerald-950 pb-0.5 hover:text-emerald-700 transition">View Full Catalog</Link>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <Link href="#" v-for="cat in categories" :key="cat.title" class="group relative aspect-[3/4] rounded-3xl overflow-hidden cursor-pointer">
              <img :src="cat.image" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" />
              <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
              <div class="absolute bottom-4 left-4 right-4">
                <div :class="`px-4 py-3 rounded-2xl backdrop-blur-md bg-white/90 shadow-sm flex justify-between items-center group-hover:-translate-y-2 transition duration-300`">
                  <span class="font-bold text-emerald-950">{{ cat.title }}</span>
                  <ArrowLongRightIcon class="w-5 h-5 text-stone-400 group-hover:text-emerald-600" />
                </div>
              </div>
            </Link>
          </div>
        </div>
      </section>

      <!-- Harvests Section -->
      <section id="shop" class="py-24 px-4 md:px-8 bg-emerald-950 text-white rounded-t-[3rem] relative bg-grain">
        <div class="max-w-7xl mx-auto">
          <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-lime-400 font-bold tracking-widest uppercase text-xs">Fresh Harvest</span>
            <h2 class="font-serif text-4xl md:text-5xl mt-4">This Week's Favorites</h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div v-for="product in products" :key="product.id" class="group">
              <div class="relative bg-white/5 rounded-[2rem] p-4 border border-white/10 hover:border-lime-400/50 transition duration-300">
                <div class="relative aspect-square rounded-2xl overflow-hidden bg-white/10">
                   <img :src="product.image" class="w-full h-full object-cover mix-blend-overlay opacity-80 group-hover:opacity-100 group-hover:mix-blend-normal transition duration-500" />
                   
                   <button class="absolute top-3 right-3 p-2 bg-black/20 backdrop-blur rounded-full hover:bg-lime-400 hover:text-emerald-950 transition">
                     <HeartIcon class="w-5 h-5" />
                   </button>
                </div>

                <div class="mt-6">
                  <div class="flex justify-between items-start">
                    <div>
                      <h3 class="font-serif text-xl">{{ product.name }}</h3>
                      <p class="text-white/50 text-sm mt-1">Per {{ product.unit }}</p>
                    </div>
                    <div class="text-right">
                      <p class="font-bold text-lg text-lime-400">{{ product.price }} br</p>
                      <div class="flex items-center gap-1 text-xs text-white/70 justify-end">
                        <StarIcon class="w-3 h-3 text-yellow-400" /> {{ product.rating }}
                      </div>
                    </div>
                  </div>

                  <button class="w-full mt-6 py-3 rounded-xl border border-white/20 hover:bg-lime-400 hover:border-lime-400 hover:text-emerald-950 font-bold transition flex justify-center items-center gap-2 group-hover:translate-y-0 translate-y-2 opacity-0 group-hover:opacity-100">
                    Add to Basket
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Farmers Section -->
      <section id="about" class="py-24 px-4 md:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
          <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-lime-400 font-bold tracking-widest uppercase text-xs">Meet The Farmers</span>
        <h2 class="font-serif text-4xl md:text-5xl mt-4 text-emerald-950">Our Partner Growers</h2>
        <p class="text-stone-500 mt-4">The heart of Massa Farms — passionate, local smallholders bringing fresh harvests to your table every week.</p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-emerald-50 rounded-3xl p-6 text-center shadow hover:shadow-lg transition">
          <img src="/assets/website/alemu.jpg" alt="Farmer 1" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-lime-200" />
          <h3 class="font-serif text-xl text-emerald-950">Alemu Bekele</h3>
          <p class="text-sm text-stone-500 mt-1">Vegetable Specialist</p>
          <p class="mt-4 text-stone-600 text-xs">15 years cultivating onions & greens in Oromia.</p>
        </div>
        <div class="bg-emerald-50 rounded-3xl p-6 text-center shadow hover:shadow-lg transition">
          <img src="/assets/website/mulu.jpg" alt="Farmer 2" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-lime-200" />
          <h3 class="font-serif text-xl text-emerald-950">Mulu Getachew</h3>
          <p class="text-sm text-stone-500 mt-1">Fruit Grower</p>
          <p class="mt-4 text-stone-600 text-xs">Supplying ripe avocados & mangos for Addis since 2010.</p>
        </div>
        <div class="bg-emerald-50 rounded-3xl p-6 text-center shadow hover:shadow-lg transition">
          <img src="/assets/website/tesfaye.jpg" alt="Farmer 3" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-lime-200" />
          <h3 class="font-serif text-xl text-emerald-950">Tesfaye Lema</h3>
          <p class="text-sm text-stone-500 mt-1">Grains & Cereals</p>
          <p class="mt-4 text-stone-600 text-xs">Expert in teff, wheat, and sustainable farming methods.</p>
        </div>
        <div class="bg-emerald-50 rounded-3xl p-6 text-center shadow hover:shadow-lg transition">
          <img src="/assets/website/sara.jpg" alt="Farmer 4" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-lime-200" />
          <h3 class="font-serif text-xl text-emerald-950">Sara Fikru</h3>
          <p class="text-sm text-stone-500 mt-1">Dairy & Honey</p>
          <p class="mt-4 text-stone-600 text-xs">Local leader in organic milk and wild honey production.</p>
        </div>
          </div>
        </div>
      </section>


      <!-- Subscription Section -->
      <section id="contact" class="py-24 px-4 md:px-8 bg-emerald-900 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
          <h2 class="font-serif text-4xl md:text-6xl text-white mb-6">Join the <span class="text-stroke-title font-italic">Massa</span> Family</h2>
          <p class="text-emerald-200 text-lg mb-10 max-w-xl mx-auto">Get exclusive access to rare seeds, seasonal harvest lists, and farming tips delivered to your inbox.</p>

          <form @submit.prevent="handleSubscribe" class="relative max-w-md mx-auto">
             <input 
               v-model="email"
               type="email" 
               placeholder="your.email@example.com" 
               class="w-full pl-6 pr-32 py-5 rounded-full bg-white/10 border border-white/20 text-white placeholder-emerald-200/50 focus:outline-none focus:ring-2 focus:ring-lime-400 backdrop-blur-sm"
             />
             <button type="submit" class="absolute right-2 top-2 bottom-2 bg-lime-400 hover:bg-lime-300 text-emerald-950 px-6 rounded-full font-bold transition">
               {{ subscribed ? 'Joined!' : 'Subscribe' }}
             </button>
          </form>
          <p class="mt-6 text-xs text-emerald-400 uppercase tracking-widest">No spam. Unsubscribe anytime.</p>
        </div>
      </section>

      <!-- Footer Section -->
      <footer class="bg-[#FDFBF7] pt-20 pb-10 px-4 border-t border-emerald-950/5">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
          <div class="max-w-xs">
            <span class="font-serif font-bold text-2xl text-emerald-950">MASSA.</span>
            <p class="mt-4 text-stone-500 leading-relaxed">Cultivating a healthier future for Ethiopia through sustainable agriculture and fair trade.</p>
          </div>
          
          <div class="grid grid-cols-2 md:grid-cols-3 gap-12 md:gap-24">
            <div>
              <h4 class="font-bold text-emerald-950 mb-4">Shop</h4>
              <ul class="space-y-2 text-stone-500 text-sm">
                <li><a href="#" class="hover:text-emerald-700">All Products</a></li>
                <li><a href="#" class="hover:text-emerald-700">Subscriptions</a></li>
                <li><a href="#" class="hover:text-emerald-700">Seeds</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-bold text-emerald-950 mb-4">Company</h4>
              <ul class="space-y-2 text-stone-500 text-sm">
                <li><a href="#" class="hover:text-emerald-700">Our Story</a></li>
                <li><a href="#" class="hover:text-emerald-700">Farmers</a></li>
                <li><a href="#" class="hover:text-emerald-700">Contact</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-bold text-emerald-950 mb-4">Social</h4>
              <ul class="space-y-2 text-stone-500 text-sm">
                <li><a href="#" class="hover:text-emerald-700">Instagram</a></li>
                <li><a href="#" class="hover:text-emerald-700">Twitter</a></li>
                <li><a href="#" class="hover:text-emerald-700">LinkedIn</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-stone-200 flex flex-col md:flex-row justify-between text-xs text-stone-400 uppercase tracking-wider">
          <p>&copy; {{ year }} Massa Farms Ethiopia</p>
          <div class="flex gap-6 mt-4 md:mt-0">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
          </div>
        </div>
      </footer>

    </div>
  </WebLayout>
</template>