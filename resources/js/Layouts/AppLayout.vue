<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-green-700 text-white p-4 flex justify-between">
      <div class="font-bold text-lg">MASSA Farms</div>
      <div class="space-x-4">
        <Link href="/dashboard">Dashboard</Link>
        <Link href="/sales">Sales</Link>
        <Link href="/products">Products</Link>
      </div>
    </nav>

    <main class="p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style>
nav a {
  text-decoration: none;
}
</style>
